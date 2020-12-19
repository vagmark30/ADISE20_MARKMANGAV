<?php

require_once "lib/board.php"
require_once "lib/dbconnect.php";
require_once "lib/game.php";
require_once "lib/users.php";

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'), true);

//genika troll
switch($r=array_shift($request)){
  case 'board' :
    switch($b=array_shift($request)){
      case 'reset':
          reset_board();
          break;
      case 'move':
          handle_board($method, $input);
          break;
      case '':
          handle_board($method, $input);
          break;
    }
  case: 'status':
    if(sizeof($request)==0){
      show_status();
    }
    else {
      header("HTTP/1.1 404 Not Found");
    }
    break;
  case 'players':
      handle_player($method,$request,$input);
      break;
    default: header("HTTP/1.1 404 Not Found")
}

function handle_board($method,$input){
  if($method=='GET'){
    show_board();
  }
  else if($method=='POST'){
    do_move($input);
  }
}

function handle_player($method,$request,$input){
  if ($method == 'GET') {
      show_user($input['pawn_color']);
  } else if ($method == 'PUT') {
      set_user($input);
  }
}
?>
