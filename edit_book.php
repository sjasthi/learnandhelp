<?php
require 'db_configuration.php';

$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}


//function fill_form() {
  $sId = $_GET['id'];
  if (isset($sId)){
    
    $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

    if ($connection === false) {
  	  die("Failed to connect to database: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM books WHERE Id = '$sId'";
    $row = mysqli_fetch_array(mysqli_query($connection, $sql));

    $b_id = $row['id'];
    $title = $row['title'];
    $author = $row['author'];

    $publisher = $row['publisher'];
    $publishYear = $row['publishYear'];

    $price = $row['price'];
    $numPages = $row['numPages'];

    $grade_level = $row['grade_level'];
    $available = $row['available'];
    $callNumber = $row['callNumber'];

    $date_created = $row['date_created'];
    $date_modified = $row['date_modified'];

  
  include 'show-navbar.php';

echo "<!DOCTYPE html>
<html>
  <head>
    <link rel=\"icon\" href=\"images/icon_logo.png\" type=\"image/icon type\">
    <title>Learn and Help</title>
    <link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css\"
    crossorigin=\"anonymous\">
    <link href=\"https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap\" rel=\"stylesheet\">
    <link href=\"css/main.css\" rel=\"stylesheet\">
  </head>
  <body>";
    show_navbar();
    echo "<header class=\"inverse\">
          <div class=\"container\">
              <h1><span class=\"accent-text\">Edit Book</span></h1>
          </div>
          </header>
      <h3 style=\"margin-top: 2%\"> Book Id: $b_id </h3>
    <div id=\"container_2\">
      <form id=\"edit-form\" action=\"\" method = \"post\">
        <input type='hidden' name='Id' value=$b_id>
        <!--- editable Section -->

        <label id=\"title-label\">Book Title</label>
        <input type=\"text\" id=\"title\" name=\"title\" class=\"form\" value=\"$title\"><br>

        <label id=\"author-label\">Book Author</label>
        <input type=\"text\" id=\"author\" name=\"author\" class=\"form\" value=\"$author\"><br>
        
        <label id=\"publisher-label\">Publisher</label>
        <input type=\"text\" id=\"publisher\" name=\"publisher\" class=\"form\" value=\"$publisher\"><br>

        <label id=\"pyear-label\">Published Year</label>
        <input type=\"text\" id=\"pyear\" name=\"publishYear\" value=\"$publishYear\" ><br>
        
        <label id=\"price-label\">Book Price</label>
        <input type=\"text\" id=\"price\" name=\"price\" value=\"$price\"><br>

        <label id=\"numPages-label\">Page Number</label>
        <input type=\"number\" id=\"numPages\" name=\"numPages\" value=\"$numPages\"><br>

        <label id=\"grade-label\">Grade Level</label>
        <select id=\"grade\" name=\"grade_level\">
          <option> $grade_level </option>
          <option value=\"High\">High</option>
          <option value=\"Middle\">Middle</option>
          <option value=\"Elementary\">Elementary</option>
        </select><br>

        <label id=\"available-label\">Available</label>
        <select id=\"grade\" name=\"available\">
          <option> $available </option>
          <option value=\"0\">0</option>
          <option value=\"1\">1</option>
        </select><br><br>

        <label id=\"callNumber-label\">Call Number</label>
        <input type=\"text\" id=\"callNumber\" name=\"callNumber\" value=\"$callNumber\" required><br><br>

        <label id=\"dateCreated-label\">Date Created</label>
        <input type=\"text\" id=\"date_created\" name=\"date_created\" value=\"$date_created\" disabled><br><br>

        <label id=\"dateModified-label\">Date Modified</label>
        <input type=\"text\" id=\"date_modified\" name=\"date_modified\" value=\"$date_modified\" disabled><br><br>

        <input type='submit' name='submit' value='Submit'></br>
      </form>
        
    </div>
    </body>
  </html>";
}

    if(isset($_POST['submit'])){

      $id = $_POST['Id'];
      $title = $_POST['title'];
      $author = $_POST['author'];

      $publisher = $_POST['publisher'];
      $publishYear = $_POST['publishYear'];

      $price = $_POST['price'];
      $numPages = $_POST['numPages'];

      $grade_level = $_POST['grade_level'];
      $available = $_POST['available'];
      $callNumber = $_POST['callNumber'];

      $date_modified = date("Y-m-d");


    // Update books record table in the database
      $sql = "UPDATE books SET title = '$title', author = '$author', publisher = '$publisher',
      publishYear = '$publishYear', price = '$price', numPages = '$numPages',
      grade_level = '$grade_level', available = '$available', callNumber = '$callNumber',
      date_modified = '$date_modified' WHERE id = '$id' ";

      $result = mysqli_query($connection, $sql);
      header('Location: books.php');
    }
    mysqli_close($connection);

?>
