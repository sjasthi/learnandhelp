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
  require 'db_configuration.php';
  // Create connection
  $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  //$sql = "SELECT tblreceipt.ID,tblreceipt.receiptno,tblreceipt.gradelevel,tblreceipt.title,tblreceipt.publisher,tblreceipt.price,tblreceipt.quantity,tblreceipt.total,receipt.receiptDate FROM tblreceipt INNER JOIN receipt ON receipt.receipt=tblreceipt.receiptno";
  $sql="SELECT DISTINCT tblreceipt.receiptno as 'Receipt', sum(tblreceipt.price*tblreceipt.quantity) as 'Total',receipt.receiptDate FROM tblreceipt INNER JOIN receipt ON receipt.receipt=tblreceipt.receiptno GROUP by receipt.receiptDate;";
  $result = $conn->query($sql);
 ?>

<!DOCTYPE html>
<script>
</script>
<html>
  <head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Administration</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
  <?php include 'show-navbar.php'; ?>
  <?php show_navbar(); ?>
    <header class="inverse">
      <div class="container">
        <h2><span class="accent-text">Visual Report</span></h2>
      </div>
    </header>
	<!-- Jquery Data Table -->
    <div style="padding-top: 10px; padding-bottom: 30px; width:100%; margin:auto; overflow:auto">
    <center>
    <table border=1 style="width:70%" cellpadding=5>
      <tr style="background-color:skyblue; font-weight:bold">
      <!-- <td>Sno</td>
      <td>ID</td>
      <td>Receipt No</td>
      <td>Grade Level</td>
      <td>Title</td>
      <td>Publisher</td>
      <td>Price</td>
      <td>Quantity</td>
      <td>Total</td>
      <td>Receipt Date</td>
      <td>Reports</td> -->
      <td style="width:10%">Sno</td>
      <td style="width:10%">Receipt No</td>
      <td style="width:10%">Total</td>
      <td style="width:20%">Receipt Date</td>
      <td style="width:70%">Reports</td>
    </tr>
   
    <?php
    
      if ($result->num_rows > 0) 
      {
       // Create table with data from each row
       $counter=1;
        while($row = $result->fetch_assoc()) 
        {
          echo 
          '<tr>
          <td>'.$counter.'</td>
          <td>'.$row['Receipt'].'</td>
          <td>'.$row['Total'].'</td>
          <td>'.$row['receiptDate'].'</td>
          <td>
          <a href="visualreports.php?action=P&receipt='.$row['Receipt'].'">Invoice with Price</a> | 
          <a href="visualreports.php?action=W&receipt='.$row['Receipt'].'">Invoice without Price</a>
          </td>
        </tr>';
        $counter++;
        }
      }
    ?>
      </table>
    </center>

    </div>
  </body>
</html>
