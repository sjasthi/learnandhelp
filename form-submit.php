<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learn_and_help_db";

$connection = new mysqli($servername, $username, $password, $dbname);

if ($connection === false) {
	die("Failed to connect to database: " . mysqli_connect_error());
}

$action = $_POST['action'];
$sponsor_name = $_POST['sponsers-name'];
$sponsor_email = $_POST['sponsers-email'];
$sponsor_phone = $_POST['sponsers-phone'];
$spouse_name = $_POST['spouses-name'];
$spouse_email = $_POST['spouses-email'];
$spouse_phone = $_POST['spouses-phone'];
$student_name = $_POST['students-name'];
$student_email = $_POST['students-email'];
$student_phone = $_POST['students-phone'];
$class = $_POST['role'];
$cause = $_POST['cause'];
$timestamp = date("Y-m-d");
$_COOKIE['email'] = $student_email;
switch ($class){
	case "py1":
		$class = "Python 101";
		break;
	case "py2":
		$class = "Python 201";
		break;
	case "java1":
		$class = "Java 101";
		break;
	case "java2":
		$class = "Java 201";
}

switch ($cause){
	case "lib":
		$cause = "Library";
		break;
	case "Dig_class":
		$cause = "Digital Classroom";
		break;
	case "Other":
		$cause = "No Preference";
}

$sql = "SELECT * FROM Registrations WHERE Student_Email = '$student_email'";
if (mysqli_num_rows(mysqli_query($connection, $sql)) > 0)
{
	header('Location: registration_form.php');
	echo "That student email has already been registered.";
	die();
}

if($action == "edit") {
	$sql = "UPDATE Registrations SET 
			Sponsor_Name = '$sponsor_name', 
			Sponsor_Email = '$sponsor_email', 
			Sponsor_Phone_Number = '$sponsor_phone', 
			Spouse_Name = '$spouse_name', 
			Spouse_Email = '$spouse_email', 
			Spouse_Phone_Number = '$spouse_phone', 
			Student_Email = '$student_email', 
			Student_Phone_Number = '$student_phone', 
			Class = '$class', 
			Cause = '$cause', 
			Modified_Time = '$timestamp' 
			WHERE Student_Email = '$student_email';";	
	
}
else
	$sql = "INSERT INTO Registrations VALUES (
		NULL, 
		'$sponsor_name',
		'$sponsor_email', 
		'$sponsor_phone', 
		'$spouse_name', 
		'$spouse_email', 
		'$spouse_phone', 
		'$student_name', 
		'$student_email', 
		'$student_phone', 
		'$class', 
		'$cause', 
		'$timestamp', 
		'$timestamp');";

if (!mysqli_query($connection, $sql)) {
	echo("Error description: " . mysqli_error($connection));
  }
mysqli_close($connection);
echo 'show-button.php';
?>