<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

<<<<<<< Updated upstream
$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}

function get_profile_image($id)
{
  $image_name = glob('schools/' . $id . '/profile_image.*');
  // should only be one file found, if there are two profile_image files
  // with different extensions something is wrong.  If there is no profile
  // image or more than one default to the admin_icons school icon.
  if (count($image_name) == 1) {
    return $image_name[0];
  } else {
    return "images/admin_icons/school.png";
  }
}
=======
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
>>>>>>> Stashed changes
?>

<!DOCTYPE html>
<script>
  // JS code for handling search functionality
<<<<<<< Updated upstream
  document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');

    searchButton.addEventListener('click', function() {
      const searchValue = searchInput.value;
      window.location.href = 'schools.php?search=' + encodeURIComponent(searchValue);
    });

    searchInput.addEventListener('keydown', function(event) {
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

=======
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

>>>>>>> Stashed changes
    .school-icon {
      text-align: center;
      vertical-align: top;
      padding: 10px;
    }
<<<<<<< Updated upstream

=======
    
>>>>>>> Stashed changes
    .school-icon img {
      max-width: 100px;
      max-height: 100px;
    }
<<<<<<< Updated upstream

    .school-info p {
      font-size: 14px;
      margin: 0;
      color: #333;

    }

    .dot {
      cursor: pointer;
      height: 10px;
      width: 10px;
      margin: 0 2px;
      background-color: #FFFFFF;
      border-radius: 50%;
      display: inline-block;
      transition: background-color 0.6s ease;
    }

    .active,
    .dot:hover {
      background-color: #717171;
    }

    .slideshow-container {
      width: 100%;
      height: 100%;
      position: absolute;
      top: 0;
      left: 0;
      overflow: hidden;
    }

    .inverse {
      position: relative;
      background-size: cover;
      height: 300px;
      overflow: hidden;
    }

    .inverse h1 {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 3;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
      color: white;
      font-size: 3em;
      text-align: center;
      width: 100%;
    }

    .banner_slide {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: none;
    }

    .banner_slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .dots-container {
      position: absolute;
      bottom: 20px;
      left: 0;
      right: 0;
      text-align: center;
      z-index: 2;
    }
  </style>
</head>

<body>
  <?php include 'show-navbar.php'; ?>
  <?php show_navbar(); ?>
  <header class="inverse">
    <div class="slideshow-container">
      <?php
      //Get images from that dir
      $images_dir = "./images/banner_images/Schools/";
      $images = glob($images_dir . "*.{jpg,png}", GLOB_BRACE);

      //Putting the images into a individual slide
      foreach ($images as $index => $image) {
        $safe_image_path = htmlspecialchars($image, ENT_QUOTES, 'UTF-8');
        echo "<div class='banner_slide'>
                    <img src='{$safe_image_path}' alt='School banner image'>
                  </div>";
      }
      ?>
    </div>

    <h1><span class="accent-text">Schools</span></h1>

    <div class="dots-container">
      <?php

      //Creating navigation dots for each image
      foreach ($images as $index => $image) {
        $slide_number = $index + 1;
        echo "<span class='dot' onclick='currentSlide($slide_number)'></span>";
      }
      ?>
    </div>
  </header>

  <div class="search-container">
    <input type="search" id="search-input" class="search-input" placeholder="Search by name or ID">
    <button id="search-button" class="search-button">Search</button>
    <button id="sort-id-button" class="search-button">Sort by ID</button>
    <button id="show-nriva-button" class="search-button">Show NRIVA Schools</button>
    <button id="show-pgnf-button" class="search-button">Show PGNF Schools</button>
    <button onclick="window.location.href='school_location.php'">Google Pins</button>
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
      $sort_order = isset($_GET['sort']) ? $_GET['sort'] : 'id_desc';
      $show_nriva = isset($_GET['show_nriva']) ? $_GET['show_nriva'] : '';
      $show_pgnf = isset($_GET['show_pgnf']) ? $_GET['show_pgnf'] : '';

      $sql = "SELECT id, name, type, category, state_name, state_code, address_text, supported_by FROM schools WHERE 1=1";

      if ($search) {
        $sql .= " AND (id LIKE '%$search%' OR name LIKE '%$search%' OR type LIKE '%$search%' OR state_name LIKE '%$search%' OR state_code LIKE '%$search%' OR address_text LIKE '%$search%' OR category LIKE '%$search%')";
      }

      // If NRIVA schools shows add to query
      if ($show_nriva === 'true') {
        $sql .= " AND supported_by = 'NRIVA'";

        // If PGNF schools shows add to query
      } elseif ($show_pgnf === 'true') {
        $sql .= " AND supported_by = 'PGNF'";
      }

      // Sorting the query based on the order
      switch ($sort_order) {
        case 'id_asc':
          $sql .= " ORDER BY id ASC";
          break;
        case 'id_desc':
          $sql .= " ORDER BY id DESC";
          break;
        default:
          $sql .= " ORDER BY id DESC";
      }

      $result = mysqli_query($connection, $sql);

      if ($result->num_rows > 0) {
        $counter = 0;
        // Create table with data from each row
        while ($row = $result->fetch_assoc()) {
          $time = time();
          $counter++;
          if ($counter == 0) {
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
                  <a href=\"school_details.php?id=$id\">";
          $profile_image = get_profile_image($id);
          echo "      <img src=\"$profile_image?v=$time\" alt=\"school image\"><br>
                    <div class=\"school-info\">
                      <p>$id</p>
                      <p>$name</p>
                    </div>
                  </a>
                </td>";
          if ($counter % 5 == 0 && $counter > 0) {
            echo "</tr>";
            if ($counter < $result->num_rows) {
              echo "<tr>";
            }
          }
        }
      }
      ?>
    </table>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.getElementById('search-input');
      const searchButton = document.getElementById('search-button');
      const sortIdButton = document.getElementById('sort-id-button');
      const showNrivaButton = document.getElementById('show-nriva-button');
      const showPgnfButton = document.getElementById('show-pgnf-button');

      // Updating URL parameters
      function updateUrl(params) {
        // Creating a URL object from current page
        const currentUrl = new URL(window.location.href);
        // If the search is Null remove it
        for (let [key, value] of Object.entries(params)) {
          if (value === null) {
            currentUrl.searchParams.delete(key);
          } else {
            currentUrl.searchParams.set(key, value);
          }
        }
        return currentUrl.toString();
      }

      // Add Click event to the sort ID button
      sortIdButton.addEventListener('click', function() {
        const currentSort = new URLSearchParams(window.location.search).get('sort');
        window.location.href = updateUrl({
          sort: currentSort === 'id_asc' ? 'id_desc' : 'id_asc'
        });
      });

      // Add click event to show NRIVA button
      showNrivaButton.addEventListener('click', function() {
        window.location.href = updateUrl({
          show_nriva: 'true',
          show_pgnf: null
        });
      });

      // Add click event to show PGNF button
      showPgnfButton.addEventListener('click', function() {
        window.location.href = updateUrl({
          show_pgnf: 'true',
          show_nriva: null
        });
      });

      // Get the current sort order
      const currentSort = new URLSearchParams(window.location.search).get('sort');
      // Check if NRIVA schools are shown
      const showNriva = new URLSearchParams(window.location.search).get('show_nriva');
      // Check if PGNF schools are shown
      const showPgnf = new URLSearchParams(window.location.search).get('show_pgnf');

      showNrivaButton.classList.toggle('active', showNriva === 'true');
      showPgnfButton.classList.toggle('active', showPgnf === 'true');
    });

    //Setting slide index and displaying current slide
    let slideIndex = 1;
    showSlides(slideIndex);

    //Moving between slides
    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    //Displaying slides
    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("banner_slide");
      let dots = document.getElementsByClassName("dot");
      if (n > slides.length) {
        slideIndex = 1
      }
      if (n < 1) {
        slideIndex = slides.length
      }
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " active";
    }
  </script>

</body>

=======
    
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
        <button onclick="window.location.href='school_location.php'">Google Pins</button>
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
            // sorted by id by default
            $sql = "SELECT id, name, type, category, state_name, state_code, address_text FROM schools WHERE id LIKE '%$search%' OR name LIKE '%$search%' OR type LIKE '%$search%' OR state_name LIKE '%$search%' OR state_code LIKE '%$search%' OR address_text LIKE '%$search%' OR category LIKE '%$search%' ORDER BY id";
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
                  <a href=\"school_details.php?id=$id\">";
        $profile_image = get_profile_image($id);
        echo "      <img src=\"$profile_image?v=$time\" alt=\"school image\"><br>
                    <div class=\"school-info\">
                      <p>$id</p>
                      <p>$name</p>
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
>>>>>>> Stashed changes
</html>