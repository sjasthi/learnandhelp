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
if ($action == 'edit' || $action == 'add' || $action == 'admin_edit') {
    // Validate and sanitize form input
    $sponsor_name = isset($_POST['sponsers-name']) ? htmlspecialchars($_POST['sponsers-name']) : '';
    $sponsor_email = isset($_POST['sponsers-email']) ? filter_var($_POST['sponsers-email'], FILTER_SANITIZE_EMAIL) : '';
    $sponsor_phone = isset($_POST['sponsers-phone']) ? htmlspecialchars($_POST['sponsers-phone']) : '';
    $spouse_name = isset($_POST['spouses-name']) ? htmlspecialchars($_POST['spouses-name']) : '';
    $spouse_email = isset($_POST['spouses-email']) ? filter_var($_POST['spouses-email'], FILTER_SANITIZE_EMAIL) : '';
    $spouse_phone = isset($_POST['spouses-phone']) ? htmlspecialchars($_POST['spouses-phone']) : '';
    $student_name = isset($_POST['students-name']) ? htmlspecialchars($_POST['students-name']) : '';
    $student_email = isset($_POST['students-email']) ? filter_var($_POST['students-email'], FILTER_SANITIZE_EMAIL) : '';
    $student_phone = isset($_POST['students-phone']) ? htmlspecialchars($_POST['students-phone']) : '';
    $class_id = isset($_POST['class']) ? htmlspecialchars($_POST['class']) : '';
	$batch = isset($_POST['batch']) ? htmlspecialchars($_POST['batch']) : '';
    $cause = isset($_POST['cause']) ? htmlspecialchars($_POST['cause']) : '';

    $timestamp = date("Y-m-d H:i:s");
} else {
    $sql = "SELECT * FROM registrations NATURAL JOIN classes NATURAL JOIN user_registrations WHERE User_Id = $User_Id";
    $row = mysqli_fetch_array(mysqli_query($connection, $sql));

		$action = '';
    $Reg_Id = $row['Reg_Id'];
		$sponsor_name = $row['Sponsor_Name'];
		$sponsor_email = $row['Sponsor_Email'];
		$sponsor_phone = $row['Sponsor_Phone_Number'];
		$spouse_name = $row['Spouse_Name'];
		$spouse_email = $row['Spouse_Email'];
		$spouse_phone = $row['Spouse_Phone_Number'];
		$student_name = $row['Student_Name'];
		$student_email = $row['Student_Email'];
		$student_phone = $row['Student_Phone_Number'];
		$class_id = $row['Class_Id'];
		$batch = $row['batch'];
		$cause = $row['Cause'];

}

// FIXME: Hardcoded in relation to database
// Correct method should pull the available classes from the database,
// Allow the user to select one using the interface, and then POST from there.
/*
switch ($class_id){
	case 2:
		$class = "Python 101";
		break;
	case 4:
		$class = "Python 201";
		break;
	case 1:
		$class = "Java 101";
		break;
	case 3:
		$class = "Java 201";
}
*/

//Find name of registered class from Class_Id
$classname_query = "SELECT Class_Name FROM classes where Class_Id = $class_id";
$classname_result = $connection->query($classname_query);
$classname_row = $classname_result->fetch_assoc();
$class = $classname_row["Class_Name"];

//WIP: Add/update user phone number. (Possible TODO: do the same for other information?)
$update_phone_query = "UPDATE users SET Phone = '$student_phone' WHERE User_Id = '$User_Id';";
$update_phone_result = $connection->query($update_phone_query);

switch ($cause){ // FIXME: Hardcoded in.
	case "lib":
		$cause = "Library";
		break;
	case "Dig_class":
		$cause = "Digital Classroom";
		break;
	case "Other":
		$cause = "No Preference";
}

if ($action == 'add') {
	$sql = "INSERT INTO registrations VALUES (
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
		'$class_id',
		'$batch',
		'$cause',
		'$timestamp',
		'$timestamp');";

} elseif($action == "edit") {
	$Reg_Id = $_POST['Reg_Id'];
	$sql = "UPDATE registrations SET
			Sponsor_Name = '$sponsor_name',
			Sponsor_Email = '$sponsor_email',
			Sponsor_Phone_Number = '$sponsor_phone',
			Spouse_Name = '$spouse_name',
			Spouse_Email = '$spouse_email',
			Spouse_Phone_Number = '$spouse_phone',
			Student_Name = '$student_name',
			Student_Email = '$student_email',
			Student_Phone_Number = '$student_phone',
			Class_Id = '$class_id',
			batch = '$batch',
			Cause = '$cause',
			Modified_Time = '$timestamp'
			WHERE Reg_Id = '$Reg_Id';";

} elseif($action == "admin_edit") {
	$Reg_Id = $_POST['Reg_Id'];
	$sql = "UPDATE registrations SET
			Sponsor_Name = '$sponsor_name',
			Sponsor_Email = '$sponsor_email',
			Sponsor_Phone_Number = '$sponsor_phone',
			Spouse_Name = '$spouse_name',
			Spouse_Email = '$spouse_email',
			Spouse_Phone_Number = '$spouse_phone',
			Student_Name = '$student_name',
			Student_Email = '$student_email',
			Student_Phone_Number = '$student_phone',
			Class_Id = '$class_id',
			batch = '$batch',
			Cause = '$cause',
			Modified_Time = '$timestamp'
			WHERE Reg_Id = '$Reg_Id';";

}

