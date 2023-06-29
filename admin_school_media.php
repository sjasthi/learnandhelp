<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }

  $School_Id = $_GET['id'];
  $filename = $_GET['filename'];

	function set_as_profile($School_Id, $filename) {
		$fileCount = count(glob("schools/$School_Id/profile_image.*"));
		if ($fileCount > 0) {
			echo "<br><span id='error_msg'>ERROR: A profile image already exists.  Rename or delete it prior to setting a new one.</span>";
		} else {
			$filepath = "schools/$School_Id/";
			$path_parts = pathinfo($filepath . $filename);
			$new_file = $filepath . 'profile_image.' . $path_parts['extension'];
			$old_file = $filepath . $filename;
			if(rename($old_file, $new_file)) {
				echo "<br>$filename has been renamed to $new_file";
				echo "<script type=\"text/javascript\">setTimeout(function(){document.getElementById('media_edit_form').submit();},5000);
					  </script>";
			} else {
				echo "<br><span id='error_msg'>ERROR: Unable to set file as profile image.  Renaming failed.</span>";
			}	
		}
	}

	function delete_media_file($School_Id, $filename) {
		if (!unlink("schools/$School_Id/$filename")) {
    		echo ("<br><span id='error_msg'>$filename cannot be deleted due to an error</span>");
		} else {
    		echo ("<br>$filename has been deleted");
			echo "<script type=\"text/javascript\">setTimeout(function(){document.getElementById('media_edit_form').submit();},5000);
				  </script>";
		}
	}

	function rename_media_file($School_Id, $filename) {
		$new_file_name = $_POST['new_file_name'];
		$dir_name = "schools/$School_Id/";
		if(file_exists($dir_name . $new_file_name)) {
			echo ("<br><span id='error_msg'>ERROR: A file with that name already exists.</span>");
		} else {
			if(rename($dir_name . $filename, $dir_name . $new_file_name)) {
				echo "<br>$filename has been renamed to $new_file_name";
				echo "<script type=\"text/javascript\">setTimeout(function(){document.getElementById('media_edit_form').submit();},5000);
					  </script>";
			} else {
    			echo ("<br><span id='error_msg'>$filename could not be renamed due to an error</span>");
			}
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
<?php
  echo "<br>
		<div id=\"school_media\">
			<img src=\"schools/$School_Id/$filename\" alt=\"school image\">
			<br>
			<label>$filename</label>
		</div>";

		if(array_key_exists('delete_btn', $_POST)) {
			delete_media_file($School_Id, $filename);
		} elseif (array_key_exists('default_btn', $_POST)) {
			set_as_profile($School_Id, $filename);
		} elseif (array_key_exists('rename_btn', $_POST)) {
			rename_media_file($School_Id, $filename);
		}
?>
		<br>
		<div id="container_2">
			<form method="POST">
        		<input type="submit" id="admin_buttons" name="default_btn" value="Set Profile Image"/>
			</form>
			<form method="POST">
        		<input type="submit" id="admin_buttons" name="delete_btn" value="Delete Media File"/>
			</form>
			<form id="file-rename-form" method="POST">
        		<input type="submit" id="admin_buttons" name="rename_btn" value="Rename Media File"/><br>
    			<input type="text" id="file-name-field" name="new_file_name" class="form" required><br>
				<label id="file-name-label">New filename</label>
			</form>
			<?php
			echo "<form  id=\"media_edit_form\" action=\"admin_edit_school.php\" method=\"POST\">
					<input type=\"hidden\" name=\"id\" value=\"$School_Id\">
				</form>";
			?>
		</div>
  </body>
</html>
