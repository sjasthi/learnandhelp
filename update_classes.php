<?php
require 'db_configuration.php';
$connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
$action = $_POST['action'];
$id = $_POST['rowId'];
$name = $_POST['name'];
$desc = $_POST['description'];
$teacher_id = $_POST['teacher_id'];
if ($action == 'add'){
    $sql = "INSERT INTO classes VALUES
    (NULL, '$name', '$desc', '$teacher_id')";
}
else if ($action == 'update'){
    $sql = "UPDATE classes SET
            Class_name = '$name',
            description = '$desc',
            Teacher_Id = '$teacher_id'
            WHERE Class_Id = '$id'";
}
else if ($action == 'delete')
    $sql = "DELETE FROM classes WHERE Class_Id = $id";
if (!mysqli_query($connection, $sql)) {
    echo("Error description: " . mysqli_error($connection));
}
mysqli_close($connection);
header("Location: admin_causes.php");
echo $action;
?>
