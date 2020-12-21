<?php

function show_users(){
  global $mysqli;
  $query = 'select nickname,piece_color from players';
  $st = $mysqli->prepare($sql);
  $st->execute();
  $result = $st->get_result();
  header('Content-type: application/json');
  print json_encode($result->fetch_all(MYSQLI_ASSOC),JSON_PRETTY_PRINT);
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
  //dinw token ston user me update
  $nickname = $input['nickname'];
  $piece_color = $input['piece_color'];
  global $mysqli;
  $sql3 = 'update players set nickname=?, token=md5(CONCAT( ?, NOW())) where piece_color=?';
  $st3 = $mysqli->prepare($sql3);
  $st3->bind_param('sss', $nickname, $nickname, $piece_color);
  $st3->execute();

  //update_status();
  $sql4 = 'select * from players where piece_color=?';
  $st4 = $mysqli->prepare($sql4);
  $st4->bind_param('s', $piece_color);
  $st4->execute();
  $res4 = $st4->get_result();
  header('Content-type: application/json');
  print json_encode($res4->fetch_all(MYSQLI_ASSOC), JSON_PRETTY_PRINT);
}

function handle_user(){

}
?>
