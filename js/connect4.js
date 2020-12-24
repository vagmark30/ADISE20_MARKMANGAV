var me={token:null,piece_color:null};
var game_status={};
var board={};
var last_update=new Date().getTime();
var timer=null;

$(function() {
    draw_empty_board();
    fill_board();
  	$('#connect4_login').click( login_to_game);
    $('#connect4_reset').click( reset_game);
    $('#play_btn').click(move);
    update_game_status();
});

function draw_empty_board(p) {
var board = '<table id="connect4_board">'
for (var i = 1; i <= 6; i++) {
    board += '<tr>';
    for (var j = 1; j <= 7; j++) {
        board += '<td class="connect4_square" id="square_' + i + '_' + j + '">' + i + ',' + j + '</td>';
    }
    board += '</tr>';
}
board += '</table>'

$('#connect4_board_div').html(board);
}

function fill_board() {
    $.ajax({
        url: "connect4.php/board/",
        method: 'GET',
        dataType: 'json',
        headers: { "X-Token": me.token },
        success: fill_board_with_data,
        error: fill_board_errored
    });
}
function fill_board_errored(data){
  console.log(data);
}
function fill_board_with_data(data){
  for(var i=0; i<data.length ; i++){
    var o = data[i];
    var id = '#square_'+o.x +'_'+o.y;
    if(o.piece_color == 'Y'){
      $(id).css('background-color', 'yellow');
    }
    else if(o.piece_color == 'R'){
      $(id).css('background-color', 'red');
    }
  }
}

function login_to_game(){
  if($('#nickname').val()==''){
    alert('Πρέπει να επιλέξετε ένα nickname');
    return;
  }
  var chooseColor = $('#chooseColor').val();
  draw_empty_board(chooseColor);
  fill_board();

  $.ajax({
    url: "connect4.php/players/",
    method: 'PUT',
    dataType: "json",
    headers: { "X-Token": me.token },
    contentType: 'application/json',
    data: JSON.stringify({ nickname: $('#nickname').val(), piece_color: chooseColor }),
    success: login_res,
    error: login_er
  })
}

function login_res(data){
  me = data[0];
  console.log(me);
  $('#game_initializer').hide();
  console.log(data);
  update_game_status();
}

function login_er(data,y,z,c){
  var x = data.responseJSON;
  alert(x);
}

function update_game_status() {
    $.ajax({
        url: "connect4.php/status/",
        headers: { "X-Token": me.token },
        success: update_status
    });
}

function update_status(data){
  status = data[0].p_turn;
  console.log(status);
  console.log(data);
  fill_board();
  // if (game_status.status == 'aborted') {
  //     $('#gamepad').hide(2000);
  //     timer = setTimeout(function() { update_game_status(); }, 4000);
  // } else if (game_status.status == 'ended') {
  //     $('#gamepad').hide(2000);
  //     timer = setTimeout(function() { update_game_status(); }, 2000);
  // } else {
      if (status == me.piece_color && me.piece_color != null) {
          $('#gamepad').show(2000);
          document.getElementById("play_btn").disabled = false;
          timer = setTimeout(function() { update_game_status(); }, 10000);
      } else {
          $('#gamepad').hide(2000);
          timer = setTimeout(function() { update_game_status(); }, 4000);
      }
  // }
  //xrhsh toy gamepad
}

function reset_game(){
  $.ajax({
      url: "connect4.php/board/",
      headers: { "X-Token": me.token },
      method: 'POST',
      success: draw_empty_board
  });

  $('#game_initializer').show(2000);
  $('#nickname').val("");
  me = { nickname: null, token: null, piece_color: null };
  update_game_status();

}

function move(){
  var move = $('#col_move').val();
  var pc= me.piece_color;
  console.log(move);

  $.ajax({
      url: "connect4.php/board/",
      method: 'PUT',
      dataType: 'json',
      headers: { "X-Token": me.token },
      contentType: 'application/json',
      data: JSON.stringify({ move: move, piece_color:pc }),
      success: moved,
      error: login_er
  });
  document.getElementById("play_btn").disabled = true;
}

function moved(){
  console.log("mphke moved");
  update_game_status();
  fill_board();
}
