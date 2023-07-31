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
  $Option = $_GET['action'];
  $RECEIPT=$_GET['receipt'];
  $sql = "SELECT tblreceipt.ID,tblreceipt.receiptno,tblreceipt.gradelevel,tblreceipt.title,tblreceipt.publisher,tblreceipt.price,tblreceipt.quantity,tblreceipt.total,receipt.receiptDate FROM tblreceipt INNER JOIN receipt ON receipt.receipt=tblreceipt.receiptno where receipt.receipt='$RECEIPT'";
  
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
    <header class="inverse">
      <div class="container">
        <h2><span class="accent-text">Visual Report</span></h2>
      </div>
    </header>
	<!-- Jquery Data Table -->
  <a href="admin_reports.php" style="margin-left:290px; margin-top:70px; float:left; text-decoration:none; color:blue; box-shadow:0px 0px 3px 2px skyblue; padding:10px">BACK</a>
  
  <a href="#" style="margin-left:530px; margin-top:70px; float:left; text-decoration:none; color:blue; box-shadow:0px 0px 3px 2px lightgrey; padding:10px" onclick="printDiv('report')">Print</a>
    
    <div style="padding-top: 10px; padding-bottom: 30px; width:100%; margin:auto; overflow:auto" id="report">
    <center>
    
    <?php
    $ROWS_LIST = '';
    $TOTAL_A     =0;
    $TOTAL_Q     =0;
    $INVOICE     ='';
    $INVOICE_DATE     ='';
      if ($result->num_rows > 0) 
      {
       // Create table with data from each row
       $SNO=1;
        while($row = $result->fetch_assoc()) 
        {
          // Getting book ID
          $GRADE = $row['gradelevel'];
          $TITLE = $row['title'];
          $PUBLI = $row['publisher'];
          $PRICE = $row['price'];
          $QUERY_BOOKS = "select books.id,books.image FROM books where books.title='$TITLE' and books.publisher='$PUBLI' and books.price='$PRICE' and books.grade_level='$GRADE'";
          $QUERY_BOOKS = $conn->query($QUERY_BOOKS);
          $OUTPUT      = mysqli_fetch_array($QUERY_BOOKS);
          // <td>'.$row['publisher'].'</td>
          // <td>'.$row['gradelevel'].'</td>
          if($Option=='P')
          {
            $ROWS_LIST .=
                        '<tr style="font-weight:bold; font-size:12px">
                          <td>'.$SNO.'</td>
                          <td>'.$OUTPUT['id'].'</td>
                          <td>'.$row['title'].'</td>
                          <td>'.$row['price'].'</td>
                          <td>'.$row['quantity'].'</td>
                          <td>'.$row['total'].'</td>
                      </tr>';
          }
          else if($Option=='W')
          {
            $ROWS_LIST .=
                        '<tr style="font-weight:bold; font-size:12px">
                          <td>'.$SNO.'</td>
                          <td>'.$OUTPUT['id'].'</td>
                          <td>'.$row['title'].'</td>
                          <td>'.$row['quantity'].'</td>
                        </tr>';
          }
         
        $amount = str_replace('₹', '', $row['total']);
        $TOTAL_A +=$amount; 
        $INVOICE_DATE = $row['receiptDate'];
        $TOTAL_Q +=$row['quantity'];
        $SNO++;
        }
      }
    ?>
    
    <br>
    <br>
    <br>
    <br>
    <p style="background-color:skyblue; font-weight:bold; font-size:20px; width:68.9%; padding:10px;">Book Invoice</p>
    <table border=0 style="width:70%" cellpadding=5>
      
      <?php
         if($Option=='P')
         {?>
              <tr style="background-color:skyblue; font-weight:bold; font-size:12px">
              <td>Sno</td>
              <td>ID</td>
              <td>TITLE</td>
              <td>PRICE</td>
              <td>QUANTITY</td>
              <td>TOTAL</td>
              </tr>
          <?php 
              echo $ROWS_LIST; ?>
        <?php
        } 
         else if($Option=='W')
         {?>
          <tr style="background-color:skyblue; font-weight:bold; font-size:12px">
            <td>Sno</td>
            <td>ID</td>
            <td>TITLE</td>
            <td>QUANTITY</td>
          </tr>
                  <?php echo $ROWS_LIST; ?>
         <?php
         }
       ?>
     
    </table>
    <div style="float:right; margin-right:310px; margin-top:100px; font-size:15px; font-weight:bold">
      
      <table style="width:300; border-solid 1px gray; box-shadow:0px 0px 5px 3px lightgray; border-radius:5px;" cellspacing=10 cellpadding=1>
        <tr>
          <td>Invoice Date</td><td>:</td><td><?php echo $INVOICE_DATE;?></td>
       </tr>
       <tr>
          <td>Invoice No</td><td>:</td><td><?php echo 'INV-'.$RECEIPT;?></td>
       </tr>
       <tr>
          <td>Total Qty</td><td>:</td><td><?php echo $TOTAL_Q;?></td>
       </tr>
       <?php
       if($Option=='P')
       {
            echo '<tr>
              <td>Total Amount</td><td>:</td><td>₹'.$TOTAL_A.'</td>
            </tr>';
       }
       else if($Option=='W')
       {
       }
       ?>
      </table>
    </div>
    </center>

    </div>
  </body>
</html>
