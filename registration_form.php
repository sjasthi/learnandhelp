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
  $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

  if ($connection === false) {
    die("Failed to connect to database: " . mysqli_connect_error());
  }

  //Find user's information to populate.
  $sql = 'SELECT * FROM users WHERE User_Id = ' . $User_Id . ';';
  $result = $connection->query($sql);
  $row = $result -> fetch_assoc();
  $fname = $row["First_Name"];
  $lname = $row["Last_Name"];
  $email = $row["Email"];
  $phone = $row["Phone"];
  $fullname = $fname . " " . $lname;
  
  $reg_id = $sponsor_name = $sponsor_email = $sponsor_phone = $spouse_name = $spouse_email = $spouse_phone = $student_name = $class = "";
  
  //Keeping for now, just in case $phone will need to be used in a way where it cannot be null.
  /*if(is_null($phone)){
	  $phone = "";
  }*/ 
} else {
  header("Location: login.php");
}

//get active registration year
$active_reg_query = "SELECT Value FROM preferences WHERE Preference_Name = 'Active Registration'";
$active_reg_result = $connection->query($active_reg_query);
$active_reg_array = $active_reg_result->fetch_assoc();
$active_reg = $active_reg_array["Value"];

include 'show-navbar.php';

echo "<!DOCTYPE html>
<html>
  <head>
    <link rel=\"icon\" href=\"images/icon_logo.png\" type=\"image/icon type\">
    <title>Learn and Help</title>
    <link href=\"https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap\" rel=\"stylesheet\">
    <link href=\"css/main.css\" rel=\"stylesheet\">
	<meta name='viewport' content='width=device-width, initial-scale=1'>
<style>
.accordion {
  background-color: #eee;
  color: #444;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: center;
  outline: none;
  font-size: 20px;
  transition: 0.4s;
}

.active, .accordion:hover {
  background-color: #ccc; 
}

.panel {
  padding: 0 18px;
  display: none;
  background-color: white;
  overflow: hidden;
}
</style>
</head>
<body>";
show_navbar();
echo "<header class=\"inverse\">
	<div class=\"container\">
	<h1><span class=\"accent-text\">Enroll Now</span></h1>
	</div>
	</header>
	<h2><strong>Registration Details</strong></h2>";
	
//Get list of previous registrations, if exists
$past_reg_query = "SELECT Class_Id, Batch_Name, Sponsor1_Name, Sponsor1_Email, Sponsor1_Phone_Number FROM registrations NATURAL JOIN batch WHERE Student_Name = '". $fullname. "' AND NOT Batch_Name = '$active_reg' ORDER BY Start_Date DESC";
$past_reg_result = $connection->query($past_reg_query);

//Find current registration, if exists
$current_reg_query = "SELECT * FROM registrations WHERE Student_Name = '". $fullname. "' AND Batch_Name = '$active_reg'";
$current_reg_result = $connection->query($current_reg_query);

