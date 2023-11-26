<?php

session_start();

// print error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Include the database configuration file
require 'db_configuration.php';

$connection = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

// Check if the connection is established
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $firstname = $_POST['First_Name'];
    $lastname = $_POST['Last_Name'];
    $email = $_POST['email'];
    $phone = $_POST['Phone'];
    $password = $_POST['Hash'];
    $hash = sha1($password);
    $status = $_POST['Active'];
    $UserRole = $_POST['Role'];
    $modified_time = $_POST['Modified_Time'];
    $created_time = $_POST['Created_Time'];

    // SQL query to insert user data into the "users" table
    $createQuery = "INSERT INTO users (First_Name, Last_Name, Email, Phone, Hash, Active, Role, Modified_Time, Created_Time) 
                    VALUES ('$firstname', '$lastname', '$email', '$phone','$hash', '$status', '$UserRole', '$modified_time', '$created_time')";

    // Perform the query
    $createResult = mysqli_query($connection, $createQuery);

    // Check if the query was successful
    if ($createResult) {
        // Redirect back to the main PHP file or any desired page after successful insertion
        header("Location: admin_usersList.php");
        exit;
    } else {
        // If there was an error, display the error message
        echo "Error creating user: " . mysqli_error($connection);
    }
}

// Close the database connection (you should do this at the end of your PHP script)
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
       <link rel="icon" href="images/icon_logo.png" type="image/icon type">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
    <title>Create User</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            text-align: left !important;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
        }
        main {
            padding: 20px;
            max-width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        h1 {
            color: #333;
        }

        .form {
            width: 400px;
            margin-top: 20px;
        }

        label {
            display: block;
            margin-top: 10px;
            /* text-align: center; */
        }

        input[type="text"], input[type="password"],input[type="tel"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }

        select {
            width: 100%;
            padding: 5px;
            font-size: 16px;
        }

        .createBtn {
            padding: 10px 20px;
            margin-top: 10px;
            display: block;
            font-size: 16px;
            background-color: #99D930;
            color: #000;
            border: none;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>
    <?php 
    include 'show-navbar.php'; 
    show_navbar();
    ?>
     <?php
    //  show_navbar();
    // Central Daylight Time
    date_default_timezone_set('America/Chicago');

$currentDateTime = date("Y-m-d H:i:s"); // Format: YYYY-MM-DD HH:MM:SS

?>


    <main>
        <h1>Create User</h1>
        <form class="form" method="POST" action="" autocomplete="on" >
            <label for="First_Name">First Name</label>
            <input type="text" name="First_Name" id="First_Name" required placeholder="First Name">

            <label for="Last_Name">Last Name</label>
            <input type="text" name="Last_Name" id="Last_Name" required placeholder="Last Name">

            <label for="email">Email</label>
            <input type="text" name="email" id="email" required placeholder="Email">

            <label for="Phone">Phone</label>
            <input type="tel" name="Phone" id="Phone" required placeholder="Phone">

            <label for="Hash">Password</label>
            <input type="password" name="Hash" id="Hash" required placeholder="Password">

            <!-- Active -->
            <label for="active_yes">
            <input type="radio" name="Active" id="active_yes" value="Yes" checked>
            Yes </label>

            <label for="active_no"> <input type="radio" name="Active" id="active_no" value="No"> No
            </label>


            <!-- role -->
            <label for="Role">User Role</label>
            <select name="Role" id="Role" required>
                <option value="">Select Role</option>
                <option value="admin">Admin</option>
                <option value="student">Student</option>
                <option value="instructor">Instructor</option>
            </select>

            <!-- Created Time -->
            <label for="Created_Time">Created Time</label>
            <!-- Current Local Date -->
            <input type="datetime-local" name="Created_Time" id="Created_Time" value="<?php echo $currentDateTime ?>" >

            <!-- Modified Time -->
            <label for="Modified_Time">Modified Time</label>
            <input type="datetime-local" name="Modified_Time" id="Modified_Time" >

            <button class="createBtn" type="submit">Create User</button>
        </form>
    </main>
</body>
</html>
