<?php
require 'db_configuration.php';

$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}


function fill_form() {
	$connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
  if (isset($_COOKIE['email']) and !isset($_POST['action'])){
    $student_email = $_COOKIE['email'];
    

    if ($connection === false) {
  	  die("Failed to connect to database: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM registrations Natural Join classes WHERE Student_Email = '$student_email'";
    $row = mysqli_fetch_array(mysqli_query($connection, $sql));

    $db_id = $row['Reg_Id'];
    $sponsor_name = $row['Sponsor_Name'];
    $sponsor_email = $row['Sponsor_Email'];
    $sponsor_phone = $row['Sponsor_Phone_Number'];
    $spouse_name = $row['Spouse_Name'];
    $spouse_email = $row['Spouse_Email'];
    $spouse_phone = $row['Spouse_Phone_Number'];
    $student_name = $row['Student_Name'];
    $student_email = $row['Student_Email'];
    $student_phone = $row['Student_Phone_Number'];
    $class_name = $row['Class_Name'];
	$class = $_POST['class'];
	$batch = $_POST['batch'];

  } else {
    $db_id = $_POST['Reg_Id'];
    $student_email = $_POST['students-email'];
    $sponsor_name = $_POST['sponsers-name'];
    $sponsor_email = $_POST['sponsers-email'];
    $sponsor_phone = $_POST['sponsers-phone'];
    $spouse_name = $_POST['spouses-name'];
    $spouse_email = $_POST['spouses-email'];
    $spouse_phone = $_POST['spouses-phone'];
    $student_name = $_POST['students-name'];
	$batch = $_POST['batch'];
    $student_phone = $_POST['students-phone'];
    $class = $_POST['class'];
  }
    echo "<div id= \"container_2\">
      <form id=\"survey-form\" action=\"form-submit.php\" method = \"post\">
        <input type='hidden' name='Reg_Id' value=$db_id>
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
        <input type=\"text\" id=\"spouses-name\" name=\"spouses-name\" class=\"form\" value=\"$spouse_name\"><br>
        <label id=\"spouses-email-label\"> Spouse's Email</label>
        <input type=\"email\" id=\"spouses-email\" name=\"spouses-email\" class=\"form\" value=\"$spouse_email\"><br>
        <label id=\"spouses-number-label\">Spouse's Phone Number</label>
        <input type=\"tel\" id=\"spouses-phone\" name=\"spouses-phone\" value=\"$spouse_phone\">

        <br>
        </div>
        <div id=\"right\">
        <!---Student Section -->
        <label id=\"students-name-label\">Student's Name</label>
        <input type=\"text\" id=\"students-name\" name=\"students-name\" class=\"form\" required value=\"$student_name\"><br>
        <label id=\"students-email-label\"> Student's Email</label>
        <input type=\"email\" id=\"students-email\" name=\"students-email\" class=\"form\" required value=\"$student_email\"><br>
        <label id=\"students-number-label\">Student's Phone Number</label>
        <input type=\"tel\" id=\"students-phone\" name=\"students-phone\" value=\"$student_phone\" required><br>
		<label id=\"batch-name-label\">Batch Name</label>
		<input type=\"text\" id=\"batch-name\" name=\"batch\" value=\"$batch\" readonly>

        <br>
        <label id=\"class\">Select Class</label>
        <select id=\"dropdown\" name=\"class\" required>
          <option disabled value>
            Select your class
          </option>";
		  
		  	// Select view of available classes for users from accessing the page 
	// Admin's can see all classes regardless of status
	if ((isset($_SESSION['email'])) &&  $_SESSION['role'] == 'admin') {
	  $class_query = "SELECT Class_Id, Class_Name, Description, Status FROM classes;";
	}
	//Non-Admin's and users not logged in can only see "Approved" Classes
	else {		
		$offerings_query = "SELECT Class_Id FROM offerings WHERE Batch_Id = '$batch';";
		$offerings_result = $connection->query($offerings_query);
		
		$class_id_list = "";
		if($offerings_result->num_rows > 0)
		{
			$i = 0;
			while($offerings_row = $offerings_result->fetch_assoc())
			{
				$class_id_list .= strval($offerings_row["Class_Id"]);
				$i++;
				if($i < $offerings_result->num_rows){
					$class_id_list .= ", ";
				}
			}
		}
		
		$class_query = "SELECT Class_Id, Class_Name, Description, Status FROM classes WHERE Class_Id IN ($class_id_list)";
	}

	// Fetch classes from the database
	//$class_query = "SELECT * FROM classes";
	$class_result = $connection->query($class_query);
	if (!$class_result) {
	  echo "Error: " . $connection->error;
	} 
	else {
	  if ($class_result->num_rows > 0) {
		while ($row = $class_result->fetch_assoc())
			echo "<option value=\"" . $row["Class_Id"] . "\">" . $row["Class_Name"] . "</option>";
	  } 
	  else {
			echo "<option disabled selected value>No classes found</option>";
	  }
	}
	mysqli_free_result($class_result);
	echo "</select>
		<!--dropdown--->
    </div>
    ";
}
?>