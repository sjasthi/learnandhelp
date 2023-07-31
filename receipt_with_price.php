<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
  $selected_books = stripcslashes($_POST['selected_books']);
  $selected_books = json_decode($selected_books, TRUE);
 ?>
<!DOCTYPE html>
<html> 
  <head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Learn and Help</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
     <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
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
        <h1><span class="accent-text">Receipt</span></h1>
      </div>
  </header>
  <div id="receipt">
  <table id="receipt_table">
      <thead>
        <tr style="font-weight:bold; font-size:15px">
		  	<th class='item_number' align='left'>No</th>
		  	<th align='left'>Book ID</th>
        <th align='left'>Title</th>
        <th class='item_quantity' align='right'>Quantity</th>
        <!-- <th align='left'>Publisher</th> -->
        <th class='item_price' align='right'>Price</th>
			  <th class='item_total' align='right'>Total_Price</th>
        </tr>
      </thead>
	  <tbody>
		<?php
		$item_number = 1;
		$total_books = 0;
  		$total_cost = 0;
  		foreach($selected_books as $row) {
			if($row["Quantity"] > 0) {
				echo "<tr><td align='left'>".
					$item_number . "</td><td align='left'> ".
					$row["Book ID"] . "</td><td align='left'> ".
					$row["Title"] ."</td><td align='left'>".
          $row["Quantity"] ."</td><td align='right'>".
					// $row["Publisher"] ."</td><td align='right'>".
          $row["Price"] ."</td><td align='right'>".
					$row["Price"] * $row["Quantity"] ."</td></tr>";
				$total_books = $total_books + $row["Quantity"];
				$total_cost = $total_cost + ($row["Price"] * $row["Quantity"]);
				$item_number += 1;
			}
  		}
    	?>
	  </tbody>
</table>
	<span>  
		<?php
			$today = date("m/d/Y"); 
			echo "<h4>Total Count of Books: $total_books &nbsp;&nbsp;&nbsp;&nbsp;</h4>";
      echo "<h4> Total Price of Books: $$total_cost &nbsp;&nbsp;&nbsp;&nbsp; Date: $today"
		?>
	</span>
</div>
</body>
</html>