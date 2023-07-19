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
    <title>Administration</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function () {
      $('#Blog_table thead tr').clone(true).appendTo( '#Blog_table thead' );
      $('#Blog_table thead tr:eq(1) th').each(function () {
      var title = $(this).text();
      $(this).html('<input type="text" placeholder="Search ' + title + '" />');
      });

      var table = $('#Blog_table').DataTable({
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
        <h1><span class="accent-text">School Users</span></h1>
      </div>
    </header>
	<!-- Jquery Data Table -->

    <div class="toggle_columns">
      Toggle column: 
          <a class="toggle-vis" data-column="0">SNo</a>
        - <a class="toggle-vis" data-column="1">School Name</a>
        - <a class="toggle-vis" data-column="2">Type</a>
        - <a class="toggle-vis" data-column="3">Category</a>
        - <a class="toggle-vis" data-column="4">User</a>
        - <a class="toggle-vis" data-column="5">Contact Email</a>
        
        
        
    </div>
    <div style="padding-top: 10px; padding-bottom: 0px; font-size:15px; font-weight:bold; width:90%; margin:auto; overflow:auto">
      <table id="Blog_table" class="display compact">
        <thead>
          <tr>
            <th>SNo </th>
           
            <th>School Name</th>
            <th>Type</th>
            <th>Category</th>
            <th>User</th>
            <th>Contact Email</th>
            
            
          </tr>
        </thead>
        <tbody>
          <!-- Populating table with data from the database-->
          <?php
            require 'db_configuration.php';
            // Create connection
            $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
            // Check connection
            if ($conn->connect_error) 
            {
              die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT schools.name, schools.id,schools.type,schools.category,school_user.Admin_Id,school_user.Contact_Email FROM school_user INNER JOIN schools on schools.id = school_user.School_id;";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) 
            {
              // Create table with data from each row
              $ID=1;
              while($row = $result->fetch_assoc()) 
              {
                  echo "<tr>
                    <td style='width:5%; text-align:left; padding-left:20px'>". $ID."</td>
                    <td style='width:15%; text-align:left; padding-left:20px'>". $row["name"]."</td>
                    <td style='width:15%; text-align:left; padding-left:20px'>". $row["type"]."</td> 
                    <td style='width:15%; text-align:left; padding-left:20px'>". $row["category"]."</td> 
                    <td style='width:15%; text-align:left; padding-left:20px'>". $row["Admin_Id"]."</td> 
                    <td style='width:20%; text-align:left; padding-left:20px'>". $row["Contact_Email"]."</td> 
                 
                    
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
  </body>
</html>
