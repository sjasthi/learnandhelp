<?php
require 'db_configuration.php';

$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}

if (!(isset($_SESSION['email']))) {
	header('Location: login.php');
}

include 'show-navbar.php';
$connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

if ($connection === false) {
	die("Failed to connect to database: " . mysqli_connect_error());
}

if (isset($_POST['action'])) {
	$action = $_POST['action'];
} else {
	$action = '';
}

if($action == 'admin_edit_class'){
	$Class_Id = $_POST['Class_Id'];
	$Class_Name = $_POST["Class_Name"];
	$Description = $_POST["Description"];
} else {
	$Class_Id = $_SESSION['Class_Id'];
    $sql = "SELECT * FROM classes WHERE Class_Id = '$Class_Id'";
    $row = mysqli_fetch_array(mysqli_query($connection, $sql));

		$action = '';
		$Class_Id = $row['Class_Id'];
		$class_Name = $row['Class_Name'];
		$description = $row['Description'];
}

if($action == "admin_edit_class") {
	$Class_Id = $_POST['Class_Id'];
	$sql = "UPDATE classes SET
			Class_Name = '$Class_Name',
			Description = '$Description'
			WHERE Class_Id = '$Class_Id';";
	$_SESSION['message'] = '<h4>Edits Submitted<h4><br/>';
	//	header("Location: admin_edit_class.php");
}

if (!mysqli_query($connection, $sql)) {
	echo("Error description: " . mysqli_error($connection));
}

mysqli_close($connection);

?>