//If user is registered for a class this term, show information for that registration.
if($current_reg_result->num_rows > 0){
	$user_reg_array = $current_reg_result->fetch_assoc();
	$class_id = $user_reg_array['Class_Id'];
	$class_name_query = "SELECT Class_Name FROM classes WHERE Class_Id = '$class_id';";
	$class_name_result = $connection->query($class_name_query);
	$class_name_array = $class_name_result->fetch_assoc();
	mysqli_free_result($class_name_result);
	$class_name = $class_name_array['Class_Name'];
	
	$sponsor_name = $user_reg_array['Sponsor1_Name'];
	$sponsor_email = $user_reg_array['Sponsor1_Email'];
	$sponsor_phone = $user_reg_array['Sponsor1_Phone_Number'];
	$spouse_name = $user_reg_array['Sponsor2_Name'];
	$spouse_email = $user_reg_array['Sponsor2_Email'];
	$spouse_phone = $user_reg_array['Sponsor2_Phone_Number'];
	$student_name = $user_reg_array['Student_Name'];
	$class = $user_reg_array['Class_Id'];
	
	
	echo "<button class='accordion'>$active_reg</button>
		<div class='panel'>
		<p><strong>Registration details for $active_reg.</strong></p>
		<p>$class_name</p>
		<form action=\"registration_edit.php\" method = \"post\">
		<input type='hidden' name='reg_id' value=$reg_id>
        <input type=\"hidden\" id=\"action\" name=\"action\" value=\"edit\">
		<input type=\"hidden\" id=\"sponsers-name\" name=\"sponsers-name\" class=\"form\" value=\"$sponsor_name\"><!--name--->
		<input type=\"hidden\" id=\"sponsers-email\" name=\"sponsers-email\" class=\"form\" value=\"$sponsor_email\"><!---email-->
        <input type=\"hidden\" id=\"sponsers-phone\" name=\"sponsers-phone\" value=\"$sponsor_phone\"><br>
		<input type=\"hidden\" id=\"spouses-name\" name=\"spouses-name\" class=\"form\" value=\"$spouse_name\"><!--name--->
		<input type=\"hidden\" id=\"spouses-email\" name=\"spouses-email\" class=\"form\" value=\"$spouse_email\"><!---email-->
        <input type=\"hidden\" id=\"spouses-phone\" name=\"spouses-phone\" value=\"$spouse_phone\">
		<input type=\"hidden\" id=\"students-name\" name=\"students-name\" class=\"form\" value=\"$student_name\"><!--name--->
		<input type=\"hidden\" id=\"students-email\" name=\"students-email\" class=\"form\" value=\"$email\"><br><!---email-->
        <input type=\"hidden\" id=\"students-phone\" name=\"students-phone\" value=\"$phone\">
		<input type=\"hidden\" id=\"class\" name=\"class\" value=\"$class\">
		<input type=\"hidden\" id=\"batch\" name=\"batch\" value=\"$active_reg\">
		<input type='hidden' name='action' value='edit'>
		<input type=\"submit\" id=\"submit-registration\" name=\"submit\" value=\"Edit\">
		</form>
		</div>";
		
}
//if user isn't registered for a class this term, show registration form
else {
	echo "<button class='accordion'>$active_reg</button>
		<div class='panel'>
		<p>You are not currently registered for this academic year.</p>
		<p>Enter your registration details.</p>
		<h3> Registration Form</h3>
		<p><i>* Required Fields</i></p>
		<form id=\"survey-form\" action=\"form-submit.php\" method = \"post\">
		<div id= \"container_2\">
		<!---Student Section -->
		<label id=\"students-name-label\">*Student's Name: </label>
		<input type=\"text\" id=\"students-name\" name=\"students-name\" class=\"form\" required placeholder=\"Enter Student's name\" value=\"$fullname\"><br>
		<label id=\"students-email-label\"> *Student's Email: </label>
		<input type=\"email\" id=\"students-email\" name=\"students-email\" class=\"form\" required placeholder=\"Enter Student's email\" value=\"$email\"><br>
		<label id=\"students-number-label\">*Student's Phone Number: </label>
		<input type=\"tel\" id=\"students-phone\" name=\"students-phone\" placeholder=\"123-456-7899\" value=\"$phone\" pattern=\"[0-9]{3}-[0-9]{3}-[0-9]{4}\" required><br>
		<label id=\"batch-name-label\">*Batch Name</label>
		<input type=\"text\" id=\"batch-name\" name=\"batch\" value=\"$active_reg\" readonly>
		<br>
		<label id=\"class\">*Select Class: </label>
		<select id=\"dropdown\" name=\"class\" required>";
	// Select view of available classes for users from accessing the page 
	// Admin's can see all classes regardless of status
	if ((isset($_SESSION['email'])) &&  $_SESSION['role'] == 'admin') {
	  $class_query = "SELECT Class_Id, Class_Name, Description, Status FROM classes;";
	}
	//Non-Admin's and users not logged in can only see "Approved" Classes
	else {
		$active_reg_query = "SELECT Value FROM preferences WHERE Preference_Name = 'Active Registration'";
		$active_reg_result = $connection->query($active_reg_query);
		$active_reg_array = $active_reg_result->fetch_assoc();
		$active_reg = $active_reg_array["Value"];
		
		$offerings_query = "SELECT Class_Id FROM offerings WHERE Batch_Name = '$active_reg'";
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
	//most current past registration used to auto populate sponsor info
	$sponsor_name = $sponsor_email = $sponsor_phone = "";
	if($past_reg_result->num_rows > 0){
		$past_reg_row = $past_reg_result->fetch_assoc();
		$sponsor_name = $past_reg_row['Sponsor1_Name'];
		$sponsor_email = $past_reg_row['Sponsor1_Email'];
		$sponsor_phone = $past_reg_row['Sponsor1_Phone_Number'];
	}
	echo "</select>
	<!--dropdown--->
	
	</label><!---radioButtons--->
	<br>
	</div>

	<div id=\"right\">
  
	<!---Sponsors Section -->
	<label id=\"name-label\">*Sponsor's Name: </label>
	<input type=\"text\" id=\"sponsers-name\" name=\"sponsers-name\" class=\"form\" placeholder=\"Enter Sponsor's name\" value=\"$sponsor_name\" required><br><!--name--->
	<label id=\"sponsers-email-label\">*Sponsor's Email: </label>
	<input type=\"email\" id=\"sponsers-email\" name=\"sponsers-email\" class=\"form\" placeholder=\"Enter Sponsor's email\" value=\"$sponsor_email\" required><br><!---email-->
	<label id=\"sponsers-number-label\">*Sponsor's Phone Number: </label>
	<input type=\"tel\" id=\"sponsers-phone\" name=\"sponsers-phone\" placeholder=\"123-456-7899\" pattern=\"[0-9]{3}-[0-9]{3}-[0-9]{4}\" value=\"$sponsor_phone\" required>
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
	<input type=\"hidden\" id=\"batch\" name=\"batch\" value=\"$active_reg\">
	</form><!---survey-form--->
	</div>";
}

//If registered for past semesters, display the information for each registration by semester in reverse chronological order. If not, only display the accordion for the current semester.
$past_reg_query = "SELECT Class_Id, Batch_Name FROM registrations NATURAL JOIN batch WHERE Student_Name = '". $fullname. "' AND NOT Batch_Name = '$active_reg' ORDER BY Start_Date DESC";
$past_reg_result = $connection->query($past_reg_query);
if(($past_reg_result->num_rows > 0)){
	while ($past_reg_row = $past_reg_result->fetch_assoc()) {
		$class_id = $past_reg_row['Class_Id'];
		$class_name_query = "SELECT Class_Name FROM classes WHERE Class_Id = '$class_id';";
		$class_name_result = $connection->query($class_name_query);
		$class_name_array = $class_name_result->fetch_assoc();
		mysqli_free_result($class_name_result);
		$class_name = $class_name_array['Class_Name'];
		$past_batch = $past_reg_row["Batch_Name"];
		
		echo "<button class='accordion'>$past_batch</button>
		<div class='panel'>
		<p><strong>Registration details for $past_batch</strong></p>
		<p>$class_name</p><br>
		</div>";
	}
}
echo "<script>
	var acc = document.getElementsByClassName('accordion');
	var i;
	for (i = 0; i < acc.length; i++) {
	  acc[i].addEventListener('click', function() {
		this.classList.toggle('active');
		var panel = this.nextElementSibling;
		if (panel.style.display === 'block') {
		  panel.style.display = 'none';
		} else {
		  panel.style.display = 'block';
		}
	  });
	}
	</script>
	</body>
	</html>";
?>