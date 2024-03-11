<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }

      // Include the database configuration file
      require 'db_configuration.php';

      $connection = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

      // Check if the connection is established
      if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
      }

      // Retrieve the User_ID from the query parameter
      if (isset($_POST['usermail'])) {
        $email = $_POST['usermail'];
      } else {
        // Handle the case where the User_ID is not provided in the URL
        // You can set a default value or handle it as needed
        $email = '';
      }

      // Check if the form is submitted
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $password = $_POST['password1']; // Retrieve the new password
        $hash = sha1($password); // Hash the password

        // Update the user's password in the database
        $updateQuery = "UPDATE users
                        SET
                            Hash = '$hash'
                        WHERE
                            Email = '$email'";

        // Perform the query
        $updateResult = mysqli_query($connection, $updateQuery);

        // Check if the query was successful
        if ($updateResult) {
          // Redirect back to the main PHP file or any desired page after successful update
          header("Location: admin_usersList.php");
          exit;
        } else {
          // If there was an error, display the error message
          echo "Error updating password: " . mysqli_error($connection);
        }
      }

      // Close the database connection (you should do this at the end of your PHP script)
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
        if (document.getElementById('password1').value == document.getElementById('password2').value) {
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
        var x = document.getElementById("password1");
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
  <form action="password_change_confirmation.php" method="post">
      <input type="password" name="password1" id="password1"  onkeyup='check();' placeholder="New password" style="width:400px" required/>
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