<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}

// Block unauthorized users from accessing the page
if (isset($_SESSION['role'])) {
  if ($_SESSION['role'] != 'admin') {
    http_response_code(403);
    die('Forbidden');
  }
} else {
  http_response_code(403);
  die('Forbidden');
}
?>

<!DOCTYPE html>
<html lang="en-us">

<head>
  <link rel="icon" href="images/icon_logo.png" type="image/icon type">
  <title>Administration</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
</head>
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

<body>
  <?php include 'show-navbar.php'; ?>
  <?php show_navbar(); ?>
  <header class="inverse">
    <div class="slideshow-container">
      <?php
      //Get images from that dir
      $images_dir = "./images/banner_images/Admin/";
      $images = glob($images_dir . "*.{jpg,png}", GLOB_BRACE);
      //Putting the images into a individual slide
      foreach ($images as $index => $image) {
        $safe_image_path = htmlspecialchars($image, ENT_QUOTES, 'UTF-8');
        echo "<div class='banner_slide'>
<img src='{$safe_image_path}' alt='School banner image'>
</div>";
      }
      ?>
      <div class="container">
        <h1><span class="accent-text">Administration</span></h1>
      </div>

    </header>
    <div id="admin_icons" style="width: 80%; margin: auto;">
      <div class="admin_icon">
          <a href="admin_preferences_CRUD.php" id="preferences">
          <img src="images/admin_icons/control.png" alt="preferences"></a>
          <br>
          <label for="preferences">Preferences</label>
      </div>
      
      <div class="admin_icon">
          <a href="admin_offerings_CRUD.php" id="offerings">
          <img src="images/admin_icons/counting.png" alt="offerings"></a>
          <br>
          <label for="preferences">Offerings</label>
      </div>
      
      <div class="admin_icon">
          <a href="admin_batch_CRUD.php" id="batch">
          <img src="images/admin_icons/deadline.png" alt="batch"></a>
          <br>
          <label for="preferences">Batch</label>
      </div>
      <div class="admin_icon">
        <a href="admin_registrations.php" id="registrations"><img src="images/admin_icons/registrations_icon.png" alt="registration"></a>
        <br>
        <label for="registrations">Registrations</label>
      </div>
      <div class="admin_icon">
        <a href="admin_usersList.php" id="users"><img src="images/admin_icons/users_icon.png" alt="users"></a>
        <br>
        <label for="users">Users</label>
      </div>
      <div class="admin_icon">
        <a href="admin_schools.php" id="schools"><img src="images/admin_icons/school.png" alt="schools"></a>
        <br>
        <label for="schools">Schools</label>
      </div>
      
      <div class="admin_icon">
        <a href="school_report_html.php" id="schools"><img src="images/admin_icons/school.png" alt="schools"></a>
        <br>
        <label for="schools">Schools Report (HTML)</label>

      </div>
  </header>
  <div id="admin_icons" style="width: 80%; margin: auto;">
    <div class="admin_icon">
      <a href="admin_preferences_CRUD.php" id="preferences">
        <img src="images/admin_icons/control.png" alt="preferences"></a>
      <br>
      <label for="preferences">Edit Preferences</label>
    </div>
    <div class="admin_icon">
      <a href="admin_offerings_CRUD.php" id="offerings">
        <img src="images/admin_icons/counting.png" alt="offerings"></a>
      <br>
      <label for="preferences">Edit Offerings</label>
    </div>
    <div class="admin_icon">
      <a href="admin_batch_CRUD.php" id="batch">
        <img src="images/admin_icons/deadline.png" alt="batch"></a>
      <br>
      <label for="preferences">Edit Batch</label>
    </div>
    <div class="admin_icon">
      <a href="admin_registrations.php" id="registrations"><img src="images/admin_icons/registrations_icon.png" alt="registration"></a>
      <br>
      <label for="registrations">Registrations</label>
    </div>
    <div class="admin_icon">
      <a href="admin_usersList.php" id="users"><img src="images/admin_icons/users_icon.png" alt="users"></a>
      <br>
      <label for="users">Users</label>
    </div>
    <div class="admin_icon">
      <a href="admin_schools.php" id="schools"><img src="images/admin_icons/school.png" alt="schools"></a>
      <br>
      <label for="schools">Schools</label>
    </div>
    <div class="admin_icon">
      <a href="school_report_html.php" id="schools"><img src="images/admin_icons/school.png" alt="schools"></a>
      <br>
      <label for="schools">Schools Report (HTML)</label>
    </div>
    <div class="admin_icon">
      <a href="admin_notes.php" id="upload"><img src="images/admin_icons/Admin_notes.png" alt="admin_notes"></a>
      <br>
      <label for="upload">Admin Notes</label>
    </div>
    <br>
    <div class="admin_icon">
      <a href="admin_blogs.php" id="blogs"><img src="images/admin_icons/blogs_icon.png" alt="blogs"></a>
      <br>
      <label for="blogs">Blogs</label>
    </div>
    <div class="admin_icon">
      <a href="admin_reports.php" id="reports"><img src="images/admin_icons/reports_icon.png" alt="reports"></a>
      <br>
      <label for="reports">Reports</label>
    </div>
    <div class="admin_icon">
      <a href="books.php" id="books"><img src="images/admin_icons/books_icon.png" alt="books"></a>
      <br>
      <label for="books">Books</label>
    </div>
    <div class="admin_icon">
      <a href="book_report_html.php" id="books"><img src="images/admin_icons/books_icon.png" alt="books"></a>
      <br>
      <label for="books">Books Report(HTML)</label>
    </div>
    <div class="admin_icon">
      <a href="admin_classes.php" id="classes"><img src="images/admin_icons/class.png" alt="classes"></a>
      <br>
      <label for="classes">Classes</label>
    </div>
    <div class="admin_icon">
      <a href="admin_email_distribution.php" id="Email Distribution"><img src="images/admin_icons/email.png" alt="Email Distribution"></a>
      <br>
      <label for="Email Distribution">Email Distribution</label>
    </div>
    <div class="admin_icon">
      <a href="instructors.php" id="instructors">
        <img src="images/admin_icons/instructor.png" alt="instructors"></a>
      <br>
      <label for="instructors">Instructors</label>
    </div>

    <!-- review suggested schools -->
    <div class="admin_icon">
      <a href="admin_review_suggestions.php" id="suggested_schools"><img src="images/admin_icons/review.jpg" alt="suggested schools review logo"></a>
      <br>
      <label for="suggested_schools">Suggested Schools</label>
    </div>
    <div class="admin_icon">
      <a href="admin_api.php" id="api"><img src="images/admin_icons/api.png" alt="api"></a>
      <br>
      <label for="api">API</label>
    </div>
    <div class="admin_icon">
      <a href="admin_upload_csv.php" id="upload"><img src="images/admin_icons/upload.png" alt="upload"></a>
      <br>
      <label for="upload">Upload</label>
    </div>
    <div class="admin_icon">
      <a href="whats_app.php" id="upload"><img src="images/admin_icons/whats_app.png" alt="whatsapp"></a>
      <br>
      <label for="upload">Whats App</label>
    </div>
    <br>
    <div id="icon_attribution">
      <a href="https://www.flaticon.com/authors/freepik" title="freepik icons" id="icon_attribution">Icons created by Freepik - Flaticon</a>
    </div>
    <script>
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

</html>