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
  global $mysqli;

  $sql = "update game_status set status='aborded', result=if(p_turn='R','Y','R'),p_turn=null where p_turn is not null and last_change<(now()-INTERVAL 5 MINUTE) and status='started'";
  $st = $mysqli->prepare($sql);
  $r = $st->execute();
}

function read_status(){
  global $mysqli;
  $sql = 'select * from game_status';
  $st = $mysqli->prepare($sql);
  $st->execute();
  $res = $st->get_result();
  $game_status = $res->fetch_assoc();
  return ($game_status);
}

function update_game_status(){
  global $mysqli;
  $status = read_status();
  $new_status = null;
  $p_turn = null;

  $sql = 'select count(*) as aborted from players where last_change<(NOW() - INTERVAL 20 MINUTE)';
  $stmt = $mysqli->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  $aborted = $result->fetch_assoc()['aborted'];
	if($aborted>0) {
    $stmt2 = $mysqli->prepare("UPDATE players SET nickname=NULL, token=NULL WHERE last_change<(NOW()-INTERVAL 20 MINUTE)");
    $stmt2->execute();
		if($status['status']=='started') {
			$new_status='aborted';
		}
  }

	$active_players = show_users_active();
	switch($active_players) {
		case 0:
      $new_status='not active';
      break;
		case 1:
      $new_status='initialized';
      break;
		case 2:
      $new_status='started';
				if($status['p_turn']==null) {
					$new_turn=rand(0,1) ? 'R' : 'Y';
				}
			break;
	}

	$sql = 'update game_status set status=?, p_turn=?';
	$st = $mysqli->prepare($sql);
	$st->bind_param('ss',$new_status,$new_turn);
	$st->execute();

}

?>
