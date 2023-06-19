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
if($action == 'admin_edit_school'){
	$name = $_POST["name"];
	$type = $_POST["type"];
	$category = $_POST["category"];
	$grade_level_start = $_POST["grade_level_start"];
	$grade_level_end = $_POST["grade_level_end"];
	$current_enrollment = $_POST["current_enrollment"];
	$address_text = $_POST["address_text"];
	$state_name = $_POST["state_name"];
	$state_code = $_POST["state_code"];
	$pin_code = $_POST["pin_code"];
	$contact_name = $_POST["contact_name"];
	$contact_designation = $_POST["contact_designation"];
	$contact_phone = $_POST["contact_phone"];
	$contact_email = $_POST["contact_email"];
	$status = $_POST["status"];
	$notes = $_POST["notes"];
}
else {
	$id = $_SESSION['id'];
    $sql = "SELECT * FROM schools WHERE id = '$id'";
    $row = mysqli_fetch_array(mysqli_query($connection, $sql));

		$action = '';
		$id = $row['id'];
		$name = $row["name"];
		$type = $row["type"];
		$category = $row["category"];
		$grade_level_start = $row["grade_level_start"];
		$grade_level_end = $row["grade_level_end"];
		$current_enrollment = $row["current_enrollment"];
		$address_text = $row["address_text"];
		$state_name = $row["state_name"];
		$state_code = $row["state_code"];
		$pin_code = $row["pin_code"];
		$contact_name = $row["contact_name"];
		$contact_designation = $row["contact_designation"];
		$contact_phone = $row["contact_phone"];
		$contact_email = $row["contact_email"];
		$status = $row["status"];
		$notes = $row["notes"];

}



if($action == "admin_edit_school") {
	$id = $_POST['id'];
	$sql = "UPDATE schools SET
			name = '$name',
			type = '$type',
			category = '$category',
			grade_level_start = '$grade_level_start',
			grade_level_end = '$grade_level_end',
			current_enrollment = '$current_enrollment',
			address_text = '$address_text',
			state_name = '$state_name',
			state_code = '$state_code',
			pin_code = '$pin_code',
			contact_name = '$contact_name',
			contact_designation = '$contact_designation',
			contact_phone = '$contact_phone',
			contact_email = '$contact_email',
			status = '$status',
			notes = '$notes'
			WHERE id = '$id';";
	header("Location: admin_schools.php");
}

if (!mysqli_query($connection, $sql)) {
	echo("Error description: " . mysqli_error($connection));
  }

mysqli_close($connection);

?>
