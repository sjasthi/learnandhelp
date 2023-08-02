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
        <h1> <span class="accent-text">Upload Media</span></h1>
      </div>
	</header>
	You will be returned to the edit page once all processing is complete.<br><br>
	<div>
<?php
if(isset($_POST['submit'])) {
    // Configure upload directory and allowed file types
    $upload_dir = "schools/$id/";
    $allowed_types = array('jpg', 'png', 'jpeg', 'gif');
     
    // Define maxsize for files i.e 2MB
    $maxsize = 3 * 1024 * 1024;

	//echo "$upload_dir";
	if(!file_exists($upload_dir)) {
		mkdir($upload_dir);
	}
  
	// Checks if user sent an empty form
    if(!empty(array_filter($_FILES['files']['name']))) {
 
        // Loop through each file in files[] array
        foreach ($_FILES['files']['tmp_name'] as $key => $value) {
             
            $file_tmpname = $_FILES['files']['tmp_name'][$key];
            $file_name = $_FILES['files']['name'][$key];
            $file_size = $_FILES['files']['size'][$key];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
 
            // Set upload file path
            $filepath = $upload_dir.$file_name;
 
            // Check file type is allowed or not
            if(in_array(strtolower($file_ext), $allowed_types)) {
                // Verify file size - 3MB max
                if ($file_size > $maxsize) {        
                    echo "Error: File size is larger than the allowed limit.<br>";
				} else {
					// Check if filename already exists
                	if(file_exists($filepath)) {
						echo "$file_name already exists<br>";
					} else {
						// Upload the file
						if( move_uploaded_file($file_tmpname, $filepath)) {
                    		echo "$file_name successfully uploaded<br>";
							$fileCount = count(glob($upload_dir."profile_image.*"));
							if ($fileCount == 0) {
								$path_parts = pathinfo($filepath);
								$new_file = $upload_dir . 'profile_image.' . $path_parts['extension'];
								$old_file = $filepath;
								if(copy($old_file, $new_file)) {
									echo "$old_file has been copied to $new_file<br>";
								}
							}
                    	} else {                    
                        	echo "Error uploading $file_name<br>";
                    	}
					}
				}
            } else {
                // If file extension not valid
                echo "Error uploading $file_name ";
                echo "($file_ext file type is not allowed)<br>";
            }
		}
    } else {
        // If no files selected
        echo "No files selected.<br>Returning to edit page in 5 seconds<br>";
    }
}
			echo "<form  id='upload_form' action='admin_edit_school.php' method='POST'>
				<input type='hidden' name='id' value='$id'>";
?>
  				<script type="text/javascript">setTimeout(function(){document.getElementById('upload_form').submit();},500);
				</script>
			</form>
		</div>
	</body>
</html>
