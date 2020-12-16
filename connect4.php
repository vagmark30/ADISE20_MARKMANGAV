<?php

require_once "lib/board.php"

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));
$input = json_decode(file_get_contents('php://input'), true);

//genika troll 
switch($r=array_shift($request)){
  case 'board' :
    switch($b=array_shift($request)){
      //troll stuff
    }
  case: 'status':
    if(sizeof($request)==0){/*show_status method*/ ;}
    else {header("HTTP/1.1 404 Not Found");}
    break;
  case 'players':
    handle_player($method,$request,$input);
      break;
    default: header("HTTP/1.1 404 Not Found")
}

function handle_board($method){
  if($method=='GET'){
    show_board();
  }
  else if($method=='POST'){
    reset_board();
  }
}

function handle_player($method){

}
?>
