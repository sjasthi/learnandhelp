<<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$dbname = "learn_and_help_db";
$username = "root";
$password = "";

$mysqli = new mysqli($host,$username,$password,$dbname);
                     
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;