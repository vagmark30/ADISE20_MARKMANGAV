<!DOCTYPE html>
<html>
<head>
    <title>Connect4</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/connect4.js"></script>
    <link rel="stylesheet" href="css/connect4.css">
</head>
<body>

<h2>Connect 4</h2>
<button  style="margin:20px" id='connect4_reset'> Reset</button>
<div id='game_initializer'>
  <input id='nickname'>
  <select id='chooseColor'>
    <option value='R'>Red</option>
    <option value='Y'>Yellow</option>
  </select>
  <button id='connect4_login'>ΕΙΣΟΔΟΣ ΣΤΟ ΠΑΙΧΝΙΔΙ</button>
</div>
<div>
    <div id='gamepad'>
        <div>
            Eπέλεξε την στήλη που θέλεις να τοποθετήσεις τον δίσκο:<br>
            <select id='col_move'>
                <option value="1">Στήλη 1</option>
                <option value="2">Στήλη 2</option>
                <option value="3">Στήλη 3</option>
                <option value="4">Στήλη 4</option>
                <option value="5">Στήλη 5</option>
                <option value="6">Στήλη 6</option>
                <option value="7">Στήλη 7</option>
            </select>
            <button id="play_btn">ΠΑΙΞΕ</button>
        </div>
    </div>
</div>
<div id="connect4_board_div">

</body>
</html>
