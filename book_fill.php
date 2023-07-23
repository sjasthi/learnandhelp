<?php
require 'db_configuration.php';

  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
  
  function admin_book_form($id){
	if ($id != null) {   	
		$connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

  		if ($connection === false) {
    		die("Failed to connect to database: " . mysqli_connect_error());
  		}
  		$sql = "SELECT * FROM books WHERE id = '$id'";
  		$row = mysqli_fetch_array(mysqli_query($connection, $sql));
  		$author = $row["author"];
  		$available = $row["available"];
  		$callnumber = $row["callNumber"];
		$gradelevel = $row["grade_level"];
		$id = $row["id"];
  		$image = $row["image"];
  		$numpages = $row["numPages"];
  		$price = $row["price"];
  		$publisher = $row["publisher"];
  		$publishyear = $row["publishYear"];
  		$title = $row["title"];
	} else {
-  		$author = "";
  		$available = "";
-  		$callnumber = "";
-  		$gradelevel = "";
-  		$id = "";
  		$image = "";
  		$numpages = "";
-  		$price = "";
-  		$publisher = "";
-  		$publishyear = "";
-  		$title = "";
	}


	echo "<img src='" . $image . "' onerror=\"src='images/books/default.png'\" loading='lazy'><br>
    <div id=\"container_2\">
  	<form id=\"survey-form\" action=\"book_submit_form.php\" method = \"post\">
    <input type='hidden' name='id' value=$id>
	<label id=\"callnumber-label\">Call Number</label><br>
	<input type=\"text\" id=\"callnumber\" name=\"callnumber\" class=\"form\" value=\"$callnumber\"><br><!--callnumber-->
	<label id=\"title-label\">Title</label><br>
	<input type=\"text\" id=\"title\" name=\"title\" class=\"form\" value=\"$title\" required><br><!--title-->
	<label id=\"author-label\">Author</label><br>
	<input type=\"text\" id=\"author\" name=\"author\" class=\"form\" value=\"$author\" required><br><!--author-->
    <label id=\"grade-level-label\">Grade Level</label><br> <!--make this multi select to format the comma separators etc-->
	<select id=\"gradelevel-dropdown\" name=\"gradelevel\" multiple required><!--gradelevel-->
   	<option disabled value>Select Grade Level</option>
   	<option value='High School' ";
   	if (str_contains(strtolower($gradelevel), "high school"))
       	echo "selected";
      	echo  ">High School</option>
   	<option value='Primary School Upper' ";
   	if (str_contains(strtolower($gradelevel), "primary school upper"))
       	echo "selected";
      	echo ">Primary School Upper</option>
  	<option value='Primary School Lower' ";
       	if (str_contains(strtolower($gradelevel), "primary school lower"))
       	echo "selected";
      	echo ">Primary School Lower</option>
	</select><br>
	<label id=\"price-label\">Price</label><br>
    <input type=\"text\" id=\"price\" name=\"price\" class=\"form\" value=\"$price\" required></div><!--price-->
	
	<div id=\"right\">
	<label id=\"publisher-label\">Publisher</label><br>
    <input type=\"text\" id=\"publisher\" name=\"publisher\" class=\"form\" value=\"$publisher\" required><br><!--publisher-->
	<label id=\"publish-year-label\">Published Year</label><br>
	<input type=\"text\" id=\"publish-year\" name=\"publish-year\" class=\"form\" value=\"$publishyear\"><br><!--publishyear-->
    <label id=\"page-count-label\">Page Count</label><br>
    <input type=\"text\" id=\"page-count\" name=\"page-count\" class=\"form\" value=\"$numpages\"><br><!--numpages-->
	<label id=\"available-label\">Available</label><br>
    <input type=\"text\" id=\"available\" name=\"available\" class=\"form\" value=\"$available\" required><br></div><!--available-->";
}
?>
