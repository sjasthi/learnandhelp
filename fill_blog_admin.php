<?php
require 'db_configuration.php';

$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}


//function fill_form() {

  if (isset($_POST['submit'])){
    $sId = $_POST['id'];
    $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

    if ($connection === false) {
  	  die("Failed to connect to database: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM schools WHERE Id = '$sId'";
    $row = mysqli_fetch_array(mysqli_query($connection, $sql));

    $s_id = $row['id'];
    $s_name = $row['name'];
    $s_email = $row['contact_email'];
    $s_type = $row['type'];
    $s_category = $row['category'];

  } else {
    $s_id = $_POST['id'];
    $s_name = $row['name'];
    $s_email = $row['contact_email'];
    $s_type = $row['type'];
    $s_category = $row['Category'];

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
              <h1><span class=\"accent-text\">Assign Blog Admin</span></h1>
          </div>
          </header>
      <h3> School blog admin</h3>
    <div id=\"container_2\">
      <form id=\"survey-form\" action=\"form-submit_blog.php\" method = \"post\">
        <input type='hidden' name='Id' value=$s_id>
        <!---Sponsors Section -->
        <label id=\"s-name-label\">School Name</label>
        <input type=\"text\" id=\"s-name\" name=\"s-name\" class=\"form\" value=\"$s_name\" required><br><!--name--->
        <label id=\"s-email-label\"> Contact Email</label>
        <input type=\"email\" id=\"s-email\" name=\"s-email\" class=\"form\" value=\"$s_email\" required><br><!---email-->
        
        <label id=\"s-type-label\">School Type</label>
        <input type=\"text\" id=\"s-type\" name=\"s-type\" class=\"form\" value=\"$s_type\" required><br>

        <label id=\"s-category-label\">Category</label>
        <input type=\"text\" id=\"s-category\" name=\"category\" value=\"$s_category\" required>

        <br>
        <!---Spouse Section -->
        <label id=\"s-contact-label\">Username</label>
        <input type=\"email\" id=\"s-contact\" name=\"s-contact\" class=\"form\" value=\"$s_email\" required><br>
        <label id=\"pwd-label\"> Assign Password</label>
        <input type=\"text\" id=\"pwd\" name=\"pwd\" class=\"form\" value=\"\" required ><br>
        <input type='submit' name='submit' value='Submit'></br>
      </form>
        
    </div>
    </body>
    </html>";
//}
?>
