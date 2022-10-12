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
if (mysqli_num_rows(mysqli_query($connection, $sql)) > 0 && $action != "edit")
{
	header('Location: registration_form.phtml');
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
echo "<!DOCTYPE html>
<html>
  <head>
    <link rel=\"icon\" href=\"images/logo.png\" type=\"image/icon type\">
    <title>Learn and Help</title>
    <link href=\"https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap\" rel=\"stylesheet\">
    <link href=\"css/main.css\" rel=\"stylesheet\">
  </head>
  <body>
    <?php include 'show-button.php'; ?>
    <header class=\"inverse\">
      <div class=\"container\">
        <img class =\"logo\" src=\"images/logo.png\" alt=\"Logo\">
        <h1> <span class=\"accent-text\">Registration Form</span></h1>
      </div>
      <div class=\"navbar\">
        <a href=\"homepage.phtml\">Home</a>
        <a href=\"#\">Instructors and Volunteers Sign Up</a>
        <a href=\"#\">Classes</a>
        <a href=\"#\">Testimonials</a>
        <a href=\"#\">Causes</a>
        <a href=\"meet_our_instructors.phtml\">Meet our Instructors</a>
        <a href=\"contact_us.phtml\">Contact Us</a>
        <a href=\"registration_form.phtml\" id=\"register\">Register Now</a>
		<div><?php getButton(); ?></div>
      </div>
    </header>
    <div id=\"container_2\">
		<form action=\"registration_edit.php\" method = \"post\">
        <!---Sponsors Section -->
        <label id=\"name-label\">Sponsor's Name: $sponsor_name</label><br>
        <input type=\"hidden\" id=\"action\" name=\"action\" value=\"edit\">
        <label id=\"sponsers-email-label\"> Sponsor's Email: $sponsor_email</label><br>
		<label id=\"sponsors-number-label\">Sponsor's Phone Number: $sponsor_phone</label><br>
        <input type=\"hidden\" id=\"sponsers-name\" name=\"sponsers-name\" class=\"form\" value=\"$sponsor_name\"><!--name--->
		<input type=\"hidden\" id=\"sponsers-email\" name=\"sponsers-email\" class=\"form\" value=\"$sponsor_email\"><br><!---email-->
        <input type=\"hidden\" id=\"sponsers-phone\" name=\"sponsers-phone\" value=\"$sponsor_phone\">


        <br>
        <br>
        <br>
        <!---Spouse Section -->
        <label id=\"spouses-name-label\">Spouse's Name: $spouse_name</label><br>

        <label id=\"spouses-email-label\"> Spouse's Email: $spouse_email</label><br>

        <label id=\"spouses-number-label\">Spouse's Phone Number: $spouse_phone</label><br>
		<input type=\"hidden\" id=\"spouses-name\" name=\"spouses-name\" class=\"form\" value=\"$spouse_name\"><!--name--->
		<input type=\"hidden\" id=\"spouses-email\" name=\"spouses-email\" class=\"form\" value=\"$spouse_email\"><br><!---email-->
        <input type=\"hidden\" id=\"spouses-phone\" name=\"spouses-phone\" value=\"$spouse_phone\">

        <br>
        <br>
        <br>
        <!---Student Section -->
        <label id=\"students-name-label\">Student's Name: $student_name</label><br>

        <label id=\"students-email-label\"> Student's Email: $student_email</label><br>

        <label id=\"students-number-label\">Student's Phone Number: $student_phone</label><br>
		<input type=\"hidden\" id=\"students-name\" name=\"students-name\" class=\"form\" value=\"$student_name\"><!--name--->
		<input type=\"hidden\" id=\"students-email\" name=\"students-email\" class=\"form\" value=\"$student_email\"><br><!---email-->
        <input type=\"hidden\" id=\"students-phone\" name=\"students-phone\" value=\"$student_phone\">

        <br>
        <br>
        <label id=\"class\">Selected Class: $class</label><br>
		<input type=\"hidden\" id=\"class\" name=\"class\" value=\"$class\">
		<!--dropdown--->
		<p><strong>Cause: $cause</strong></p><br>
		<input type=\"hidden\" id=\"cause\" name=\"cause\" value=\"$cause\">
		<br>
			<input type=\"submit\" id=\"submit\" name=\"submit\" value=\"Edit\"></a>
		<br><br>
	</div>
  </body>
</html>
";
?>
