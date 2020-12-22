<?php
function convert_board(&$orig_board) {
	$board=[];
	foreach($orig_board as $i=>&$row) {
		$board[$row['x']][$row['y']] = &$row;
	}
  echo $board;
	return($board);
}

function check_winner(){
  global $mysqli;
  $orig_board = read_board();
  $board = convert_board($orig_board);

  $RedWin = false;
  $YellowWin = false;

  //horizontal board check
  for ($j = 0; $j<3 ; $j++ ){
        for ($i = 0; $i<7; $i++){
            if ($board[$i][$j]['piece_color'] == 'R' && $board[$i][$j+1]['piece_color'] == 'R' && $board[$i][$j+2]['piece_color'] == 'R' && $board[$i][$j+3]['piece_color'] == 'R'){
                $RedWin=true;
                break;
            }
            else if($board[$i][$j]['piece_color'] == 'Y' && $board[$i][$j+1]['piece_color'] == 'Y' && $board[$i][$j+2]['piece_color'] == 'Y' && $board[$i][$j+3]['piece_color'] == 'Y'){
                $YellowWin=true;
                break;
            }
        }
  }

  //vertical board check
  for ($i = 0; $i<4 ; $i++ ){
    for ($j = 0; $j<6; $j++){
        if ($board[$i][$j]['piece_color'] == 'R' && $board[$i+1][$j]['piece_color'] == 'R' && $board[$i+2][$j]['piece_color'] == 'R' && $board[$i+3][$j]['piece_color'] == 'R'){
          $RedWin=true;
          break;
        }
        else if($board[$i][$j]['piece_color'] == 'Y' && $board[$i+1][$j]['piece_color'] == 'Y' && $board[$i+2][$j]['piece_color'] == 'Y' && $board[$i+3][$j]['piece_color'] == 'Y'){
          $YellowWin=true;
          break;
        }
    }
  }

  //ascending diagonia board check
  for ($i=3; $i<7; $i++){
        for ($j=0; $j<3; $j++){
            if ($board[$i][$j]['piece_color'] == 'R' && $board[$i-1][$j+1]['piece_color'] == 'R' && $board[$i-2][$j+2]['piece_color'] == 'R' && $board[$i-3][$j+3]['piece_color'] == 'R'){
              $RedWin=true;
              break;
            }
            else if($board[$i][$j]['piece_color'] == 'Y' && $board[$i-1][$j+1]['piece_color'] == 'Y' && $board[$i-2][$j+2]['piece_color'] == 'Y' && $board[$i-3][$j+3]['piece_color'] == 'Y'){
              $YellowWin=true;
              break;
            }
        }
    }

    //descending diagonia board check
    for ($i=3; $i<7; $i++){
      for ($j=3; $j<6; $j++){
        if ($board[$i][$j]['piece_color'] == 'R' && $board[$i-1][$j+1]['piece_color'] == 'R' && $board[$i-2][$j-2]['piece_color'] == 'R' && $board[$i-3][$j-3]['piece_color'] == 'R'){
          $RedWin=true;
          break;
        }
        else if($board[$i][$j]['piece_color'] == 'Y' && $board[$i-1][$j+1]['piece_color'] == 'Y' && $board[$i-2][$j-2]['piece_color'] == 'Y' && $board[$i-3][$j-3]['piece_color'] == 'Y'){
          $YellowWin=true;
          break;
        }
    }
  //check who won
  if($RedWin){
    $sql = "update game_status set status='ended', result='R' where p_turn is not null and status='started'";
    $st = $mysqli->prepare($sql);
    $r = $st->execute();
  }
  else if($YellowWin){
    $sql = "update game_status set status='ended', result='Y',p_turn=null where p_turn is not null and status='started'";
    $st = $mysqli->prepare($sql);
    $r = $st->execute();
  }
  else{
    //an akoma de kerdise kaneis
    break;
  }
}

?>
