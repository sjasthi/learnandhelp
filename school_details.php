<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }

  $School_Id = $_GET['School_Id']
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Learn and Help</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
    <?php include 'show-navbar.php';
    ?>
    <?php show_navbar(); ?>
    <header class="inverse">
      <div class="container">
        <h1> <span class="accent-text">School Details</span></h1>
      </div>
    </header>
<?php
  require 'db_configuration.php';
  $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

  if ($connection === false) {
    die("Failed to connect to database: " . mysqli_connect_error());
  }
  $sql = "SELECT * FROM schools WHERE id = '$School_Id'";
  $row = mysqli_fetch_array(mysqli_query($connection, $sql));

  $school_name = $row['name'];
  $school_type = $row['type'];
  $school_category = $row['category'];
  $grade_level_start = $row['grade_level_start'];
  $grade_level_end = $row['grade_level_end'];
  $current_enrollment = $row['current_enrollment'];
  $address_text = $row['address_text'];
  $state_name = $row['state_name'];
  $state_code = $row['state_code'];
  $pin_code = $row['pin_code'];
  
  $contact_name = $row['contact_name'];
  $contact_designation = $row['contact_designation'];
  $contact_phone = $row['contact_phone'];
  $contact_email = $row['contact_email'];
  $status = $row['status'];
  $notes = $row['notes'];

  echo "<h3> School Details </h3>
	  <div id=\"school_icons\" class=\"school_icon\">
	      <img src=\"schools/$School_Id/profile_image.png\" alt=\"school image\">
	  </div>
	  </br>
      <div id= \"container_2\" class=\"school_details\">
      <label id=\"id-label\">School ID:</label><span class=\"school_details\"> " . $School_Id . "</span></br>
      <label id=\"name-label\">School Name:</label><span class=\"school_details\"> " . $school_name . "</span></br>
      <label id=\"type-label\">Type:</label><span class=\"school_details\"> " . $school_type . "</span></br>
      <label id=\"category-label\">Category:</label><span class=\"school_details\"> " . $school_type . "</span></br>
      <label id=\"grade-range-label\">Grades:</label><span class=\"school_details\"> " . $grade_level_start . " to " . $grade_level_end . "</span></br>
      <label id=\"enrollment-label\">Current Enrollment:</label><span class=\"school_details\"> " . $current_enrollment . "</span></br>
      <label id=\"address-label\">Address:</label><span class=\"school_details\"> " . $address_text . "</span></br>
      <label id=\"state-name-label\">State Name:</label><span class=\"school_details\"> " . $state_name . "</span></br>
      <label id=\"state-code-label\">State Code:</label><span class=\"school_details\"> " . $state_code . "</span></br>
      <label id=\"type-label\">Pin Code:</label><span class=\"school_details\"> " . $pin_code . "</span>
      </div>

	  <div id=\"right\" class=\"school_details\">
      <label id=\"contact-name-label\">Contact Name:</label><span class=\"school_details\"> " . $contact_name . "</span></br>
      <label id=\"contact-designation-label\">Contact Designation:</label><span class=\"school_details\"> " . $contact_designation . "</span></br>
      <label id=\"contact-number-label\">Contact Phone Number:</label><span class=\"school_details\"> " . $contact_phone . "</span></br>
	  <label id=\"contact-email-label\">Contact Email:</label><span class=\"school_details\"> " . $contact_email . "</span></br>
	  <label id=\"status-label\">Status:</label><span class=\"school_details\"> " . $status . "</span>
	</div>
	<div class=\"school_notes\">
	  <span class=\"inverse\"><label id=\"notes-label\">Notes</label></span></br>
	  <span>" . $notes . "</span>
    <div>";
?>
  </body>
</html>
