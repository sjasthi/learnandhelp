<?php
require 'db_configuration.php';

  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
function admin_school_form($id){
  $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

  if ($connection === false) {
    die("Failed to connect to database: " . mysqli_connect_error());
  }
  $sql = "SELECT * FROM schools WHERE id = '$id'";
  $row = mysqli_fetch_array(mysqli_query($connection, $sql));
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
  
  echo "<div id= \"container_2\">
  <form id=\"survey-form\" action=\"form-submit_school.php\" method = \"post\">
    <input type='hidden' name='id' value=$id>
    <label id=\"name-label\">School Name</label>
    <input type=\"text\" id=\"sponsers-name\" name=\"name\" class=\"form\" value=\"$name\" required><br><!--name--->
    <label id=\"sponsers-email-label\">School Type</label>
    <input type=\"text\" id=\"sponsers-email\" name=\"type\" class=\"form\" value=\"$type\" required><br><!---email-->
    <label id=\"sponsers-email-label\">Category</label>
    <input type=\"text\" id=\"sponsers-email\" name=\"category\" class=\"form\" value=\"$category\" required><br><!---email-->
    <label id=\"sponsers-email-label\">Grade Start</label>
    <input type=\"text\" id=\"sponsers-email\" name=\"grade_level_start\" class=\"form\" value=\"$grade_level_start\" required><br><!---email-->
    <label id=\"sponsers-email-label\">Grade End</label>
    <input type=\"text\" id=\"sponsers-email\" name=\"grade_level_end\" class=\"form\" value=\"$grade_level_end\" required><br><!---email-->
    <label id=\"sponsers-email-label\">Current Enrollment</label>
    <input type=\"text\" id=\"sponsers-email\" name=\"current_enrollment\" class=\"form\" value=\"$current_enrollment\" required><br><!---email-->
    <label id=\"sponsers-email-label\">School Address</label>
    <input type=\"text\" id=\"sponsers-email\" name=\"address_text\" class=\"form\" value=\"$address_text\" required><br><!---email-->
    <label id=\"sponsers-email-label\">State</label><br>
    <input type=\"text\" id=\"sponsers-email\" name=\"state_name\" class=\"form\" value=\"$state_name\" required><br><!---email--></div>
    <div id=\"right\">
    <label id=\"sponsers-email-label\">State Code</label>
    <input type=\"text\" id=\"sponsers-email\" name=\"state_code\" class=\"form\" value=\"$state_code\" required><br><!---email-->
    <label id=\"sponsers-email-label\">Zip Code</label>
    <input type=\"text\" id=\"sponsers-email\" name=\"pin_code\" class=\"form\" value=\"$pin_code\" required><br><!---email-->
    <label id=\"sponsers-email-label\">Contact Name</label>
    <input type=\"text\" id=\"sponsers-email\" name=\"contact_name\" class=\"form\" value=\"$contact_name\" required><br><!---email-->
    <label id=\"sponsers-email-label\">Contact Designation</label>
    <input type=\"text\" id=\"sponsers-email\" name=\"contact_designation\" class=\"form\" value=\"$contact_designation\" required><br><!---email-->
    <label id=\"sponsers-email-label\">Contact Phone</label>
    <input type=\"tel\" id=\"sponsers-email\" name=\"contact_phone\" class=\"form\" value=\"$contact_phone\" required><br><!---email-->
    <label id=\"sponsers-email-label\">Contact Email</label>
    <input type=\"email\" id=\"sponsers-email\" name=\"contact_email\" class=\"form\" value=\"$contact_email\" required><br><!---email-->
    <label id=\"sponsers-email-label\">Status</label><br>
    <input type=\"text\" id=\"sponsers-email\" name=\"status\" class=\"form\" value=\"$status\" required><br><!---email-->
    <label id=\"sponsers-email-label\">Notes</label><br>
    <input type=\"text\" id=\"sponsers-email\" name=\"notes\" class=\"form\" value=\"$notes\" required><br></div><!---email-->";
  
}

function admin_class_form($Class_Id){
  $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

  if ($connection === false) {
    die("Failed to connect to database: " . mysqli_connect_error());
  }
  $sql = "SELECT * FROM classes WHERE Class_Id = '$Class_Id'";
  $row = mysqli_fetch_array(mysqli_query($connection, $sql));

  $class_name = $row["Class_Name"];
  $description = $row["Description"];

  echo "<div id= \"container_2\">
  <form id=\"survey-form\" action=\"form-submit_classes.php\" method = \"post\">
    <input type='hidden' name='Class_Id' value=$Class_Id>
    <label id=\"name-label\">Course Name</label>
    <input type=\"text\" id=\"sponsers-name\" name=\"Class_Name\" class=\"form\" value=\"$class_name\" required><br><!--name--->
    <label id=\"sponsers-email-label\">Course Description</label>
    <input type=\"text\" id=\"sponsers-email\" name=\"Description\" class=\"form\" value=\"$description\" required><br><!---email-->
    </div>";
  
}

