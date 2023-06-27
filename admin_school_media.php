<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }

  $School_Id = $_GET['id'];
  $filename = $_GET['filename'];

	function delete_file($School_Id, $filename) {
		if (!unlink('schools/' . $School_Id . '/' . $filename)) {
    		echo ("<br>$filename cannot be deleted due to an error");
		} else {
    		echo ("<br>$filename has been deleted");
		}
		echo "<script type=\"text/javascript\">setTimeout(function(){document.getElementById('media_edit_form').submit();},5000);
			  </script>";
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
  echo '<br>
		<div id="school_media">
			<img src="schools/' . $School_Id . '/' . $filename . '" alt="school image\">
			<br>
			<label>' . $filename . '</label>
		</div>';

		if(array_key_exists('delete_btn', $_POST)) {
			delete_file($School_Id, $filename);
        }
?>
		<br>
		<div id="container_2">
			<input type="hidden" id="action" name="action" value="set_default">
        	<input type='submit' id='admin_buttons' name='submit' value='Set As Default'/>
			<input type="hidden" id="action" name="action" value="rename_file">
			<input type='submit' id='admin_buttons' name='submit' value='Rename'/>
			<form method="POST">
        		<input type='submit' id='admin_buttons' name='delete_btn' value='Delete'/>
			</form>
			<?php
			echo "<form  id='media_edit_form' action='admin_edit_school.php' method='POST'>
					<input type='hidden' name='id' value='$School_Id'>
				</form>";
			?>
		</div>
  </body>
</html>
