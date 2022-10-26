<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Learn and Help</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
    <?php include 'show-navbar.php';
          include 'edit_fill.php';
          ?>
    <header class="inverse">
      <div class="container">
        <h1> <span class="accent-text">Registration Form</span></h1>
      </div>
      <?php show_navbar(); ?>
    </header>
    <h3> Edit Registration </h3>
    <div id="container_2">
    <?php
      fill_form();
    ?>
    <input type="hidden" id="action" name="action" value="edit">
		<br>
		<input type="submit" id="submit-registration" name="submit" value="Submit">
	  </form><!---survey-form--->
	</div>
  </body>
</html>
