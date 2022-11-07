<?php
include 'show-navbar.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learn_and_help_db";

$connection = new mysqli($servername, $username, $password, $dbname);

if ($connection === false) {
	die("Failed to connect to database: " . mysqli_connect_error());
}
if (isset($_POST['action'])) {
	$action = $_POST['action'];
} else {
	$action = '';
}

if ($action == 'edit' or $action == 'add' or $action == 'admin_edit'){
	$sponsor_name = $_POST['sponsers-name'];
	$sponsor_email = $_POST['sponsers-email'];
	$sponsor_phone = $_POST['sponsers-phone'];
	$spouse_name = $_POST['spouses-name'];
	$spouse_email = $_POST['spouses-email'];
	$spouse_phone = $_POST['spouses-phone'];
	$student_id = 1; // FIXME: Grab this from the Login.
	$class = $_POST['role'];
	$class_id = 1; // FIXME: Grab this from the chosen class...
	$cause = $_POST['cause'];
	$timestamp = date("Y-m-d");

} elseif (isset($_COOKIE['email'])){
		$student_email = $_COOKIE['email'];
	$sql = "select r.Sponsor_Name, r.Sponsor_Email, r.Sponsor_Phone_Number, r.Spouse_Name, r.Spouse_Email, r.Spouse_Phone_Number, u.First_Name, u.Phone, c.Class_Name, r.Cause from registrations r left join users u on u.User_Id = r.Student_ID LEFT join classes c on c.Class_Id = r.Class";
    // $sql = "SELECT * FROM registrations WHERE Student_Email = '$student_email'";
    $row = mysqli_fetch_array(mysqli_query($connection, $sql));

		$action = '';
    $db_id = $row[0];
    $sponsor_name = $row[1];
    $sponsor_email = $row[2];
    $sponsor_phone = $row[3];
    $spouse_name = $row[4];
    $spouse_email = $row[5];
    $spouse_phone = $row[6];
    $student_name = $row[7];
    $student_phone = $row[9];
    $class_name = $row[10];
    $cause = $row[11];

}

switch ($class){
	case "py1":
		$class = "Python 101";
		$class_id = 1;
		break;
	case "py2": // FIXME: does not exist
		$class = "Python 201";
		$class_id = 3;
		break;
	case "java1":
		$class = "Java 101";
		$class_id = 2;
		break;
	case "java2": // FIXME: does not exist
		$class = "Java 201";
		$class_id = 4;
}

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
	setcookie('email', $student_email);
	$sql = "INSERT INTO registrations VALUES (
		NULL,
		'$sponsor_name',
		'$sponsor_email',
		'$sponsor_phone',
		'$spouse_name',
		'$spouse_email',
		'$spouse_phone',
		'$student_id',
		'$class_id',
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
			Student_ID = '$student_id',
			Class = '$class_id',
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
			Student_ID = '$student_id',
			Class = '$class_id',
			Cause = '$cause',
			Modified_Time = '$timestamp'
			WHERE Reg_Id = '$Reg_Id';";

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
  <body>
  <header class=\"inverse\">
      <div class=\"container\">
        <h1> <span class=\"accent-text\">Registration Submitted</span></h1>
      </div>";
      show_navbar();
echo    "</header>
		<h3> Registration Details </h3>
    <div id=\"container_2\">
		<form action=\"registration_edit.php\" method = \"post\">
        <!---Sponsors Section -->
        <label id=\"name-label\"><b>Sponsor's Name:</b> $sponsor_name</label><br>
        <input type=\"hidden\" id=\"action\" name=\"action\" value=\"edit\">
        <label id=\"sponsers-email-label\"> <b>Sponsor's Email:</b> $sponsor_email</label><br>
		<label id=\"sponsors-number-label\"><b>Sponsor's Phone Number:</b> $sponsor_phone</label><br>
        <input type=\"hidden\" id=\"sponsers-name\" name=\"sponsers-name\" class=\"form\" value=\"$sponsor_name\"><!--name--->
		<input type=\"hidden\" id=\"sponsers-email\" name=\"sponsers-email\" class=\"form\" value=\"$sponsor_email\"><br><!---email-->
        <input type=\"hidden\" id=\"sponsers-phone\" name=\"sponsers-phone\" value=\"$sponsor_phone\">

        <br>
        <!---Spouse Section -->
        <label id=\"spouses-name-label\"><b>Spouse's Name:</b> $spouse_name</label><br>

        <label id=\"spouses-email-label\"> <b>Spouse's Email:</b> $spouse_email</label><br>

        <label id=\"spouses-number-label\"><b>Spouse's Phone Number:</b> $spouse_phone</label><br>
		<input type=\"hidden\" id=\"spouses-name\" name=\"spouses-name\" class=\"form\" value=\"$spouse_name\"><!--name--->
		<input type=\"hidden\" id=\"spouses-email\" name=\"spouses-email\" class=\"form\" value=\"$spouse_email\"><br><!---email-->
        <input type=\"hidden\" id=\"spouses-phone\" name=\"spouses-phone\" value=\"$spouse_phone\">

        <br>
        <!---Student Section -->
        <label id=\"students-name-label\"><b>Student's Name:</b> $student_name</label><br>

        <label id=\"students-email-label\"><b>Student's Email:</b> $student_email</label><br>

        <label id=\"students-number-label\"><b>Student's Phone Number:</b> $student_phone</label><br>
		<input type=\"hidden\" id=\"students-name\" name=\"students-name\" class=\"form\" value=\"$student_name\"><!--name--->
		<input type=\"hidden\" id=\"students-email\" name=\"students-email\" class=\"form\" value=\"$student_email\"><br><!---email-->
        <input type=\"hidden\" id=\"students-phone\" name=\"students-phone\" value=\"$student_phone\">

        <br>
        <label id=\"class\"><b>Selected Class:</b> $class</label><br>
		<input type=\"hidden\" id=\"class\" name=\"class\" value=\"$class\">
		<!--dropdown--->
		<p><b>Cause:</b> $cause</p><br>
		<input type=\"hidden\" id=\"cause\" name=\"cause\" value=\"$cause\">
		<br>
		<input type='hidden' name='action' value='edit'>
		<input type=\"submit\" id=\"submit-registration\" name=\"submit\" value=\"Edit\"></a>
		<br><br>
	</div>
  </body>
</html>
";
?>
