<?php
require 'db_configuration.php';
// Create connection
$conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['book_id'];
$file = $_POST['book_image'];

// remove book from database
$sql = "DELETE FROM books WHERE id = " . $id;
$result = $conn->query($sql);

// delete the book image
if(is_file($file)) {
	unlink($file);
}

$conn->close();
header("Location: books.php");
?>
