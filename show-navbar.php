<?php
include 'show-button.php';

function show_navbar() {
    echo '<div class="navbar">
      <a href="homepage.php" id="nav-logo"><img id="logo" src="images/logo.png"></a>
      <div>'; getButton(); echo '</div>
      <a href="#">Instructors and Volunteers Sign Up</a>
      <a href="#">Classes</a>
      <a href="#">Testimonials</a>
      <a href="#">Causes</a>
      <a href="meet_our_instructors.php">Meet our Instructors</a>
      <a href="contact_us.php">Contact Us</a>
      <a href="registration_form.php" id="register">Register Now</a>
      </div>';
}

?>
