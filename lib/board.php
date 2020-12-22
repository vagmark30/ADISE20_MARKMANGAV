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
		$piece_color = $input['piece_color'];
		global $mysqli;
		$sql = 'call move_piece(?,?)';
		$st = $mysqli->prepare($sql);
		$st->bind_param('is', $col_num, $piece_color);
		$st->execute();

		header('Content-type: application/json');
		print json_encode(read_board(), JSON_PRETTY_PRINT);
	}
}
?>
