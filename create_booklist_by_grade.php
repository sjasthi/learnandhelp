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
        <h1><span class="accent-text">Receipt</span></h1>
      </div>
  </header>
    <table id="receipt_table">
      <thead>
        <tr>
          <th>Grade Level</th>
          <th>Title</th>
          <th>Publisher</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total Price</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Get all books matching
          require 'db_configuration.php';
          // Create connection
          $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
          // Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          $sql = "SELECT * FROM books WHERE (LOWER(grade_level) LIKE ";

          if (isset($_POST['high_school'])) 
          {
            $sql .= '"high school" OR LOWER(grade_level) LIKE "high"';
            if (isset($_POST['upper_primary_school'])) {
              $sql .= ' OR LOWER(grade_level) LIKE "upper primary school" OR LOWER(grade_level) LIKE "upper primary" OR LOWER(grade_level) LIKE "upper"';
            }
            if (isset($_POST['primary_school'])) {
              $sql .= ' OR LOWER(grade_level) LIKE "primary school"  OR LOWER(grade_level) LIKE "primary"';
            }
          } elseif (isset($_POST['upper_primary_school'])) {
            $sql .= '"upper primary school" OR LOWER(grade_level) LIKE "upper primary" OR LOWER(grade_level) LIKE "upper"';
            if (isset($_POST['primary_school'])) {
              $sql .= ' OR LOWER(grade_level) LIKE "primary school"  OR LOWER(grade_level) LIKE "primary"';
            }
          } elseif (isset($_POST['primary_school'])) {
            $sql .= '"primary school"  OR LOWER(grade_level) LIKE "primary"';
          }
          $sql .= ") AND available = 1";
          //echo $sql;
          $result = $conn->query($sql);
          $total_price = 0;
          $book_count = 0;
          if ($result->num_rows > 0) {
            // Create table with data from each row
            while($row = $result->fetch_assoc()) {
                $entry_price = floatval($row["price"]);
                echo "<tr>
                        <td>".$row['grade_level']."</td>
                        <td>".$row['title']."</td>
                        <td>".$row['publisher']."</td>
                        <td>".$row['price']."</td>
                        <td>1</td>
                        <td>₹".$entry_price."</td>
                      </tr>";
                $total_price = $total_price + $entry_price;
                $book_count = $book_count + 1;
              }
            }
          echo "  </tr>
                  </tbody>
                  </table>
                  <h3>Book Count: $book_count || Total Price: ₹$total_price</h3>"
        ?>
  </body>
</html>
