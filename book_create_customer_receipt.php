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
    <script>
      function printDiv(divId) {
        var printContents = document.getElementById(divId).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
      }

    </script>
  </head>
  <body>
  <?php include 'show-navbar.php'; ?>

  <?php show_navbar(); ?>
  <a href="#" style="text-decoration:none; color:blue; padding:10px; float:right; margin-top:80px; margin-right:500px" onclick="printDiv('receipt')">
  <span style="color:blue; padding:10px; color:white; border:solid 2px lightblue; width:200px; border-radius:5px; box-shadow:0px 0px 2px 5px white">P r i n t &nbsp;&nbsp;&nbsp; R e c e i p t</span></a>

  <header class="inverse">
      <div class="container">
        <h1><span class="accent-text">Receipt</span></h1>
      </div>
  </header>
  <div id="receipt">
  <table id="receipt_table">
      <thead>
        <tr><th colspan="6"><h3><span class="accent-text">Receipt</span></h3></th></tr>
        <tr style="font-weight:bold; font-size:15px">
          <th align='left'>Grade Level</th>
          <th align='left'>Title</th>
          <th align='left'>Publisher</th>
          <th align='right'>Price</th>
          <th align='right'>Quantity</th>
          <th align='right'>Total Price</th>
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
            $sql .= '"high school"';
            if (isset($_POST['primary_school_upper'])) {
              $sql .= ' OR LOWER(grade_level) LIKE "primary school upper"';
            }
            if (isset($_POST['primary_school_lower'])) {
              $sql .= ' OR LOWER(grade_level) LIKE "primary school lower"';
            }
          } elseif (isset($_POST['primary_school_upper'])) {
            $sql .= '"upper primary school"';
            if (isset($_POST['primary_school_lower'])) {
              $sql .= ' OR LOWER(grade_level) LIKE "primary school lower"';
            }
          } elseif (isset($_POST['primary_school_lower'])) {
            $sql .= '"primary school lower"';
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
                echo "<tr style='font-size:12px; font-weight:bold'>
                        <td align='left'>".$row['grade_level']."</td>
                        <td align='left'>".$row['title']."</td>
                        <td align='left'>".$row['publisher']."</td>
                        <td align='right'>".$row['price']."</td>
                        <td align='right'>1</td>
                        <td>".$entry_price."</td>
                      </tr>";
                $total_price = $total_price + $entry_price;
                $book_count = $book_count + 1;
              }
            }
          echo "  </tr>
                  </tbody>
                  </table>
                  <h3>Book Count: $book_count || Total Price: $total_price</h3>"
        ?>
</div>
</body>
</html>
