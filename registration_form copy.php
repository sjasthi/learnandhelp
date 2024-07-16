<?php
require 'db_configuration.php';
$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}

// TODO convert this so a user can choose to create a new registration from the registration details page
// Check to see if the logged in user has a registration on file
if (isset($_SESSION['User_Id'])) {
  $User_Id = $_SESSION['User_Id'];
  $sql = 'SELECT * FROM user_registrations WHERE User_Id = ' . $User_Id . ';';
  $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

  if ($connection === false) {
    die("Failed to connect to database: " . mysqli_connect_error());
  }

  $result = $connection->query($sql);

  if ($result->num_rows > 0) {
    header("Location: form-submit.php");
  }
} else {
  header("Location: login.php");
}

include 'show-navbar.php';

echo "<!DOCTYPE html>
<html>
  <head>
    <link rel=\"icon\" href=\"images/icon_logo.png\" type=\"image/icon type\">
    <title>Learn and Help</title>
    <link href=\"https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap\" rel=\"stylesheet\">
    <link href=\"css/main.css\" rel=\"stylesheet\">
  </head>
  <body>";
show_navbar();
echo      "<header class=\"inverse\">
          <div class=\"container\">
              <h1><span class=\"accent-text\">Register Now</span></h1>
          </div>
          </header>
      <h3> Registration Form</h3>
      <p><i>* Required Fields</i></p>
      <div id= \"container_2\">
        <!---Student Section -->
        <label id=\"students-name-label\">*Student's Name: </label>
        <input type=\"text\" id=\"students-name\" name=\"students-name\" class=\"form\" required placeholder=\"Enter Student's name\"><br>
        <label id=\"students-email-label\"> *Student's Email: </label>
        <input type=\"email\" id=\"students-email\" name=\"students-email\" class=\"form\" required placeholder=\"Enter Student's email\"><br>
        <label id=\"students-number-label\">*Student's Phone Number: </label>
        <input type=\"tel\" id=\"students-phone\" name=\"students-phone\" placeholder=\"123-456-7899\" pattern=\"[0-9]{3}-[0-9]{3}-[0-9]{4}\" required>
        <br>
        <br>
        <label id=\"class\">*Select Class: </label>
        <select id=\"dropdown\" name=\"class\" required>"; // changed name to class


// Select view of available classes for users from accessing the page 
// Admin's can see all classes regardless of status
if ((isset($_SESSION['email'])) &&  $_SESSION['role'] == 'admin') {
  $class_query = "SELECT Class_Id, Class_Name, Description, Status
              FROM classes;";
}

//Non-Admin's and users not logged in can only see "Approved" Classes
else {
  $class_query = "SELECT Class_Id, Class_Name, Description, Status
              FROM classes
              WHERE Status = 'Approved';";
}


// Fetch classes from the database
//$class_query = "SELECT * FROM classes";
$class_result = $connection->query($class_query);
if (!$class_result) {
  echo "Error: " . $connection->error;
} else {
  if ($class_result->num_rows > 0) {
    while ($row = $class_result->fetch_assoc()) {
      echo "<option value=\"" . $row["Class_Id"] . "\">" . $row["Class_Name"] . "</option>";
    }
  } else {
    echo "<option disabled selected value>No classes found</option>";
  }
}

echo      "</select>
		<!--dropdown--->
		
		</label><!---radioButtons--->
		<br>
    </div>

    <div id=\"right\">
      <form id=\"survey-form\" action=\"form-submit.php\" method = \"post\">
        <!---Sponsors Section -->
        <label id=\"name-label\">Sponsor's Name: </label>
        <input type=\"text\" id=\"sponsers-name\" name=\"sponsers-name\" class=\"form\" placeholder=\"Enter Sponsor's name\"><br><!--name--->
        <label id=\"sponsers-email-label\"> Sponsor's Email: </label>
        <input type=\"email\" id=\"sponsers-email\" name=\"sponsers-email\" class=\"form\" placeholder=\"Enter Sponsor's email\"><br><!---email-->
        <label id=\"sponsors-number-label\">Sponsor's Phone Number: </label>
        <input type=\"tel\" id=\"sponsers-phone\" name=\"sponsers-phone\" placeholder=\"123-456-7899\" pattern=\"[0-9]{3}-[0-9]{3}-[0-9]{4}\">
        <br>
        <br>
        <!---Spouse Section -->
        <label id=\"spouses-name-label\">Spouse's Name: </label>
        <input type=\"text\" id=\"spouses-name\" name=\"spouses-name\" class=\"form\" placeholder=\"Enter Spouse's name\"><br>
        <label id=\"spouses-email-label\"> Spouse's Email: </label>
        <input type=\"email\" id=\"spouses-email\" name=\"spouses-email\" class=\"form\" placeholder=\"Enter Spouse's email\"><br>
        <label id=\"spouses-number-label\">Spouse's Phone Number: </label>
        <input type=\"tel\" id=\"spouses-phone\" name=\"spouses-phone\" placeholder=\"123-456-7899\" pattern=\"[0-9]{3}-[0-9]{3}-[0-9]{4}\">

      </div>
<br>
    <input type=\"submit\" id=\"submit-registration\" name=\"submit\" value=\"Submit\">
    <input type=\"hidden\" id=\"action\" name=\"action\" value=\"add\">
    </form><!---survey-form--->

  </body>
</html>";
