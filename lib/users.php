<?php

function show_users(){
  global $mysqli;
  $query = 'select nickname,piece_color from players';
  $st = $mysqli->prepare($query);
  $st->execute();
  $result = $st->get_result();
  header('Content-type: application/json');
  print json_encode($result->fetch_all(MYSQLI_ASSOC),JSON_PRETTY_PRINT);
}

//an vrei null stous players petaei error
function show_users_active(){
  global $mysqli;
  $query = 'select count(*) as p from players where nickname is not null';
  $st = $mysqli->prepare($query);
  $st->execute();
  $result = $st->get_result();
  $active_players = $result->fetch_assoc()['p'];
  return($active_players);
}

function show_user($color){
  global $mysqli;
  $query = 'select nickname,piece_color from players where piece_color=?';
  $st = $mysqli->prepare($sql);
  $st->blind_param('s',$color);
  $st->execute();
  $result = $st->get_result();
  header('Content-type: application/json');
  print json_encode($result->fetch_all(MYSQLI_ASSOC),JSON_PRETTY_PRINT);
}

function set_user($input){

  //elegxous gia ton user
  if(!isset($input['nickname'])) {
  header("HTTP/1.1 400 Bad Request");
  print json_encode(['errormesg'=>"No nickname given."]);
  exit;
}
$nickname=$input['nickname'];
$piece_color = $input['piece_color'];
global $mysqli;
$sql = 'select count(*) as c from players where piece_color=? and nickname is not null';
$st = $mysqli->prepare($sql);
$st->bind_param('s',$piece_color);
$st->execute();
$res = $st->get_result();
$r = $res->fetch_all(MYSQLI_ASSOC);
if($r[0]['c']>0) {
  header("HTTP/1.1 400 Bad Request");
  print json_encode(['errormesg'=>"This color is already used. Please select another color."]);
  exit;
}
  //dinw token ston user me update
  $nickname = $input['nickname'];
  $piece_color = $input['piece_color'];
  global $mysqli;
  $sql3 = 'update players set nickname=?, token=md5(CONCAT( ?, NOW())) where piece_color=?';
  $st3 = $mysqli->prepare($sql3);
  $st3->bind_param('sss', $nickname, $nickname, $piece_color);
  $st3->execute();

  update_game_status();
  $sql4 = 'select * from players where piece_color=?';
  $st4 = $mysqli->prepare($sql4);
  $st4->bind_param('s', $piece_color);
  $st4->execute();
  $res4 = $st4->get_result();
  header('Content-type: application/json');
  print json_encode($res4->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
}

?>
