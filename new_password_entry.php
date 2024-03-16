<?php
// Start the session
session_start();

// Include the database configuration file
require 'db_configuration.php';

// Connect to the database
$connection = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

// Check if the connection is established
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}


// maybe i'm wrong but this is suppose to grab the user's email from the link  
// when they click on it from email message sent to them (look at password_change.php line 32) - Pong 
// Retrieve the email from the query parameter
if (isset($_GET['email'])) {  
    $email = $_GET['email'];
} else {
    // Handle the case where the email is not provided
    echo "Email not provided.";
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // <-- maybe the wrong location?? -pong

    // Retrieve the new password from the form
    $password = $_POST['Hash'];
    $hash = sha1($password);

    // Update the user's password in the database
    $updateQuery = "UPDATE users SET Hash = '$hash' WHERE Email = '$email'";

    // Perform the query
    $updateResult = mysqli_query($connection, $updateQuery);

    // Check if the query was successful
    if ($updateResult) { // <-- it's suppose to pop up and tell the user that the user's password has been updated but it doesn't do anything - pong
        // Redirect back to the appropriate page after successful update
        echo "<script>alert('Password has been changed');</script>";
    } else {
        // If there was an error, display the error message
        echo "<script>alert('Error unable to update password: " . mysqli_error($connection) . "');</script>";
    }
}

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>New Password Entry</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <script>
        var check = function() {
            if (document.getElementById('Hash').value == document.getElementById('password2').value) {
                document.getElementById('message').style.color = 'green';
                document.getElementById('message').innerHTML = 'Password match';
                document.getElementById('button1').disabled = false;
            } else {
                document.getElementById('message').style.color = 'red';
                document.getElementById('message').innerHTML = 'Password does not match';
                document.getElementById('button1').disabled = true;
            }
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        function showPassword() {
            var x = document.getElementById("Hash");
            var y = document.getElementById("password2");
            if (x.type === "password" || y.type === "password") {
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
        }
    </script>
</head>
<body>
<?php include 'show-navbar.php'; ?>
<?php show_navbar(); ?>
<header class="inverse">
    <div class="container">
        <h1><span class="accent-text">Reset your password</span></h1>
    </div>
</header>
<br>

<form action="login.php" method="POST"> <!-- this could be one of the issues. I kept changing the action but no password update. you can try "new_password_entry.php" -->
    <input type="hidden" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">

    <input type="password" name="Hash" id="Hash" placeholder="New Password" onkeyup='check();' style="width:400px" required/>

    <br>
    <input type="password" name="password2" id="password2" onkeyup='check();' placeholder="Repeat new password" style="width:400px" required/>
    <br>
    <input type="checkbox" onclick="showPassword()">Show Password
    <br>
    <span id='message'></span>
    <br>
    <input type="submit" id="button1" value="Save password"/>
</form>
</body>
</html>
