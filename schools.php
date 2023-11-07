<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }

	function get_profile_image($id) {
		$image_name = glob('schools/' . $id . '/profile_image.*');
		// should only be one file found, if there are two profile_image files
		// with different extensions something is wrong.  If there is no profile
		// image or more than one default to the admin_icons school icon.
		if(count($image_name) == 1) {
	 		return $image_name[0];
		} else {
			return "images/admin_icons/school.png";
		}
	}
?>

<!DOCTYPE html>
<script>
  // JS code for handling search functionality
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');

    searchButton.addEventListener('click', function () {
        const searchValue = searchInput.value;
        window.location.href = 'schools.php?search=' + encodeURIComponent(searchValue);
    });

    searchInput.addEventListener('keydown', function (event) {
        if (event.keyCode === 13) {
            searchButton.click();
        }
    });
});

</script>
<html>
  <head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Learn and Help</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">

    <!-- styles -->

    <style>
        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-input {
            width: 300px;
            padding: 10px;
            font-size: 16px;
        }

        .search-button {
            padding: 10px 20px;
            background-color: #99D930;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

    .school-icon {
      text-align: center;
      vertical-align: top;
      padding: 10px;
    }
    
    .school-icon img {
      max-width: 100px;
      max-height: 100px;
    }
    
    .school-info  p{
      font-size: 14px;
      margin: 0;
      color: #333;
      
    }
    </style>
    
  </head>
  <body>
    <?php include 'show-navbar.php'; ?>
    <?php show_navbar(); ?>
    <header class="inverse">
      <div class="container">
        <h1><span class="accent-text">Schools</span></h1>
      </div>
    </header>
     <div class="search-container">
        <input type="search" id="search-input" class="search-input" placeholder="Search by name or ID">
        <button id="search-button" class="search-button">Search</button>
    </div>
    <div style="padding-top: 10px; padding-bottom: 30px; width:90%; margin:auto; overflow:auto">
      <table id="school_icons">
        <?php
          // Pull Cause data from the databases and create a Jquery Datatable
          require 'db_configuration.php';
          $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
          if ($connection === false) {
            die("Failed to connect to database: " . mysqli_connect_error());
          }
           // Updated SQL query to include a search filter
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $sql = "SELECT id, name, type, category, state_name, state_code, address_text FROM schools WHERE id LIKE '%$search%' OR name LIKE '%$search%' OR type LIKE '%$search%' OR state_name LIKE '%$search%' OR state_code LIKE '%$search%' OR address_text LIKE '%$search%' OR category LIKE '%$search%' ORDER BY name ASC";
          $result = mysqli_query($connection, $sql);
          if ($result->num_rows > 0) {
			$counter = 0;  
			// Create table with data from each row
            while($row = $result->fetch_assoc()) {
				$time = time();
				$counter++;
				if($counter == 0) {
					echo "<tr>";
				}
				$id = $row["id"];
        $name = $row["name"];
        $type = $row["type"];
        $address = $row["address_text"];
        $state = $row["state_name"];
        $state_code = $row["state_code"];
        $category = $row["category"];


		      // if a profile image was not created use the admin_icons school.png as a default fallback image
        echo  "<td class=\"school-icon\">
                  <a href=\"school_details.php?School_Id=$id&target=_blank\">";
        $profile_image = get_profile_image($id);
        echo "      <img src=\"$profile_image?v=$time\" alt=\"school image\"><br>
                    <div class=\"school-info\">
                      <p>$id</p>
                      <p>$name</p>
                      <p>$type</p>
                      <p>$state_code</p>
                      <p>$category</p>
                    </div>
                  </a>
                </td>";
        if($counter % 5 == 0 && $counter > 0) {
          echo "</tr>";
          if($counter < $result->num_rows) {
            echo "<tr>";
					}
				}
            }
          }
        ?>
      </table>
    </div>
  </body>
</html>
