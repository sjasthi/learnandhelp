<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
 ?>

<?php $id = $_POST['book_id'] ?>

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
          include 'book_fill.php';
          ?>
    <?php show_navbar(); ?>
    <header class="inverse">
      <div class="container">
        <h1> <span class="accent-text">Books Form</span></h1>
      </div>
	</header>
	<?php if ($id != null) {
		echo "<h3>Edit Book</h3>";
	} else {
		echo "<h3>Add Book</h3>";
	}
    ?>
    <div id="container_2">
	<?php
	    admin_book_form($id);
     	if(isset($_SESSION['message'])) {
        	echo $_SESSION['message'];
	      	unset($_SESSION['message']);
	  	} else {  
			if($id != null) { 
				echo "<input type=\"hidden\" id=\"action\" name=\"action\" value=\"admin_edit_book\">
			  	<br>
			  	<input type=\"submit\" id=\"submit-sbook\" name=\"submit\" value=\"Submit\" onclick=\"setTimeout(function(){window.location.reload();},10);\">";
			} else {
				echo "<input type=\"hidden\" id=\"action\" name=\"action\" value=\"admin_add_book\">
		        <br>
		        <input type=\"submit\" id=\"submit-book\" name=\"submit\" value=\"Submit\">";
			}
		}
    ?>
	  </form><!---survey-form--->
	</div>
  </body>
</html>
