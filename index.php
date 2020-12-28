<!DOCTYPE html>
<html>
  <head>
    <title>Score 4</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/connect4.js"></script>
    <link rel="stylesheet" href="css/connect4.css">
  </head>
  <body>
    <div class="title_bar">
      <div>
        <h2>Score 4</h2>
      </div>
      <div class="center_btn">
        <div class="center_btn2">
          <button id='connect4_reset'>Reset</button>
        </div>
      </div>
    </div>
    <div id='game_info'>
      <div id='game_info2'>
        <label id="p_name"></label>
        <label id="p_color"></label>
      </div>
    </div>
    <div id="game">
      <div id='game_initializer'>
        <input id='nickname' placeholder="Name"/>
        <select id='chooseColor'>
          <option value='R'>Red</option>
          <option value='Y'>Yellow</option>
        </select>
        <button id='connect4_login'>Start</button>
      </div>
      <div id='gamepad'>
        <div id="text_move">Column: <br></div>
        <select id='col_move'>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
        </select>
        <button id="play_btn">Play</button>
      </div>
      <div id="board">
        <div id="connect4_board_div"></div>
      </div>
    </div>
  </body>
</html>
