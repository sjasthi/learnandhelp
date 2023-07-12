<?php
require 'db_configuration.php';
// Create connection
$conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
// Check connection
if ($conn->connect_error) 
{
  die("Connection failed: " . $conn->connect_error);
}
  // GET IMAGE to Remove
  $sql = "select Location FROM  blog_pictures WHERE Picture_Id=".$_GET['query'];
  $result = $conn->query($sql);
  $result = mysqli_fetch_array($result);

  $location = $result[0];
  $sql = "DELETE FROM  blog_pictures WHERE Picture_Id=".$_GET['query'];
  echo $sql;
  $result = $conn->query($sql);
  unlink($location);
  $conn->close();
  header("Location: admin_edit_blog.php?query=".$_GET['Secure']);
?>
