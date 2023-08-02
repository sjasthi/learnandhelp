<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }

  $id = $_POST['id'] ?? null;
  $filename = $_POST['filename'] ?? null;

	function set_as_profile($id, $filename) {
		// delete any and all existing profile_image files
		foreach(glob("schools/$id/profile_image.*") as $f) {
    		unlink($f);
		}
		
		$filepath = "schools/$id/";
		$path_parts = pathinfo($filepath.$filename);
		$new_file = $filepath . 'profile_image.' . $path_parts['extension'];
		$old_file = $filepath . $filename;
		if(copy($old_file, $new_file)) {
			echo "<br>$filename has been copied to $new_file";
			echo "<script type=\"text/javascript\">setTimeout(function(){document.getElementById('media_edit_form').submit();},500);
				  </script>";
		} else {
			echo "<br><span id='error_msg'>ERROR: Unable to set file as profile image.  Renaming failed.</span>";
		}	
	}

	function delete_media_file($id, $filename) {
		if (!unlink("schools/$id/$filename")) {
    		echo ("<br><span id='error_msg'>$filename cannot be deleted due to an error</span>");
		} else {
    		echo ("<br>$filename has been deleted");
			echo "<script type=\"text/javascript\">setTimeout(function(){document.getElementById('media_edit_form').submit();},1000);
				  </script>";
		}
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
    <?php include 'show-navbar.php';
    ?>
    <?php show_navbar(); ?>
    <header class="inverse">
      <div class="container">
        <h1> <span class="accent-text">Edit Media</span></h1>
      </div>
    </header>
    <form method="POST" action="admin_edit_school.php">
		<?php echo "<input type=\"hidden\" name=\"id\" value=\"$id\">"; ?>
    	<input type="submit" value="Return to Edit Page">
	</form>
<?php
		echo "You will be returned to the edit page after all processing has completed.<br><br>
		<div id=\"school_media\">
			<img src=\"schools/$id/$filename\" alt=\"school image\">
			<br>
			<label>$filename</label>
		</div>";

		if(array_key_exists('delete_btn', $_POST)) {
			delete_media_file($_POST["id"], $_POST["filename"]);
		} else if (array_key_exists('default_btn', $_POST)) {
			set_as_profile($_POST["id"], $_POST["filename"]);
		}
?>
		<br>
		<div style="width: 15%; margin: auto; text-align: center;">
			<form method="POST">
				<?php echo "<input type=\"hidden\" name=\"id\" value='$id'>"; ?>
				<?php echo "<input type=\"hidden\" name=\"filename\" value='$filename'>"; ?>
        		<input type="submit" id="admin_buttons" name="default_btn" value="Set as Profile Image"/>
			</form>
			<form method="POST">
				<?php echo "<input type=\"hidden\" name=\"id\" value='$id'>"; ?>
				<?php echo "<input type=\"hidden\" name=\"filename\" value='$filename'>"; ?>
        		<input type="submit" id="admin_buttons" name="delete_btn" value="Delete File"/>
			</form>
			<?php
			echo "<form  id=\"media_edit_form\" action=\"admin_edit_school.php\" method=\"POST\">
					<input type=\"hidden\" name=\"id\" value=\"$id\">
				</form>";
			?>
		</div>
  </body>
</html>
