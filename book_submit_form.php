<?php
require 'db_configuration.php';

$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}

if (!(isset($_SESSION['email']))) {
	header('Location: login.php');
}

include 'show-navbar.php';
$connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

if ($connection === false) {
	die("Failed to connect to database: " . mysqli_connect_error());
}
if (isset($_POST['action'])) {
	$action = $_POST['action'];
} else {
	$action = '';
}

// data passed to form by $_POST
if($action == 'admin_edit_book' or $action == 'admin_add_book'){
	$id = $_POST['id'];
	$title = $_POST["title"];
	$author = $_POST["author"];
	$publisher = $_POST["publisher"];
	$publishyear = $_POST["publishyear"];
	$numpages = $_POST["numpages"];
	$price = $_POST["price"];
	$image = $_POST["image"];
    //potential multiple selections for gradelevel need to be converted to
	// a comma separated list that can be sent to MYSQL when doing an UPDATE
	// or INSERT
	$temp_array = $_POST["gradelevel"];
	for($i = 0; $i < count($temp_array); $i++) {
		if($i == 0) {
			$gradelevel = $temp_array[$i];
		} else {
			$gradelevel .= ', ' . $temp_array[$i];
		}
	}
	$available = $_POST["available"];
}
/*
else {
	// data coming from database, not sure this is even needed
	$id = $_SESSION['id'];
    $sql = "SELECT * FROM books WHERE id = '$id'";
    $row = mysqli_fetch_array(mysqli_query($connection, $sql));

	$action = '';
	$id = $row['id'];
	$title = $row["title"];
	$author = $row["author"];
	$publisher = $row["publisher"];
	$publishyear = $row["publishYear"];
	$numpages = $row["numPages"];
	$price = $row["price"];
	$image = $row["image"];
	$gradelevel = $row["grade_level"];
	$available = $row["available"];
}
 */
// where the inserts and updates take place
if($action == "admin_edit_book") {
	$sql = "UPDATE books SET
			title = '$title',
			author = '$author',
			publisher = '$publisher',
			publishYear = '$publishyear',
			numPages = '$numpages',
			price = '$price',
			image = '$image',
			grade_level = '$gradelevel',
			available = '$available'
			WHERE id = '$id';";
    $_SESSION['message'] = '<h4>Edits Submitted<h4><br>';
} elseif($action == 'admin_add_book') {
	$sql = "INSERT INTO books VALUES (
		'NULL',
		'$title',
		'$author',
		'$publisher', 
		'$publishyear',
		'$numpages',
	    '$price',
	    'NULL',
		'$gradelevel',
		'$available',
		CURRENT_TIME(),
	    CURRENT_TIME());";
}

if (!mysqli_query($connection, $sql)) {
	echo("Error description: " . mysqli_error($connection));
} else {
	if($action == 'admin_add_book') {
		$id = mysqli_insert_id($connection);
		// trigger hidden form to load admin_edit_school.php and POST $id
		echo "<script type=\"text/javascript\">setTimeout(function(){document.getElementById('add_submitted_form').submit();},500);
			  </script>";
	}
}

mysqli_close($connection);
?>

<form method="POST" id="add_submitted_form" action="book_edit.php">
	<?php echo "<input type=\"hidden\" name=\"book_id\" value=\"$id\">"; ?>
</form>

