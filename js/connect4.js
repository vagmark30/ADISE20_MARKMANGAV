$(function() {
    draw_empty_board();
    fill_board();
  	$('#connect4_login').click( login_to_game);
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
    //var c = (o.piece!=null)?o.piece_color+o.piece:'';
    //$(id).addClass(o.b_color+'#square_').html(in);
  }
}

function login_to_game(){
  if($('#username').val()==''){
    alert('Πρέπει να επιλέξετε ένα username');
    return;
  }
  var chooseColor = $('#chooseColor').val();
  draw_empty_board(chooseColor);
  fill_board();

  $.ajax({
    url: "connect4.php/players/",
    method: 'PUT',
    dataType: "json",
    contentType: 'application/json',
    data: JSON.stringify({ nickname: $('#username').val(), pawn_color: chooseColor }),
    success: login_res,
    error: login_er
  })
}

function login_res(data){
  mes = data[0];
  $('#game_initializer').hide();
  console.log("mphke");
  console.log(data);
  //updates
}

function login_er(data,y,z,c){
  var x = data.responseJSON;
  console.log(data);
  console.log(x);
  console.log(y);
  console.log(z);
  console.log(c);
}
