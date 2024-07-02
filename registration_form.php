<?php
require 'db_configuration.php';
include 'show_registration_history.php';
$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}

// TODO convert this so a user can choose to create a new registration from the registration details page
// Check to see if the logged in user has a registration on file
if (isset($_SESSION['User_Id'])) {
  $User_Id = $_SESSION['User_Id'];
  // $sql = 'SELECT * FROM user_registrations WHERE User_Id = ' . $User_Id . ';';
  $sql = "SELECT *
          FROM user_registrations ur
          JOIN registrations r ON ur.Reg_Id = r.Reg_Id
          JOIN classes c ON c.Class_Id = r.Class_Id
          JOIN batch b ON ur.batch = b.batch
          JOIN preferences p ON 1=1
          WHERE ur.User_Id = 44
          AND b.batch = p.value
          AND p.variable = 'Active Registration'
          ORDER BY b.end_date DESC;
          ";
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


// Query to populate student info
  $student_info_query = "SELECT First_Name, Last_Name, Email, Phone FROM users WHERE User_ID = $User_Id;";
  $student_info_result = mysqli_query($connection, $student_info_query );

  if (!$student_info_result) {
      die("Query failed: " . mysqli_error($connection));
  }

  $student_info = [];
  while ($student_row = mysqli_fetch_assoc($student_info_result)) {
    $StudentFullName = $student_row['First_Name'] . ' ' . $student_row['Last_Name'];
    $StudentEmail = $student_row['Email'] ;
    $StudentPhone = $student_row['Phone'];
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
        <form id=\"survey-form\" action=\"form-submit.php\" method = \"post\">
          <!---Student Section -->
          <label id=\"students-name-label\">*Student's Name: </label>
          <input type=\"text\" id=\"students-name\" name=\"students-name\" class=\"form\" required value=\"$StudentFullName\"><br>
          <label id=\"students-email-label\">*Student's Email: </label>
          <input type=\"email\" id=\"students-email\" name=\"students-email\" class=\"form\" required value=\"$StudentEmail\"><br>
          <label id=\"students-number-label\">*Student's Phone Number: </label>
          <input type=\"tel\" id=\"students-phone\" name=\"students-phone\" value=\"$StudentPhone\" pattern=\"[0-9]{3}-[0-9]{3}-[0-9]{4}\" required><br>
          <br>
          <br>
          <label id=\"class\">*Select Class: </label>
          <select id=\"dropdown\" name=\"class\" required>"; // changed name to class


// // Select view of available classes for users from accessing the page 
// // Admin's can see all classes regardless of status
// if ((isset($_SESSION['email'])) &&  $_SESSION['role'] == 'admin') {
//   $class_query = "SELECT Class_Id, Class_Name, Description, Status
//               FROM classes;";
// }

// //Non-Admin's and users not logged in can only see "Approved" Classes
// else {
//   $class_query = "SELECT Class_Id, Class_Name, Description, Status
//               FROM classes
//               WHERE Status = 'Approved';";
// }




// // // Fetch classes from the database
// //$class_query = "SELECT * FROM classes";
// $class_result = $connection->query($class_query);
// if (!$class_result) {
//   echo "Error: " . $connection->error;
// } else {
//   if ($class_result->num_rows > 0) {
//     while ($row = $class_result->fetch_assoc()) {
//       echo "<option value=\"" . $row["Class_Id"] . "\">" . $row["Class_Name"] . "</option>";
//     }
//   } else {
//     echo "<option disabled selected value>No classes found</option>";
//   }
// }


// Select view of available classes for users from accessing the page 
// Admin's can see all classes regardless of status
if (isset($_SESSION['email']) && $_SESSION['role'] == 'admin') {
  $class_query = "SELECT Class_Id, Class_Name, Description, Status
                  FROM classes;";
} 
// Non-Admin's and users not logged in can only see "Approved" Classes
else {
  $class_query = "SELECT c.Class_Id, c.Class_Name, c.Description, c.Status
                  FROM classes c
                  JOIN offerings o ON c.Class_Id = o.class_id
                  JOIN preferences p ON o.batch = p.value
                  WHERE p.variable = 'Active Registration' AND c.Status = 'Approved';";
}

// Fetch classes from the database
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



echo "</select>
		<!--dropdown--->
		
		</label><!---radioButtons--->
		<br>
    </div>

    <div id=\"right\">
      
        <!---Sponsor 1's Section -->
        <label id=\"name-label\">Sponsor 1's Name: </label>
        <input type=\"text\" id=\"sponsor1-name\" name=\"sponsor1-name\" class=\"form\" placeholder=\"Enter Sponsor 1's name\"><br><!--name--->
        <label id=\"sponsor1-email-label\"> Sponsor 1's Email: </label>
        <input type=\"email\" id=\"sponsor1-email\" name=\"sponsor1-email\" class=\"form\" placeholder=\"Enter Sponsor 1's email\"><br><!---email-->
        <label id=\"sponsor1-number-label\">Sponsor 1's Phone Number: </label>
        <input type=\"tel\" id=\"sponsor1-phone\" name=\"sponsor1-phone\" placeholder=\"123-456-7899\" pattern=\"[0-9]{3}-[0-9]{3}-[0-9]{4}\">
        <br>
        <br>
        <!---Sponsor 2 Section -->
        <label id=\"sponsor2-name-label\">Sponsor 2's Name: </label>
        <input type=\"text\" id=\"sponsor2-name\" name=\"sponsor2-name\" class=\"form\" placeholder=\"Enter Sponsor 2's name\"><br>
        <label id=\"sponsor2-email-label\"> Sponsor 2's Email: </label>
        <input type=\"email\" id=\"sponsor2-email\" name=\"sponsor2-email\" class=\"form\" placeholder=\"Enter Sponsor 2's email\"><br>
        <label id=\"sponsor2-number-label\">Sponsor 2's Phone Number: </label>
        <input type=\"tel\" id=\"sponsor2-phone\" name=\"sponsor2-phone\" placeholder=\"123-456-7899\" pattern=\"[0-9]{3}-[0-9]{3}-[0-9]{4}\">

      </div>
<br>
    <input type=\"submit\" id=\"submit-registration\" name=\"submit\" value=\"Submit\">
    <input type=\"hidden\" id=\"action\" name=\"action\" value=\"add\">
    </form><!---survey-form--->";
    fetchRegistrationDetails($connection, $User_Id);
    mysqli_close($connection);

echo "  
  </body>
</html>";
?>