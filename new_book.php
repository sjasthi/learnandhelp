<?php
require 'db_configuration.php';

$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}

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
              <h1><span class=\"accent-text\">Create Book</span></h1>
          </div>
          </header>
      <h3 style=\"margin-top: 2%\"> New Book </h3>
    <div id=\"container_2\">
      <form id=\"new-form\" action=\"\" method = \"post\">
        <!--- editable Section -->

        <label id=\"id-label\">New Book Id</label>
        <input type=\"number\" id=\"book_id\" name=\"id\" class=\"form\" value=\"\"><br>

        <label id=\"title-label\">Book Title</label>
        <input type=\"text\" id=\"title\" name=\"title\" class=\"form\" value=\"\"><br>

        <label id=\"author-label\">Book Author</label>
        <input type=\"text\" id=\"author\" name=\"author\" class=\"form\" value=\"\"><br>
        
        <label id=\"publisher-label\">Publisher</label>
        <input type=\"text\" id=\"publisher\" name=\"publisher\" class=\"form\" value=\"\"><br>

        <label id=\"pyear-label\">Published Year</label>
        <input type=\"text\" id=\"pyear\" name=\"publishYear\" value=\"\"><br>
        
        <label id=\"price-label\">Book Price</label>
        <input type=\"text\" id=\"price\" name=\"price\" value=\"\"><br>

        <label id=\"numPages-label\">Page Number</label>
        <input type=\"number\" id=\"numPages\" name=\"numPages\" min=\"1\" value=\"\"><br>

        <label id=\"grade-label\">Grade Level</label>
        <select id=\"grade_level\" name=\"grade_level\">
          <option> - select - </option>
          <option value=\"High\">High</option>
          <option value=\"Middle\">Middle</option>
          <option value=\"Elementary\">Elementary</option>
        </select><br>

        <label id=\"available-label\">Available</label>
        <select id=\"available\" name=\"available\">
          <option value=\"1\">1</option>
          <option value=\"0\">0</option>
        </select><br>
        <br>

        <label id=\"callNumber-label\">Call Number</label>
        <input type=\"text\" id=\"callNumber\" name=\"callNumber\" value=\"\"><br><br>

        <!--label id=\"dateCreated-label\">Date Created</label>
        <input type=\"date\" id=\"date_created\" name=\"date_created\" class=\"form-control\" disabled value=\"\"><br><br>

        <label id=\"dateModified-label\">Date Modified</label>
        <input type=\"date\" id=\"date_modified\" name=\"date_modified\" class=\"form-control\" disabled value=\"\" ><br><br-->

        <input type='submit' name='submit' value='Submit'></br>
      </form>
        
    </div>
    </body>
  </html>";

  $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
  // Check connection
  if ($conn == false) {
    die("Failed to connect to database: " . mysqli_connect_error());
  }
  
  if(isset($_POST['submit'])){

    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];

    $publisher = $_POST['publisher'];
    $publishYear = $_POST['publishYear'];

    $price = $_POST['price'];
    $numPages = $_POST['numPages'];

    $grade_level = $_POST['grade_level'];
    $available = $_POST['available'];
    $callNumber = $_POST['callNumber'];

    $date_created = date("Y-m-d");

   // Add the new book record to books table in the database
    $sql = "INSERT INTO books (id, title, author, publisher, publishYear, price, numPages, grade_level,
     available, callNumber, date_created)
        VALUES ('$id', '$title', '$author', '$publisher', '$publishYear', '$price', '.$numPages.',
        '$grade_level', '. $available .', '$callNumber', '$date_created');";

    $result = mysqli_query($conn, $sql);
    header('Location: books.php');
}
mysqli_close($conn);

?>
