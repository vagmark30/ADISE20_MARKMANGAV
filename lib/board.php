<?php
function show_board(){
  header('Content-type: application/json');
	print json_encode(read_board(), JSON_PRETTY_PRINT);
}
function read_board(){
  global $mysqli;

  $sql = 'select * from board';
  $st = $mysqli->prepare($sql);

  $st->execute();
  $res = $st->get_result();
	return ($res->fetch_all(MYSQLI_ASSOC));
}

function reset_board(){
  global $mysqli;

  $query = 'CALL clear_board()';
  $mysqli->query($query);
  show_board();
}

function show_piece($x,$y){
  global $mysqli;

	$sql = 'select * from board where x=? and y=?';
	$st = $mysqli->prepare($sql);
	$st->bind_param('ii',$x,$y);
	$st->execute();
	$res = $st->get_result();
	header('Content-type: application/json');
	print json_encode($res->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
}

function move_piece($input)
{
	$token = $input['token'];
	if ($token == null || $token == '') {
		header("HTTP/1.1 400 Bad Request");
		print json_encode(['errormesg' => "token is not set."]);
		exit;
	} else {

    $col_num = $input['move'];
    global $mysqli;
    $sql = 'select count(*) as p from board where piece_color is not null';
    $st = $mysqli->prepare($sql);
    $st->execute();
    $res = $st->get_result();
    $r = $res->fetch_all(MYSQLI_ASSOC);
    if($r[0]['p']==42) {
      header("HTTP/1.1 400 Bad Request");
      print json_encode(['errormesg'=>"Game has finished as draw."]);
      exit;
    }
    $sql = 'select count(*) as p from board where y=? and piece_color is not null';
    $st = $mysqli->prepare($sql);
    $st->bind_param('i',$col_num);
    $st->execute();
    $res = $st->get_result();
    $r = $res->fetch_all(MYSQLI_ASSOC);
    if($r[0]['p']==6) {
      header("HTTP/1.1 400 Bad Request");
      print json_encode(['errormesg'=>"This column is already full. Please select another column."]);
      exit;
    }




		$col_num = $input['move'];
		$piece_color = $input['piece_color'];
		$sql = 'call move_piece(?,?)';
		$st = $mysqli->prepare($sql);
		$st->bind_param('is', $col_num, $piece_color);
		$st->execute();

		header('Content-type: application/json');
		print json_encode(read_board(), JSON_PRETTY_PRINT);
	}
}
?>
