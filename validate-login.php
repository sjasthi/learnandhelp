<?php
global $usermail;
$usermail = $_POST["usermail"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learn_and_help_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Users WHERE Email='$usermail';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    setcookie("username", $usermail, strtotime('+30 days'));
    header('Location:homepage.php');
} else {
    header('Location:create_account.php');
}
$conn->close();
?>
