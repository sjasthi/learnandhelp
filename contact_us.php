<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" href="images/logo.png" type="image/icon type">
    <title>Learn and Help</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
  <?php include 'show-button.php'; ?>
  <header class="inverse">
      <div class="container">
        <img class ="logo" src="logo.png" alt="Logo">
        <h1> <span class="accent-text">Contact Us</span></h1>
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
    <section class="about-me">
      <div class="container">
        <h2><span class="accent-text">Any Questions?</span></h2>
        <p>Please contact <strong>Siva Jasthi</strong></p>
        <a href="mailto: Siva.Jasthi@gmail.com"> Siva.Jasthi@gmail.com</a>
        <p>651.276.4671</p>
      </div>
    </section>
  </body>
</html>
