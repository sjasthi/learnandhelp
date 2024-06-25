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
  <?php include 'show-navbar.php'; ?>
  <?php show_navbar(); ?>
  <header class="inverse">
    <div class="container">
      <h1><span class="accent-text">Instructors</span></h1>
    </div>
  </header>
  <section class="about-me">
    <div class="container">
      <?php
      require 'db_configuration.php';
      // Create connection
      $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      $sql = "SELECT * FROM `instructor`;";
      $result = $conn->query($sql);


      if ($result->num_rows > 0) {
        // Create table with data from each row
        while ($row = $result->fetch_assoc()) {
          $image = $row['Image'];
          echo "<h2>" . "Hello, my name is" . "<br>" .
            "<span class=accent-text>" . $row["First_name"] . " " . $row["Last_name"] . "<br>" .
            "<img src='$image' >" . "</span></h2>";

          echo '<p>' . $row['Bio_data'] . '</p>';
          echo "<br>";
        }
      }
      $conn->close();
      ?>
    </div>
  </section>

</body>

</html>