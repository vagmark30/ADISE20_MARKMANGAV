<?php

function show_users(){
  global mysqli;
  $query = 'select nickname,piece_color from players';
  $st = $mysqli->prepare($sql);
  $st->execute();
  $result = $st->get_result();
  header('Content-type: application/json');
  print json_encode($result->fetch_all(MYSQLI_ASSOC),JSON_PRETTY_PRINT);
}

function show_user($color){
  global mysqli;
  $query = 'select nickname,piece_color from players where piece_color=?';
  $st = $mysqli->prepare($sql);
  $st->blind_param('s',$color);
  $st->execute();
  $result = $st->get_result();
  header('Content-type: application/json');
  print json_encode($result->fetch_all(MYSQLI_ASSOC),JSON_PRETTY_PRINT);
}

function set_user(){
  //elegxous gia ton user
  //dinw token ston user me update 
}

function handle_user(){

}
?>
