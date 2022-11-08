<?php
include 'show-button.php';

function show_navbar() {
    echo '<div class="navbar">
      <a href="homepage.php" id="nav-logo"><img id="logo" src="images/learn_n_help_logo.png"></a>
      <div>'; getButton(); echo '</div>
      <a href="classes.php">Classes</a>
      <a href="#">Causes</a>
      <a href="blog.php">Blog</a>
      <a href="meet_our_instructors.php">Meet our Instructors</a>
      <a href="contact_us.php">Contact Us</a>
      <a href="administration.php">Administration</a>
      <a href="registration_form.php" id="register">Register Now</a>
      </div>';
}

?>
