<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="icon" href="images/logo.png" type="image/icon type">
    <title>Create Account</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
  <?php include 'show-button.php'; ?>
  <header class="inverse">
      <div class="container">
          <img class ="logo" src="images/logo.png" alt="Logo">
          <h1><span class="accent-text">Create Account</span></h1>
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
  <br>
  <form action="process-new-account.php" method="post">
      <label for="firstname">First Name</label>
      <br>
      <input id="firstname" type="text" name="firstname" placeholder="First Name" required>
      <br>
      <label for="lastname">Last Name</label>
      <br>
      <input id="lastname" type="text" name="lastname" placeholder="Last name" required>
      <br>
      <label for="usermail">Email</label>
      <br>
      <input id="usermail" type="email" name="usermail" placeholder="Yourname@email.com" required>
      <br>
      <label for="password">Password</label>
      <br>
      <input id="password" type="password" name="password" placeholder="Password" required>
      <br>
      <input type="submit" id="submit-login" value="Login"/>
	</form>
  </body>
</html>
