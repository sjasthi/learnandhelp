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
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function () {
        var table = $('#causes').DataTable();

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
        <h1><span class="accent-text">Causes</span></h1>
      </div>
    </header>
    <div class="toggle_columns">
      Toggle column: <a class="toggle-vis" data-column="0">Cause</a>
        - <a class="toggle-vis" data-column="1">Description</a>
        - <a class="toggle-vis" data-column="2">Url</a>
        - <a class="toggle-vis" data-column="3">Contact Name</a>
        - <a class="toggle-vis" data-column="4">Contact Email</a>
        - <a class="toggle-vis" data-column="5">Contact Phone</a>
        - <a class="toggle-vis" data-column="6">Submit</a>
        - <a class="toggle-vis" data-column="7">Action</a>
    </div>
    <div style="width: 90%; margin: auto;">
      <table id="causes" class="display compact">
        <thead>
          <tr>
            <th>Cause</th>
            <th>Description</th>
            <th>URL</th>
            <th>Contact Name</th>
            <th>Contact Email</th>
            <th>Contact Phone</th>
            <th>Submit</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
          // Pull Cause data from the databases and create a Jquery Datatable
          require 'db_configuration.php';
          $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
          if ($connection === false) {
            die("Failed to connect to database: " . mysqli_connect_error());
          }
          $sql = "SELECT * FROM causes";
          $result = mysqli_query($connection, $sql);
          if ($result->num_rows > 0) {
            // Create table with data from each row
            while($row = $result->fetch_assoc()) {
              echo    '<form action="update_causes.php" method="post">
                        <input type="hidden" name="rowId" value="'.$row['Cause_Id'].'">
                        <tr>
                          <td>
                            <input type="text" name="name" value="'.$row['Cause_name'].'">
                          </td>
                          <td>
                            <textarea rows="2" cols="20" name="description">'.$row['description'].'</textarea>
                          </td>
                          <td>
                            <input type="text" name="URL" value="'.$row['URL'].'">
                          </td>
                          <td>
                            <input type="text" name="contact_name" value="'.$row['Contact_name'].'">
                          </td>
                          <td>
                            <input type="text" name="contact_email" value="'.$row['Contact_email'].'">
                          </td>
                          <td>
                            <input type="text" name="contact_phone" value="'.$row['Contact_phone'].'">
                          </td>
                          <td>
                            <input type="submit" value="Update">
                          </td>
                          <td>
                            <select name="action" style="width: 100%">
                              <option value="update">Edit</option>
                              <option value="delete">Delete</option>
                          </td>
                      </tr>
                      </form>';
            }
          }
        ?>
      </tbody>
      </div>
      </table>
    <h1>Add New</h1>
    <form action="update_causes.php" method="post" id="add_cause">
      <input type="text" name="name" placeholder="Cause name" required>
      <textarea type="textarea" rows=9 cols=90 name="description" placeholder="Cause Description" required></textarea>
      <input type="text" name="URL" placeholder="URL" required>
      <input type="text" name="contact_name" placeholder="Contact name" required>
      <input type="email" id="contact-email" name="contact_email" class="form" required placeholder="Contact email">
      <input type="tel" id="contact-phone" name="contact_phone" placeholder="123-456-7899" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
      <input type="hidden" name="action" value="add" >
      <input type="submit" value="Add" style="width: 33%">
    </form>
  </body>
</html>
