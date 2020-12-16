<?php
function show_board(){
  global $mysqli;

  $query = 'select * from board';
  $st = $mysqli->prepare($query);

  &st->execute();
  $res = $st->get_result();

  header('Content-type: application/json');
	print json_encode(read_board(), JSON_PRETTY_PRINT);
}

function reset_board(){
  global $mysqli;

  $query = 'CALL `clear_board`()';
  $mysqli->query($query);
  show_board();
}
?>
