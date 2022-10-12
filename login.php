<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="icon" href="images/logo.png" type="image/icon type">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
  <?php include 'show-button.php'; ?>
  <header class="inverse">
      <div class="container">
          <img class ="logo" src="images/logo.png" alt="Logo">
          <h1> Welcome to <span class="accent-text">Learn and Help</span></h1>
      </div>
      <div class="navbar">
          <a href="homepage.php">Home</a>
          <a href="#">Instructors and Volunteers Sign Up</a>
          <a href="#">Classes</a>
          <a href="#">Testimonials</a>
          <a href="#">Causes</a>
          <a href="meet_our_instructors.php">Meet our Instructors</a>
          <a href="contact_us.php">Contact Us</a>
          <a href="registration_form.php" id="register">Register Now</a>
          <div><?php getButton(); ?></div>
      </div>
  </header>
  <form action="validate-login.php" method="post">
      <label for="usermail">Email</label>
      <input id="usermail" type="email" name="usermail" placeholder="Yourname@email.com" required>
      <label for="password">Password</label>
      <input id="password" type="password" name="password" placeholder="Password" required>
      <input type="submit" value="Login"/>
	</form>

  </body>
</html>
