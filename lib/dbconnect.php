<?php
require_once "local_config.php";
$DB_USER = "root";
$DB_PASS = "";

$host='localhost'; //vag esy to allazeis auto se localhost sketo.
$db = 'connect4';
$user=$DB_USER;
$pass=$DB_PASS;
global $mysqli;
$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" .
    $mysqli->connect_errno . ") " . $mysqli->connect_error;
}?>
