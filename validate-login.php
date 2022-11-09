<?php

$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}

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

// Escape inputs to prevent SQL injection
$usermail = $conn->escape_string($_POST["usermail"]);
$account_password = $conn->escape_string($_POST["password"]);
$hash = sha1($account_password);

$sql = "SELECT Role, First_Name, User_Id FROM users WHERE Email='$usermail' AND Hash='$hash';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $entry = $result -> fetch_assoc();
    $_SESSION["email"] = $usermail;
    $_SESSION["role"] = $entry['Role'];
    $_SESSION["first_name"] = $entry['First_Name'];
    $_SESSION["User_Id"] = $entry['User_Id'];
    header('Location: homepage.php');
} else {
    echo "<script type='text/javascript'>alert('Invalid username or password');</script>";
}
$conn->close();
?>
