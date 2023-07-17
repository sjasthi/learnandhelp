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
  <body>
    <?php include 'show-navbar.php'; ?>
    <?php show_navbar(); ?>
    <header class="inverse">
      <div class="container">
        <h1><span class="accent-text">Administration</span></h1>
      </div>
    </header>
    <div id="admin_icons" style="width: 80%; margin: auto;">
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
        <a href="admin_causes.php" id="causes"><img src="images/admin_icons/causes_icon.png" alt="causes"></a>
        <br>
        <label for="causes">Causes</label>
      </div>
      <div class="admin_icon">
        <a href="admin_schools.php" id="schools"><img src="images/admin_icons/school.png" alt="schools"></a>
        <br>
        <label for="schools">Schools</label>
      </div>
      <br>
      <div class="admin_icon">
        <a href="admin_blogs.php" id="blogs"><img src="images/admin_icons/blogs_icon.png"  alt="blogs"></a>
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
        <a href="admin_classes.php" id="classes"><img src="images/admin_icons/class.png" alt="classes"></a>
        <br>
        <label for="classes">Classes</label>
      </div>
      <div class="admin_icon">
        <a href="admin_assignschooluserrole.php" id="assignschooluserrole"><img src="images/admin_icons/assign.png" alt="assignschooluserrole"></a>
        <br>
        <label for="classes">Assign User</label>
      </div>
      <div class="admin_icon">
        <a href="admin_shipping.php" id="admin_shipping"><img src="images/admin_icons/shipping.png" alt="admin_shipping"></a>
        <br>
        <label for="classes">Shipping</label>
      </div>
    </div>
    <br>
    <div id="icon_attribution">
      <a href="https://www.flaticon.com/authors/freepik" title="freepik icons" id="icon_attribution">Icons created by Freepik - Flaticon</a>
    </div>
  </body>
</html>
