<?php
include 'show-button.php';

if (isset($_COOKIE['email'])){
  header("Location: form-submit.php");
}

echo "<!DOCTYPE html>
<html>
  <head>
    <link rel=\"icon\" href=\"images/logo.png\" type=\"image/icon type\">
    <title>Learn and Help</title>
    <link href=\"https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap\" rel=\"stylesheet\">
    <link href=\"css/main.css\" rel=\"stylesheet\">
  </head>
  <body>
      <header class=\"inverse\">
          <div class=\"container\">
              <img class =\"logo\" src=\"images/logo.png\" alt=\"Logo\">
              <h1><span class=\"accent-text\">Register Now</span></h1>
          </div>
          <div class=\"navbar\">
              <a href=\"homepage.php\">Home</a>
              <a href=\"#\">Instructors and Volunteers Sign Up</a>
              <a href=\"#\">Classes</a>
              <a href=\"#\">Testimonials</a>
              <a href=\"#\">Causes</a>
              <a href=\"meet_our_instructors.php\">Meet our Instructors</a>
              <a href=\"contact_us.php\">Contact Us</a>
              <a href=\"registration_form.php\" id=\"register\">Register Now</a>
              <div>"; getButton(); echo"</div>
          </div>
      </header>
      <h3> Registration Form</h3>
    <div id=\"container_2\">
      <form id=\"survey-form\" action=\"form-submit.php\" method = \"post\">
        <!---Sponsors Section -->
        <label id=\"name-label\">Sponsor's Name: </label>
        <input type=\"text\" id=\"sponsers-name\" name=\"sponsers-name\" class=\"form\" required placeholder=\"Enter Sponsor's name\"><br><!--name--->
        <label id=\"sponsers-email-label\"> Sponsor's Email: </label>
        <input type=\"email\" id=\"sponsers-email\" name=\"sponsers-email\" class=\"form\" required placeholder=\"Enter Sponsor's email\"><br><!---email-->
        <label id=\"sponsors-number-label\">Sponsor's Number: </label>
        <input type=\"tel\" id=\"sponsers-phone\" name=\"sponsers-phone\" placeholder=\"123-456-7899\" pattern=\"[0-9]{3}-[0-9]{3}-[0-9]{4}\" required>
        <br>
        <br>

        <!---Spouse Section -->
        <label id=\"spouses-name-label\">Spouse's Name: </label>
        <input type=\"text\" id=\"spouses-name\" name=\"spouses-name\" class=\"form\" required placeholder=\"Enter Spouse's name\"><br>
        <label id=\"spouses-email-label\"> Spouse's Email: </label>
        <input type=\"email\" id=\"spouses-email\" name=\"spouses-email\" class=\"form\" required placeholder=\"Enter Spouse's email\"><br>
        <label id=\"spouses-number-label\">Spouse's Number: </label>
        <input type=\"tel\" id=\"spouses-phone\" name=\"spouses-phone\" placeholder=\"123-456-7899\" pattern=\"[0-9]{3}-[0-9]{3}-[0-9]{4}\" required>

      </div>
      <div id= \"right\">
        <!---Student Section -->
        <label id=\"students-name-label\">Student's Name: </label>
        <input type=\"text\" id=\"students-name\" name=\"students-name\" class=\"form\" required placeholder=\"Enter Student's name\"><br>
        <label id=\"students-email-label\"> Student's Email: </label>
        <input type=\"email\" id=\"students-email\" name=\"students-email\" class=\"form\" required placeholder=\"Enter Student's email\"><br>
        <label id=\"students-number-label\">Student's Number: </label>
        <input type=\"tel\" id=\"students-phone\" name=\"students-phone\" placeholder=\"123-456-7899\" pattern=\"[0-9]{3}-[0-9]{3}-[0-9]{4}\" required>
        <br>
        <br>
        <label id=\"class\">Select Class: </label>
        <select id=\"dropdown\" name=\"role\" required>
          <option disabled selected value>
            Select your class
          </option>
          <option value=\"py1\">
            Python 101
          </option>
          <option value=\"java1\">
            Java 101
          </option>
          <option value=\"py2\">
            Python 201
          </option>
		  <option value=\"java2\">
			Java 201
		  </option>
		</select>
		<!--dropdown--->
		<p><strong>Cause</strong></p>
		<label>
		  <input type=\"radio\" name=\"cause\" value=\"lib\">Library
		</label>
		<br>
		<label>
		  <input type=\"radio\" name=\"cause\" value=\"Dig_class\">Digital Classroom</label>
		<label>
		  <br>
		  <input type=\"radio\" name=\"cause\" value=\"Other\"> No Preference
		</label><!---radioButtons--->
		<br>
    </div>
<br>
		<input type=\"submit\" id=\"submit-registration\" name=\"submit\" value=\"Submit\">
    <input type=\"hidden\" id=\"action\" name=\"action\" value=\"add\">
	  </form><!---survey-form--->

  </body>
</html>"
?>
