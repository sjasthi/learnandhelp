<?php
require 'db_configuration.php';
$connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$action = $_POST['action'];
$First_name = $_POST['First_name'];
$Last_name = $_POST['Last_name'];
$Bio_data = $_POST['Bio_data'];
$image = $_POST['image'];

if ($action == 'add') {
    $sql = "INSERT INTO instructor (First_name, Last_name, Bio_data, Image) VALUES ('$First_name', '$Last_name', '$Bio_data', '$image')";
} else if ($action == 'update') {
    $id = $_POST['rowId'];
    $sql = "UPDATE instructor SET
            First_name = '$First_name',
            Last_name = '$Last_name',
            Bio_data = '$Bio_data',
            Image = '$image'
            WHERE instructor_ID = '$id'";
} else if ($action == 'delete') {
    $id = $_POST['rowId'];
    $sql = "DELETE FROM instructor WHERE instructor_ID = '$id'";
}

if (!$connection->query($sql)) {
    echo("Error description: " . $connection->error);
}

$connection->close();
header("Location: instructors.php");
exit();
?>