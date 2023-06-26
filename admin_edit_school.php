<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
 ?>

<?php $id = $_POST['id']?>
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
          include 'admin_fill.php';
          ?>
    <?php show_navbar(); ?>
    <header class="inverse">
      <div class="container">
        <h1> <span class="accent-text">Schools Form</span></h1>
      </div>
	</header>
	<?php if ($id != null) {
		echo "<h3>Edit School</h3>";
	} else {
		echo "<h3>Add School</h3>";
	}
    ?>
    <div id="container_2">
	<?php
	    admin_school_form($id);
        if($id != null) {
			echo "<input type='hidden' id='action' name='action' value='admin_edit_school'>";
		} else {
			echo "<input type='hidden' id='action' name='action' value='admin_add_school'>";
		}
    ?>
		<br>
		<input type="submit" id="submit-school" name="submit" value="Submit">
	  </form><!---survey-form--->
	</div>
  </body>
</html>
