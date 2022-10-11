<?php
global $username;
$username = $_POST["usermail"];
setcookie("username", $username, strtotime('+30 days'));
header('Location:homepage.phtml');
?>