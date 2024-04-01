<?php
require 'db_configuration.php';
$connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
$action = $_POST['action'];
$First_name = $_POST['First_name'];
$Last_name = $_POST['Last_name'];
$Bio_data = $_POST['Bio_data'];
$image = $_POST['image'];

if ($action == 'add') {
    $sql = "INSERT INTO instructor VALUES
    (NULL, '$First_name','$Last_name', 'Bio_data')";
} else if ($action == 'update') {
    $id = $_POST['rowId'];
    $sql = "UPDATE instructor SET
            First_name = '$First_name',
            Last_name = '$Last_name'
            Bio_data =  '$Bio_data'
            WHERE instructor_ID = '$id'";
} else if ($action == 'delete') 
    $sql = "DELETE FROM instructor WHERE instructor_ID = $id";
if (!mysqli_query($connection, $sql)) {
    echo("Error description: " . mysqli_error($connection));
}
mysqli_close($connection);
header("Location: admin_classes.php");
echo $action;
?>
