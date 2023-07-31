<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
  $selected_books = $_POST['selected_books'];
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
        <h1><span class="accent-text">Customer Receipt</span></h1>
      </div>
  </header>
  <div id="receipt">
  <table id="receipt_table">
		<?php
			// Create table with data from each row
  			$counter = 0;
  			$total_books = 0;
			$order_total = 0;

  			foreach($selected_books as $row) {
				$price = floatval($row["Price"]);
				$quantity = floatval($row["Quantity"]);
				$item_total = $price * $quantity;
				$total_books += $quantity;
				$order_total += $item_total;

				$counter++;
				if($counter == 0) {
					echo "<tr>";
				}
				$id = $row["Book ID"];
				// if a profile image was not created use the admin_icons school.png as a default fallback image
				echo  "<td id='book_image'>
					<img src=".$row["Image"]." onerror=\"src='images/books/default.png'\" loading='lazy'><br>
					<span>Title: ".$row["Title"]."<br>Quantity: ".$quantity."<br>Price: ".$price."<br>Total: ".$item_total."</span>
					</td>";
				if($counter % 5 == 0 && $counter > 0) {
					echo "</tr>";
					if($counter < count($selected_books)) {
						echo "<tr>";
					}
				}
			}  ?>
	</table>
	<span>  
		<?php
			$today = date("m/d/Y");
			echo "<h4>Total Count of Books: $total_books &nbsp;&nbsp;&nbsp;&nbsp; "; 
   			echo "<h4> Total Price of Books: $$order_total &nbsp;&nbsp;&nbsp;&nbsp; Date: $today"
		?>
	</span>
</div>
</body>
</html>