if (!mysqli_query($connection, $sql)) {
	echo("Error description: " . mysqli_error($connection));
  }
if ($action == 'add') {
	$Reg_Id = mysqli_insert_id($connection);
	$User_Id = $_SESSION['User_Id'];
	$sql = 'INSERT INTO user_registrations VALUES (' . $User_Id . ', ' . $Reg_Id .');';
	if (!mysqli_query($connection, $sql)) {
		echo("Error description: " . mysqli_error($connection));
	 }
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
				<input type='hidden' name='Reg_Id' value=$Reg_Id>";

	if (!empty($sponsor_name)) {
        echo "<!---Sponsors Section -->
        <label id=\"name-label\"><b>Sponsor's Name:</b> $sponsor_name</label><br>
        <input type=\"hidden\" id=\"action\" name=\"action\" value=\"edit\">
        <label id=\"sponsers-email-label\"> <b>Sponsor's Email:</b> $sponsor_email</label><br>
		<label id=\"sponsors-number-label\"><b>Sponsor's Phone Number:</b> $sponsor_phone</label><br>";
	}
     echo "<input type=\"hidden\" id=\"sponsers-name\" name=\"sponsers-name\" class=\"form\" value=\"$sponsor_name\"><!--name--->
		<input type=\"hidden\" id=\"sponsers-email\" name=\"sponsers-email\" class=\"form\" value=\"$sponsor_email\"><!---email-->
        <input type=\"hidden\" id=\"sponsers-phone\" name=\"sponsers-phone\" value=\"$sponsor_phone\"><br>";
		
	if (!empty($spouse_name)) {
        echo "<!---Spouse Section -->
        <label id=\"spouses-name-label\"><b>Spouse's Name:</b> $spouse_name</label><br>

        <label id=\"spouses-email-label\"> <b>Spouse's Email:</b> $spouse_email</label><br>

        <label id=\"spouses-number-label\"><b>Spouse's Phone Number:</b> $spouse_phone</label><br><br>";
	}
	echo "<input type=\"hidden\" id=\"spouses-name\" name=\"spouses-name\" class=\"form\" value=\"$spouse_name\"><!--name--->
		<input type=\"hidden\" id=\"spouses-email\" name=\"spouses-email\" class=\"form\" value=\"$spouse_email\"><!---email-->
        <input type=\"hidden\" id=\"spouses-phone\" name=\"spouses-phone\" value=\"$spouse_phone\">
	    <!---Student Section -->
        <label id=\"students-name-label\"><b>Student's Name:</b> $student_name</label><br>

        <label id=\"students-email-label\"><b>Student's Email:</b> $student_email</label><br>

        <label id=\"students-number-label\"><b>Student's Phone Number:</b> $student_phone</label><br>
		<input type=\"hidden\" id=\"students-name\" name=\"students-name\" class=\"form\" value=\"$student_name\"><!--name--->
		<input type=\"hidden\" id=\"students-email\" name=\"students-email\" class=\"form\" value=\"$student_email\"><br><!---email-->
        <input type=\"hidden\" id=\"students-phone\" name=\"students-phone\" value=\"$student_phone\">

        <label id=\"class\"><b>Selected Class:</b> $class</label><br>
		<input type=\"hidden\" id=\"class\" name=\"class\" value=\"$class\">
		<!--dropdown--->";
	if (!empty($cause)) {
		echo "<p><b>Cause:</b> $cause</p>";
	}
	echo "<input type=\"hidden\" id=\"cause\" name=\"cause\" value=\"$cause\">
		<br>
		<input type='hidden' name='action' value='edit'>
		<input type=\"submit\" id=\"submit-registration\" name=\"submit\" value=\"Edit\"></a>
		<br><br>
	</div>
  </body>
</html>
";
?>
