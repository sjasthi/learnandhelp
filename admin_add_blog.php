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
    <?php include 'show-navbar.php';
          include 'admin_fill.php';
          ?>
    <?php show_navbar(); ?>
    <header class="inverse">
      <div class="container">
        <h1> <span class="accent-text">Blog Form</span></h1>
      </div>
	</header>
    <div id="container_1" style="text-align:center">
	<form action="add_blog.php" method="post" enctype="multipart/form-data">
  	<center>
	 <table style="width:50%" border="0" cellpadding="2">
		<tr style="background-color:lightgray; font-weight:bold; font-size:25px; text-align:center">
			<td colspan="2">Blog Information</td>
		</tr>
		<tr>
			<td style="width:25%;" align="right">Blog </td>
			<td style="width:90%" align="left"><input type="text" id="Blog_Id " name="Blog_Id " readonly></td>
		</tr>
		<tr>
			<td style="width:10%;" align="right">Title </td>
			<td style="width:90%" align="left"><input type="text" id="Title" name="Title" placeholder="Title"></td>
		</tr>
		<tr>
			<td style="width:10%;" align="right">Author </td>
			<td style="width:90%" align="left"><input type="text" id="Author" name="Author" placeholder="Author"></td>
		</tr>
		<tr>
			<td style="width:10%;" align="right">Description </td>
			<td style="width:90%" align="left"><input type="text" id="Description" name="Description" placeholder="Description"></td>
		</tr>
		<tr>
			<td style="width:10%;" align="right">Video_Link </td>
			<td style="width:90%" align="left"><input type="text" id="Video_Link" name="Video_Link" placeholder="Video Link"></td>
		</tr>
		<tr>
			<td style="width:10%;" align="right">Upload Picture </td>
			<td style="width:90%" align="left"><input type="file" id="Location" name="Location[]" multiple></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" value="Save" id="btnSave" name="btnSave">
			</td>
		</tr>
	 </table>  	
	  </center>
    </form>

	</div>
  </body>
</html>
