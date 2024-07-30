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
$User_Id = $_SESSION['User_Id'];

// Validate and sanitize form input
$sponsor_name = isset($_POST['sponsor1s-name']) ? htmlspecialchars($_POST['sponsor1s-name']) : '';
$sponsor_email = isset($_POST['sponsor1s-email']) ? filter_var($_POST['sponsor1s-email'], FILTER_SANITIZE_EMAIL) : '';
$sponsor_phone = isset($_POST['sponsor1s-phone']) ? htmlspecialchars($_POST['sponsor1s-phone']) : '';
$sponsor2_name = isset($_POST['sponsor2s-name']) ? htmlspecialchars($_POST['sponsor2s-name']) : '';
$sponsor2_email = isset($_POST['sponsor2s-email']) ? filter_var($_POST['sponsor2s-email'], FILTER_SANITIZE_EMAIL) : '';
$sponsor2_phone = isset($_POST['sponsor2s-phone']) ? htmlspecialchars($_POST['sponsor2s-phone']) : '';
$student_name = isset($_POST['students-name']) ? htmlspecialchars($_POST['students-name']) : '';
$student_email = isset($_POST['students-email']) ? filter_var($_POST['students-email'], FILTER_SANITIZE_EMAIL) : '';
$student_phone = isset($_POST['students-phone']) ? htmlspecialchars($_POST['students-phone']) : '';
$class_id = isset($_POST['class']) ? htmlspecialchars($_POST['class']) : '';
$batch = isset($_POST['batch']) ? htmlspecialchars($_POST['batch']) : '';
$reg_id = isset($_POST['reg_id']) ? htmlspecialchars($_POST['reg_id']) : '';
$timestamp = date("Y-m-d H:i:s");


//Find name of registered class from Class_Id
$classname_query = "SELECT Class_Name FROM classes where Class_Id = $class_id";
$classname_result = $connection->query($classname_query);
$classname_row = $classname_result->fetch_assoc();
$class = $classname_row["Class_Name"];

//WIP: Add/update user phone number. (Possible TODO: do the same for other information?)
$update_phone_query = "UPDATE users SET Phone = '$student_phone' WHERE User_Id = '$User_Id';";
$update_phone_result = $connection->query($update_phone_query);

if ($action == 'add') {
	$User_Id = $_SESSION['User_Id'];
	$sql = "INSERT INTO registrations VALUES (
			NULL,
			'$sponsor_name',
			'$sponsor_email',
			'$sponsor_phone',
			'$sponsor2_name',
			'$sponsor2_email',
			'$sponsor2_phone',
			'$student_name',
			'$student_email',
			'$student_phone',
			'$class_id',
			'$timestamp',
			'$timestamp',
			'$batch',
			'$User_Id');";
}
elseif ($action == "edit" || "admin_edit") {
	$sql = "UPDATE registrations SET
			Sponsor1_Name = '$sponsor_name',
			Sponsor1_Email = '$sponsor_email',
			Sponsor1_Phone_Number = '$sponsor_phone',
			Sponsor2_Name = '$sponsor2_name',
			Sponsor2_Email = '$sponsor2_email',
			Sponsor2_Phone_Number = '$sponsor2_phone',
			Student_Name = '$student_name',
			Class_Id = '$class_id',
			Batch_Name = '$batch',
			Modified_Time = '$timestamp'
			WHERE Reg_Id = '$reg_id'";
}

if (!mysqli_query($connection, $sql)) {
	echo("Error description: " . mysqli_error($connection));
  }

mysqli_close($connection);

echo "<!DOCTYPE html>
<!DOCTYPE html>
  <head>
    <title>Learn and Help</title>
		<link rel=\"icon\" href=\"images/icon_logo.png\" type=\"image/icon type\">
    <link href=\"https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap\" rel=\"stylesheet\">
    <link href=\"css/main.css\" rel=\"stylesheet\">
  </head>
  <body>";
		show_navbar();
	echo  "<header class=\"inverse\">
      <div class=\"container\">
        <h1> <span class=\"accent-text\">Registration Submitted</span></h1>
      </div>
  		</header>
		<h3> Registration Details </h3>
    <div id=\"container_2\">
		<form action=\"registration_edit.php\" method = \"post\">
		<input type=\"hidden\" name=\"reg_id\" value=\"$reg_id\">";

	if (!empty($sponsor_name)) {
        echo "<!---Sponsors Section -->
        <label id=\"name-label\"><b>Sponsor 1's Name:</b> $sponsor_name</label><br>
        <input type=\"hidden\" id=\"action\" name=\"action\" value=\"edit\">
        <label id=\"sponsor1s-email-label\"> <b>Sponsor 1's Email:</b> $sponsor_email</label><br>
		<label id=\"sponsors-number-label\"><b>Sponsor 1's Phone Number:</b> $sponsor_phone</label><br>";
	}
     echo "<input type=\"hidden\" id=\"sponsor1s-name\" name=\"sponsor1s-name\" class=\"form\" value=\"$sponsor_name\"><!--name--->
		<input type=\"hidden\" id=\"sponsor1s-email\" name=\"sponsor1s-email\" class=\"form\" value=\"$sponsor_email\"><!---email-->
        <input type=\"hidden\" id=\"sponsor1s-phone\" name=\"sponsor1s-phone\" value=\"$sponsor_phone\"><br>";
		
	if (!empty($sponsor2_name)) {
        echo "<!---sponsor2 Section -->
        <label id=\"sponsor2s-name-label\"><b>Sponsor 2's Name:</b> $sponsor2_name</label><br>

        <label id=\"sponsor2s-email-label\"> <b>Sponsor 2's Email:</b> $sponsor2_email</label><br>

        <label id=\"sponsor2s-number-label\"><b>Sponsor 2's Phone Number:</b> $sponsor2_phone</label><br><br>";
	}
	echo "<input type=\"hidden\" id=\"sponsor2s-name\" name=\"sponsor2s-name\" class=\"form\" value=\"$sponsor2_name\"><!--name--->
		<input type=\"hidden\" id=\"sponsor2s-email\" name=\"sponsor2s-email\" class=\"form\" value=\"$sponsor2_email\"><!---email-->
        <input type=\"hidden\" id=\"sponsor2s-phone\" name=\"sponsor2s-phone\" value=\"$sponsor2_phone\">
	    <!---Student Section -->
        <label id=\"students-name-label\"><b>Student's Name:</b> $student_name</label><br>

        <label id=\"students-email-label\"><b>Student's Email:</b> $student_email</label><br>

        <label id=\"students-number-label\"><b>Student's Phone Number:</b> $student_phone</label><br>
		<input type=\"hidden\" id=\"students-name\" name=\"students-name\" class=\"form\" value=\"$student_name\"><!--name--->
		<input type=\"hidden\" id=\"students-email\" name=\"students-email\" class=\"form\" value=\"$student_email\"><br><!---email-->
        <input type=\"hidden\" id=\"students-phone\" name=\"students-phone\" value=\"$student_phone\">

        <label id=\"class\"><b>Selected Class:</b> $class</label><br><br>
		<input type=\"hidden\" id=\"class\" name=\"class\" value=\"$class\">
		<label id=\"batch\"><b>Selected Batch:</b> $batch</label><br><br>
		<input type=\"hidden\" id=\"batch\" name=\"batch\" value=\"$batch\">
		<input type='hidden' name='action' value='edit'>
		<input type=\"submit\" id=\"submit-registration\" name=\"submit\" value=\"Edit\"></a>
		<br><br>
	</div>
  </body>
</html>
";
?>