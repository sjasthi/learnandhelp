<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }

  $book_id = $_POST['book_id'] ?? null;
  $book_image = $_POST['book_image'] ?? null;
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
    <?php include 'show-navbar.php';
          include 'book_fill.php';
          ?>
    <?php show_navbar(); ?>
    <header class="inverse">
      <div class="container">
        <h1> <span class="accent-text">Books Form</span></h1>
      </div>
	</header>
	<?php if ($book_id != null) {
		echo "<h3>Edit Book</h3>";
	} else {
		echo "<h3>Add Book</h3>";
	}
    ?>
    <div id="container_2">
	<?php
	    fill_book_form($book_id);
		if($book_id != null) { 
			echo "<input type=\"hidden\" id=\"action\" name=\"action\" value=\"admin_edit_book\">
		  	<br>
		  	<input type=\"submit\" id=\"submit-book\" name=\"submit\" value=\"Submit\">";
		} else {
			echo "<input type=\"hidden\" id=\"action\" name=\"action\" value=\"admin_add_book\">
	        <br>
	        <input type=\"submit\" id=\"submit-book\" name=\"submit\" value=\"Submit\">";
		}
	?>
	  </form><!--survey-form-->
	</div>
    <div>
    <?php if($book_id != null) { ?>
    	  <form action='book_edit_picture.php' method='post' enctype='multipart/form-data'>
			<?php echo "<input type=\"hidden\" name=\"book_id\" value=\"$book_id\">
			<input type=\"hidden\" name=\"book_image\" value=\"$book_image\">"; ?>
           	<input id="media_upload" type="file" name="file">
  		    <input type='submit' name='edit_image' value='Change Image'>
		</form>
     <?php } ?>
        <form method="POST" action="books.php">
          <input type="submit" value="Return to Books">
		</form>
    </div>  
  </body>
</html>
