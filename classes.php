<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Learn and Help</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
  <?php include 'show-navbar.php'; ?>
  <?php show_navbar(); ?>
  <header class="inverse">
      <div class="container">
        <h1><span class="accent-text">Classes</span></h1>
      </div>
  </header>
    <section class="about-me">
      <div class="container">
        <h2><strong>Python 101</strong> <span class="accent-text">Introduction to Computers and Programming</span></h2>
        <h3>Course Topics:</h3>
          <ul>
          <li>Input, Processing, and Output</li>
          <li>Decision Structures and Boolean Logic</li>
          <li>Repetition Structures</li>
          <li>Functions</li>
          <li>Files and Exceptions</li>
          <li>Lists and Tuples</li>
          <li>More About Strings</li>
          <li>Dictionaries and Sets</li>
          <li>Classes and Object-Oriented Programming</li>
          <li>Inheritance</li>
          <li>Recursion</li>
          <li>GUI Programming</li>
          </ul>
	  </div>
	</section>
<!-- 	<section class="articles inverse">
	  <div class="container">
		<h2>Java<span class="accent-text">101</span></h2>
        <h3>Course Description:</h3>
		    <p>







            </p>
		<br>

	  </div>
	</section> -->
  </body>
</html>
