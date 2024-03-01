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
  <form action="password_reset_notification.php" method="post"> <!-- This button will take the user's email and once they click on the button
                                                                     it should send them a email about the next steps -->
      <label for="usermail">Email</label>
      <br>
      <input id="usermail" type="email" name="usermail" placeholder="Yourname@email.com" required>
      <br>
      <input type="submit" id="submit" value="submit"/> 
	</form>

    <form action="login.php" method="post"> <!-- This form/button is a cancel button which will take the user back to the login page -->
        <br>
        <input type="submit" id="submit" value="cancel"/>
    </form>
</html>
