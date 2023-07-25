<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
?>

  <script type="text/javascript">
  	// select the contenct of the table cell for book quantity when the cell gets focus 
  	function select_all(el) {
        var body = document.body, range, sel;
        if (document.createRange && window.getSelection) {
            range = document.createRange();
            sel = window.getSelection();
            sel.removeAllRanges();
            try {
                range.selectNodeContents(el);
                sel.addRange(range);
            } catch (e) {
                range.selectNode(el);
                sel.addRange(range);
            }
        } else if (body.createTextRange) {
            range = body.createTextRange();
            range.moveToElementText(el);
            range.select();
		}
	}

    // convert the table into a JSON object that can be passed to the receipt page
	function get_table_rows() {
        var table = document.getElementById("selection_table");
        var header = [];
        var rows = [];
 
        for (var i = 0; i < table.rows[0].cells.length; i++) {
            header.push(table.rows[0].cells[i].innerHTML);
        }
 
        for (var i = 1; i < table.rows.length; i++) {
            var row = {};
            for (var j = 0; j < table.rows[i].cells.length; j++) {
                row[header[j]] = table.rows[i].cells[j].innerHTML;
            }
            rows.push(row);
		}
		// set the value of our hidden input field in the form to the JSON data
		document.getElementById("selected_books").value = JSON.stringify(rows); 
    }  
</script>	  

<!DOCTYPE html>
<html>
  <head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Learn and Help</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
     <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  </head>
  <body>
  <?php include 'show-navbar.php'; ?>

  <?php show_navbar(); ?>
  <header class="inverse">
      <div class="container">
        <h1><span class="accent-text">Selection List</span></h1>
      </div>
  </header>
  <div id="selection">
  <h3><span class="accent-text">Finalize Selections</span></h3>
  <table id="selection_table">
      <thead>
        <tr style="font-weight:bold; font-size:15px">
          <th class='item_id' align='left'>Book ID</th>
          <th align='left'>Grade Level</th>
          <th align='left'>Title</th>
          <th align='left'>Publisher</th>
          <th class='item_price' align='right'>Price</th>
		  <th class='item_quantity' align='right'>Quantity</th>
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
            $sql .= '"%high school%"';
            if (isset($_POST['primary_school_upper'])) {
              $sql .= ' OR LOWER(grade_level) LIKE "%primary school upper%"';
            }
            if (isset($_POST['primary_school_lower'])) {
              $sql .= ' OR LOWER(grade_level) LIKE "%primary school lower%"';
            }
          } elseif (isset($_POST['primary_school_upper'])) {
            $sql .= '"%primary school upper%"';
            if (isset($_POST['primary_school_lower'])) {
              $sql .= ' OR LOWER(grade_level) LIKE "%primary school lower%"';
            }
          } elseif (isset($_POST['primary_school_lower'])) {
            $sql .= '"%primary school lower%"';
          }
          $sql .= ") AND available = 1";
          //echo $sql;
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            // Create table with data from each row
            while($row = $result->fetch_assoc()) {
				// the quantity column in the table is editable it is not an input field, parsing innerHTML to get
				// the table data when creating the JSON data does not work if there is an INPUT type of element
				// in the table
                echo "<tr style='font-size:12px; font-weight:bold'>
                        <td align='left'>".$row['id']."</td>
                        <td align='left'>".$row['grade_level']."</td>
                        <td align='left'>".$row['title']."</td>
                        <td align='left'>".$row['publisher']."</td>
						<td align='right'>".$row['price']."</td>
						<td align='right' contentEditable='true' tabindex='0' onfocusin='select_all(this);'>1</td>
						</tr>";
			}
		  }
       ?>
       </tbody>
	   <form action="book_create_billing_receipt.php" method="post" onsubmit="get_table_rows();">
            <input type="hidden" id="selected_books" name="selected_books" value=""> <!-- value is set by the javascript -->
			<input type="submit" name="create_book_billing_receipt" value="Create Receipt">
       </form>
</div>
</body>
</html>
