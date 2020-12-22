<?php
require_once "lib/dbconnect.php";
require_once "lib/users.php";
require_once "lib/board.php";
require_once "lib/game.php";
require_once "lib/win_conditions.php";
ini_set('display_errors','on' );
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'), true);
if (isset($_SERVER['HTTP_X_TOKEN'])) {
    $input['token'] = $_SERVER['HTTP_X_TOKEN'];
}
//genika troll
switch($r=array_shift($request)){
  case 'board' :
    handle_board($method, $input);
    break;
  case 'status' :
      show_status();
      break;
  case 'players':
      handle_player($method, $input);
      break;
  default:
    header("HTTP/1.1 404 Not Found");
    print json_encode(['errormsg'=>"Problem with the API."]);
    exit;
}

function handle_board($method,$input){
  if($method=='GET'){
    show_board();
  }else if($method=='PUT'){
    move_piece($input);
  }else if ($method=='POST') {
    reset_board();
  }
}

function handle_player($method,$input){
  if ($method == 'GET') {
      show_user($input['piece_color']);
  } else if ($method == 'PUT') {
      set_user($input);
  }
}
?>
