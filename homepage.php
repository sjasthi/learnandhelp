<!DOCTYPE html>
<script>
</script>
<html>
  <head>
    <link rel="icon" href="logo.png" type="image/icon type">
    <title>Learn and Help</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="main.css" rel="stylesheet">
  </head>
  <body>
    <header class="inverse">
      <div class="container">
        <img class ="logo" src="logo.png" alt="Logo">
        <h1> Welcome to <span class="accent-text">Learn and Help</span></h1>
      </div>
      <div class="navbar">
        <a href="homepage.html">Home</a>
        <a href="#">Instructors and Volunteers Sign Up</a>
        <a href="#">Classes</a>
        <a href="#">Testimonials</a>
        <a href="#">Causes</a> 
        <a href="meet_our_instructors.phtml">Meet our Instructors</a>
        <a href="contact_us.phtml">Contact Us</a>
        <a href="registration_form.phtml" id="register">Register Now</a>
		<div><?php echo 'hello'; ?></div>
      </div>
    </header>
    <section class="about">
      <div class="container">
        <h2>Learn and Help <span class="accent-text">Highlights</span></h2>
        <ul>
          <li>You learn "Python Programming" from Dr. Siva Jasthi!</li>
          <li>Online classes will be held from September 11 to May 28.</li>
          <li>Total number of classes: 30</li>
          <li>Total number of hours of instruction: ~50 hours</li>
          <li>Class Size: limited to ~25 students</li>
          <li>Course Fee: $500</li>
        </ul>
        <a href="#" class="btn">Click to learn more</a>
      </div>
    </section>
    <section class="inverse">
      <div class="container">
        <h2>Interested in <span class="accent-text">Learn and Help</span></h2>
        <article>
          <h3>Learn Programming Today!</h3>
          <a href="registration_form.phtml" class="btn">Register Now</a>
        </article>
      </div>
    </section>
  </body> 
</html>
