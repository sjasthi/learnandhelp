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
<script>
</script>
<html>
  <head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Admin Schools</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function () {
      $('#schools_table thead tr').clone(true).appendTo( '#schools_table thead' );
      $('#schools_table thead tr:eq(1) th').each(function () {
		  var title = $(this).text();
      $(this).html('<input type="text" placeholder="Search ' + title + '" />');
      });

      var table = $('#schools_table').DataTable({
         initComplete: function () {
             // Apply the search
             this.api()
                 .columns()
                 .every(function () {
                     var that = this;

                     $('input', this.header()).on('keyup change clear', function () {
                         if (that.search() !== this.value) {
                             that.search(this.value).draw();
                         }
                     });
                 });
             },
         });

      $('a.toggle-vis').on('click', function (e) {
      e.preventDefault();

      // Get the column API object
      var column = table.column($(this).attr('data-column'));

      // Toggle the visibility
      column.visible(!column.visible());
      });
     });
    </script>
  </head>
  <body>
  <?php include 'show-navbar.php'; ?>
  <?php show_navbar(); ?>
    <header class="inverse">
      <div class="container">
        <h1><span class="accent-text">Schools</span></h1>
      </div>
    </header>
    <!-- Jquery Data Table -->
    <div class="toggle_columns">
      Toggle column: <a class="toggle-vis" data-column="0">Id</a>
        - <a class="toggle-vis" data-column="1">Name</a>
        - <a class="toggle-vis" data-column="2">Type</a>
        - <a class="toggle-vis" data-column="3">Category</a>
        - <a class="toggle-vis" data-column="4">Grade Level Start</a>
        - <a class="toggle-vis" data-column="5">Grade Level End</a>
        - <a class="toggle-vis" data-column="6">Current Enrollment</a>
        - <a class="toggle-vis" data-column="7">Address Text</a>
        - <a class="toggle-vis" data-column="8">State Name</a>
        - <a class="toggle-vis" data-column="9">State Code</a>
        - <a class="toggle-vis" data-column="10">Pin Code</a>
        - <a class="toggle-vis" data-column="11">Contact Name</a>
        - <a class="toggle-vis" data-column="12">Contact Designation</a>
        - <a class="toggle-vis" data-column="13">Contact Phone</a>
        - <a class="toggle-vis" data-column="14">Contact Email</a>
        - <a class="toggle-vis" data-column="15">Status</a>
        - <a class="toggle-vis" data-column="16">Notes</a>
		- <a class="toggle-vis" data-column="17">Options</a>
    </div>
    <div style="padding-top: 10px; padding-bottom: 30px; width:95%; margin:auto; overflow:auto">
      <table id="schools_table" class="display compact">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Type</th>
            <th>Category</th>
            <th>Grade Level Start</th>
            <th>Grade Level End</th>
            <th>Current Enrollment</th>
            <th>Address Text</th>
            <th>State Name</th>
            <th>State Code</th>
            <th>Pin Code</th>
            <th>Contact Name</th>
            <th>Contact Designation</th>
            <th>Contact Phone</th>
            <th>Contact Email</th>
            <th>Status</th>
            <th>Notes</th>
            <th>Options</th>
          </tr>
        </thead>
        <tbody>
		<!-- Populating table with data from the database-->
        <?php
            require 'db_configuration.php';
            // Create connection
            $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM schools";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              // Create table with data from each row
              while($row = $result->fetch_assoc()) {
				  echo "<tr>
					  	<td>". $row["id"]. "</td>
						<td>" . $row["name"]. "</td>
						<td>". $row["type"]. "</td>
						<td>". $row["category"]. "</td>
						<td>". $row["grade_level_start"]. "</td>
                    	<td>". $row["grade_level_end"]. "</td>
                    	<td>". $row["current_enrollment"]. "</td>
                    	<td>". $row["address_text"]. "</td>
                    	<td>". $row["state_name"]. "</td>
                    	<td>". $row["state_code"]. "</td>
                    	<td>". $row["pin_code"]. "</td>
                    	<td>". $row["contact_name"]. "</td>
                    	<td>". $row["contact_designation"]. "</td>
                    	<td>". $row["contact_phone"]. "</td>
                    	<td>". $row["contact_email"]. "</td>
                    	<td>". $row["status"]. "</td>
                    	<td>". $row["notes"]. "</td>
                		<td>
                  			<form action='admin_edit_school.php' method='POST'>
                    			<input type='hidden' name='id' value='". $row["id"] . "'>
                    			<input type='submit' id='admin_buttons' name='edit' value='Edit'/>
                  			</form>
                  			<form action='admin_delete_school.php' method='POST'>
                    			<input type='hidden' name='id' value='". $row["id"] . "'>
                    			<input type='submit' id='admin_buttons' name='delete' value='Delete'/>
                  			</form>
                		</td>
                	</tr>";
              }
            } else {
              echo "0 results";
            }
            $conn->close();
            ?>
        </tbody>
      </table>
	</div>
	<h3>Add New School</h3>
    <form action="admin_edit_school.php" method="POST" id="add_school">
		<input type="hidden" name="id" value="">
		<input type="hidden" name="action" value="Add_School">
       	<input type="submit" value="Add School" style="width: 15%">
    </form>
  </body>
</html>
