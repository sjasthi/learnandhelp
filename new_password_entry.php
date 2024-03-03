<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
 ?>
 

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
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
  <form action="" method="post"> <!-- This button takes the user back to their email and also sends them a notification that their password has changed  -->
    <label for="password">New password</label>
    <br>
    <input id="password" type="password" name="password" placeholder="New password" required>
    <br>
    <input id="password" type="password" name="password" placeholder="Repeat new password" required> <!-- check to make sure the new passwords are the same -->
    <br>
    <input type="submit" id="submit" value="submit"/>
</form>

</html>