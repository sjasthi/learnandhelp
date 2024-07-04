<?php
require 'db_configuration.php';

$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}


function fill_form() {

  if (isset($_COOKIE['email']) and !isset($_POST['action'])){
    $student_email = $_COOKIE['email'];
    $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

    if ($connection === false) {
  	  die("Failed to connect to database: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM registrations Natural Join classes WHERE Student_Email = '$student_email'";
    $row = mysqli_fetch_array(mysqli_query($connection, $sql));

    $Reg_Id = $row['Reg_Id'];
    $sponsor1_name = $row['Sponsor1_Name'];
    $sponsor1_email = $row['Sponsor1_Email'];
    $sponsor1_phone = $row['Sponsor1_Phone_Number'];
    $sponsor2_name = $row['Sponsor2_Name'];
    $sponsor2_email = $row['Sponsor2_Email'];
    $sponsor2_phone = $row['Sponsor2_Phone_Number'];
    $student_name = $row['Student_Name'];
    $student_email = $row['Student_Email'];
    $student_phone = $row['Student_Phone_Number'];
    $class_id = $row['Class_Id'];
    $cause = $row['Cause'];

  } else {
    $Reg_Id = $_POST['Reg_Id'];
    $student_email = $_POST['students-email'];
    $sponsor1_name = $_POST['sponsor1-name'];
    $sponsor1_email = $_POST['sponsor1-email'];
    $sponsor1_phone = $_POST['sponsor1-phone'];
    $sponsor2_name = $_POST['sponsor2-name'];
    $sponsor2_email = $_POST['sponsor2-email'];
    $sponsor2_phone = $_POST['sponsor2-phone'];
    $student_name = $_POST['students-name'];
    $student_phone = $_POST['students-phone'];
    $class_id = $_POST['class'];
    $cause = $_POST['cause'];
  }
    echo "<div id= \"container_2\">
      <form id=\"survey-form\" action=\"form-submit.php\" method = \"post\">
        <input type='hidden' name='Reg_Id' value=\"$Reg_Id\">
        <!---Sponsor1s Section -->
        <label id=\"name-label\">Sponsor 1's Name</label>
        <input type=\"text\" id=\"sponsor1-name\" name=\"sponsor1-name\" class=\"form\" value=\"$sponsor1_name\" required><br><!--name--->
        <label id=\"sponsor1-email-label\"> Sponsor 1's Email</label>
        <input type=\"email\" id=\"sponsor1-email\" name=\"sponsor1-email\" class=\"form\" value=\"$sponsor1_email\" required><br><!---email-->
        <label id=\"sponsor1-number-label\">Sponsor 1's Phone Number</label>
        <input type=\"tel\" id=\"sponsor1-phone\" name=\"sponsor1-phone\" value=\"$sponsor1_phone\" required>

        <br>
        <!---Sponsor 2 Section -->
        <label id=\"sponsor2-name-label\">Sponsor 2's Name</label>
        <input type=\"text\" id=\"sponsor2-name\" name=\"sponsor2-name\" class=\"form\" value=\"$sponsor2_name\" required><br>
        <label id=\"sponsor2-email-label\"> Sponsor 2's Email</label>
        <input type=\"email\" id=\"sponsor2-email\" name=\"sponsor2-email\" class=\"form\" value=\"$sponsor2_email\" required ><br>
        <label id=\"sponsor2-number-label\">Sponsor 2's Phone Number</label>
        <input type=\"tel\" id=\"sponsor2-phone\" name=\"sponsor2-phone\" value=\"$sponsor2_phone\" required>

        <br>
        </div>
        <div id=\"right\">
        <!---Student Section -->
        <label id=\"students-name-label\">Student's Name</label>
        <input type=\"text\" id=\"students-name\" name=\"students-name\" class=\"form\" required value=\"$student_name\"><br>
        <label id=\"students-email-label\"> Student's Email</label>
        <input type=\"email\" id=\"students-email\" name=\"students-email\" class=\"form\" required value=\"$student_email\"><br>
        <label id=\"students-number-label\">Student's Phone Number</label>
        <input type=\"tel\" id=\"students-phone\" name=\"students-phone\" value=\"$student_phone\" required>

        <br>
        <label id=\"class\">Select Class</label>
        <select id=\"dropdown\" name=\"class\" required>
          <option disabled value>
            Select your class
          </option>";
          $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

          if ($connection === false) {
            die("Failed to connect to database: " . mysqli_connect_error());
          }
          
          $class_query = "SELECT c.Class_Id, c.Class_Name, c.Description, c.Status
                  FROM classes c
                  JOIN offerings o ON c.Class_Id = o.class_id
                  JOIN preferences p ON o.batch = p.value
                  WHERE p.Preference_Name = 'Active Registration' AND c.Status = 'Approved';";
          $class_result = mysqli_query($connection, $class_query);
          
          while ($class_row = mysqli_fetch_assoc($class_result)) {
              $class_id_option = $class_row['Class_Id'];
              $class_name_option = $class_row['Class_Name'];
              $selected = ($class_id == $class_id_option) ? "selected" : "";
              echo "<option value=\"$class_id_option\" $selected>$class_name_option</option>";
          }
          
        echo "</select>
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
    </div>
    ";
}
?>
