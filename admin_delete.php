<?php
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

$sql = "DELETE FROM registrations WHERE Reg_Id = " . $_POST['Reg_Id'];
$result = $conn->query($sql);

$conn->close();
header("Location: admin_registrations.php");
?>
