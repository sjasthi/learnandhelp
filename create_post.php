<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learn_and_help_db";

$connection = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST['create_post'])) {
  $title = $_POST['title'];
  $author = $_POST['author'];
  $description = $_POST['description'];
  $video_link = $_POST['video_link'];

  $file = $_FILES['file'];
  $fileName = $file['name'];
  $fileTMP = $file['tmp_name'];
  $fileSize = $file['size'];
  $fileError = $file['error'];
  $fileType = $file['type'];

  if ($fileError === 0) {
    
  } else {
    echo "There was an error uploading your file.";
  }

}

?>