function admin_fill_form($Reg_Id) {

  $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

  if ($connection === false) {
    die("Failed to connect to database: " . mysqli_connect_error());
  }
  $sql = "SELECT * FROM registrations NATURAL JOIN classes WHERE Reg_ID = '$Reg_Id'";
  $row = mysqli_fetch_array(mysqli_query($connection, $sql));

  $sponsor_name = $row['Sponsor_Name'];
  $sponsor_email = $row['Sponsor_Email'];
  $sponsor_phone = $row['Sponsor_Phone_Number'];
  $spouse_name = $row['Spouse_Name'];
  $spouse_email = $row['Spouse_Email'];
  $spouse_phone = $row['Spouse_Phone_Number'];
  $student_name = $row['Student_Name'];
  $student_email = $row['Student_Email'];
  $student_phone = $row['Student_Phone_Number'];
  $class = $row['Class_Name'];
  $cause = $row['Cause'];

  echo "<div id= \"container_2\">
    <form id=\"survey-form\" action=\"form-submit.php\" method = \"post\">
      <input type='hidden' name='Reg_Id' value=$Reg_Id>
      <!---Sponsors Section -->
      <label id=\"name-label\">Sponsor's Name</label>
      <input type=\"text\" id=\"sponsers-name\" name=\"sponsers-name\" class=\"form\" value=\"$sponsor_name\" required><br><!--name--->
      <label id=\"sponsers-email-label\"> Sponsor's Email</label>
      <input type=\"email\" id=\"sponsers-email\" name=\"sponsers-email\" class=\"form\" value=\"$sponsor_email\" required><br><!---email-->
      <label id=\"sponsors-number-label\">Sponsor's Phone Number</label>
      <input type=\"tel\" id=\"sponsers-phone\" name=\"sponsers-phone\" value=\"$sponsor_phone\" required>

      <br>
      <!---Spouse Section -->
      <label id=\"spouses-name-label\">Spouse's Name</label>
      <input type=\"text\" id=\"spouses-name\" name=\"spouses-name\" class=\"form\" value=\"$spouse_name\" required><br>
      <label id=\"spouses-email-label\"> Spouse's Email</label>
      <input type=\"email\" id=\"spouses-email\" name=\"spouses-email\" class=\"form\" value=\"$spouse_email\" required ><br>
      <label id=\"spouses-number-label\">Spouse's Phone Number</label>
      <input type=\"tel\" id=\"spouses-phone\" name=\"spouses-phone\" value=\"$spouse_phone\" required>

      <br>
      </div>
      <div id=\"right\">
      <!---Student Section -->
      <label id=\"students-name-label\">Student's Name</label>
      <input type=\"text\" id=\"students-name\" name=\"students-name\" class=\"form\" required value=\"$student_name\"><br>
      <label id=\"students-email-label\"> Student's Email</label>
      <input type=\"email\" id=\"students-email\" name=\"students-email\" class=\"form\" required value=\"$student_email\"><br
      <label id=\"students-number-label\">Student's Phone Number</label>
      <input type=\"tel\" id=\"students-phone\" name=\"students-phone\" value=\"$student_phone\" required>

      <br>
      <label id=\"class\">Select Class</label>
      <select id=\"dropdown\" name=\"role\" required>
        <option disabled value>
          Select your class
        </option>
        <option value=2 ";
          if ($class == "Python 101")
              echo "selected";
      echo  ">
          Python 101
        </option>
        <option value=1 ";
        if ($class == "Java 101")
            echo "selected";
      echo ">
          Java 101
        </option>
        <option value=4 ";
        if ($class == "Python 201")
            echo "selected";
      echo ">
          Python 201
        </option>
	  <option value=3 ";
        if ($class == "Java 201")
            echo "selected";
      echo ">
		Java 201
	  </option>
	</select>
	<!--dropdown--->
	<p><strong>Cause</strong></p>
	<label>
	  <input type=\"radio\" name=\"cause\" value=\"lib\" ";
        if ($cause == "Library")
            echo "checked=\"checked\"";
      echo ">Library
	</label>
	<br>
	<label>
	  <input type=\"radio\" name=\"cause\" value=\"Dig_class\" ";
        if ($cause == "Digital Classroom")
            echo "checked=\"checked\"";
      echo ">Digital Classroom</label>
	<label>
	  <br>
	  <input type=\"radio\" name=\"cause\" value=\"Other\" ";
        if ($cause == "No Preference")
            echo "checked=\"checked\"";
      echo "> No Preference
	</label><!---radioButtons--->
  <input type='hidden' name='Reg_Id' value='". $Reg_Id . "'/>
  </div>
  ";
}
?>
