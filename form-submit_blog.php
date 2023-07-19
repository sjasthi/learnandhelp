<?php
require 'db_configuration.php';

$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}

include 'show-navbar.php';
$connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

if ($connection === false) {
	die("Failed to connect to database: " . mysqli_connect_error());
}
if (isset($_POST['submit'])) {
	$action = $_POST['submit'];
} else {
	$action = '';
}

if ($action){
	$s_name = $_POST['s-name'];
	$s_id = $_POST['Id'];
	$s_email = $_POST['s-email'];
	$s_category = $_POST['category'];
	$username = $_POST['s-contact'];
	$s_pwd = $_POST['pwd'];

	$Created_Time  = date('Y-m-d H:i:s');
	$Modified_Time = $Created_Time	;

	$sql = "INSERT INTO school_user (school_name, school_id, contact_email, category, username, passwd) VALUES(
		
		'$s_name',
		'$s_id',
		'$s_email',
		'$s_category',
		'$username',
		'$s_pwd'
	);";
	$result = mysqli_query($connection, $sql);
	
	
}
mysqli_close($connection);
header('Location:admin_schoolusersrole.php');
exit();

?>
