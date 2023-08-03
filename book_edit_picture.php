<?php
require 'db_configuration.php';

$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();

  // Block unauthorized users from accessing the page
  if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] != 'admin') {
      http_response_code(403);
      die('Forbidden');
    }
  } else {
    http_response_code(403);
    die('Forbidden');
  }
}

$connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

if ($connection->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$book_id = $_POST['book_id'];
$image = $_POST['book_image'];

// delete the book image
if(is_file($image)) {
	unlink($image);
}


$fileName = $_FILES['file']['name'];
$fileTMP = $_FILES['file']['tmp_name'];
$fileError = $_FILES['file']['error'];
$fileExt = explode('.', $fileName);
$fileActualExt = strtolower(end($fileExt));
$fileDestination = "";
if ($fileError === 0) {
  $fileNewName = "book".$book_id.".".$fileActualExt;
  $fileDestination = 'images/books/'.$fileNewName;
  move_uploaded_file($fileTMP, $fileDestination);
} else {
  echo "There was an error uploading your file.";
}


$sql = "UPDATE books SET image = '$fileDestination' WHERE id = $book_id;";

if (!mysqli_query($connection, $sql)) {
  echo("Error description: " . mysqli_error($connection));
}

mysqli_close($connection);

echo "<div style=\"text-align:center;margin-top:200px;\"><h3>Deleting ".$image." and uploading new image.</h3></div>
	<form  id='upload_form' action='book_edit.php' method='POST'>
		<input type='hidden' name='book_id' value='$book_id'>
		<input type='hidden' name='book_image' value='$fileDestination'>
  		<script type=\"text/javascript\">setTimeout(function(){document.getElementById('upload_form').submit();},500);
		</script>
	</form>";
?>
