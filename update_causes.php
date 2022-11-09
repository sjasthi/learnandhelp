<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learn_and_help_db";
$connection = new mysqli($servername, $username, $password, $dbname);
$action = $_POST['action'];
$id = $_POST['rowId'];
$name = $_POST['name'];
$desc = $_POST['description'];
$url = $_POST['URL'];
$cname = $_POST['contact_name'];
$email = $_POST['contact_email'];
$phone = $_POST['contact_phone'];
if ($action == 'add'){
    $sql = "INSERT INTO causes VALUES
    (NULL, '$name', '$desc', '$url', '$cname', '$email', '$phone')";
}
else if ($action == 'update'){
    $sql = "UPDATE causes SET 
            Cause_name = '$name',
            description = '$desc',
            URL = '$url',
            Contact_name = '$cname',
            Contact_email = '$email',
            Contact_phone = '$phone'
            WHERE Cause_Id = '$id'";

}
else if ($action == 'delete')
    $sql = "DELETE FROM causes WHERE Cause_Id = $id";
if (!mysqli_query($connection, $sql)) {
    echo("Error description: " . mysqli_error($connection));
}
mysqli_close($connection);
header("Location: causes.php");
echo $action;
?>