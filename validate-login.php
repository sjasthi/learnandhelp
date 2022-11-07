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

$sql = "SELECT Role FROM users WHERE Email='$usermail' AND Hash=sha1('$password');";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $role = $result -> fetch_assoc()["Role"];
    setcookie("username", $usermail, strtotime('+30 days'));
    setcookie("role", $role, strtotime('+30 days'));
    if ($role == 'admin') {
        header('Location:administration.php');
    } else {
        header('Location:registration_form.php');
    }
} else {
    header('Location:create_account.php');
}
$conn->close();
?>
