<?php

function show_status(){
  global $mysqli;

  check_abort();

  $query = 'select * from game_status';
  $st = $mysqli->prepare($query);

  $st->execute();
  $result = $st->get_result();

  header('Content-type: application/json');
  print json_encode($result->fetch_all(MYSQLI_ASSOC),JSON_PRETTY_PRINT);
}

function check_abort(){
  //check if game aborted
}

function update_game_status(){

}

?>
