<?php
  $status = session_status();

  if ($status == PHP_SESSION_NONE) 
  {
    session_start();
  }
	$Blog_ID = $_GET['query'];
	// Create connection
	$conn = new mysqli('localhost', 'root', '', 'learn_and_help_db');
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT * FROM blogs where Blog_Id='$Blog_ID'";
	$result = $conn->query($sql);
	$result = mysqli_fetch_array($result);
	// Getting List Images
	$PIC_sql = "SELECT * FROM blog_pictures where Blog_Id='$Blog_ID'";
	$QUERY_LIST = $conn->query($PIC_sql);
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
	<form action="add_Editblog.php" method="post" enctype="multipart/form-data">
  	<center>
	 <table style="width:100%" border="1" cellpadding="2">
		<tr style="background-color:lightgray; font-weight:bold; font-size:25px; text-align:center">
			<td colspan="3">Edit Blog Information</td>
			
		</tr>
		<tr>
			<td style="width:15%;" align="right">Blog ID</td>
			<td style="width:50%" align="left;"><input type="text" id="Blog_Id " name="Blog_Id" style="background-color:darkgray; color:black; font-weight:bold" value='<?php echo $result['Blog_Id']; ?>' readonly></td>
			<td rowspan="6" valign="top" style="border:solid 1px; width:25%">
				<table style="width:175px">
				<?php
				
				while($row = mysqli_fetch_array($QUERY_LIST)) 
				{
					echo "<tr>
					<td><img src='".$row["Location"]."' style='width:150px; height:150px'>
						<a href='admin_delete_blog_pictures.php?query=".$row['Picture_Id']."&Secure=".$Blog_ID."'>Delete</a>
					</td>
					</tr>";
				}
				?>
				</table>
			</td>
		</tr>
		<tr>
			<td style="width:15%;" align="right">Title </td>
			<td style="width:50%" align="left"><input type="text" id="Title" name="Title" value='<?php echo $result['Title']; ?>' placeholder="Title"></td>
		</tr>
		<tr>
			<td style="width:15%;" align="right">Author </td>
			<td style="width:50%" align="left"><input type="text" id="Author" name="Author" value='<?php echo $result['Author']; ?>' placeholder="Author"></td>
		</tr>
		<tr>
			<td style="width:15%;" align="right">Description </td>
			<td style="width:50%" align="left"><input type="text" id="Description" name="Description" value='<?php echo $result['Description']; ?>' placeholder="Description"></td>
		</tr>
		<tr>
			<td style="width:15%;" align="right">Video_Link </td>
			<td style="width:50%" align="left"><input type="text" id="Video_Link" name="Video_Link" value='<?php echo $result['Video_Link']; ?>' placeholder="Video Link"></td>
		</tr>
		<tr>
			<td style="width:15%;" align="right">Upload Picture </td>
			<td style="width:50%" align="left"><input type="file" id="Location" name="Location[]" multiple></td>
		</tr>
		<tr>
			<td></td>
			<td colspan=2>
				<input type="submit" value="Save" id="btnSave" name="btnSave">
			</td>
		</tr>
	 </table>  	
	  </center>
    </form>

	</div>
  </body>
</html>
