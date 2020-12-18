$(function() {
    draw_empty_board();

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
