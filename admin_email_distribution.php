<?php
require 'db_configuration.php';

// Print errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
  <title>Administration email distribution</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#Blog_table thead tr').clone(true).appendTo('#Blog_table thead');
      $('#Blog_table thead tr:eq(1) th').each(function() {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
      });

      var table = $('#Blog_table').DataTable({
        initComplete: function() {
          // Apply the search
          this.api()
            .columns()
            .every(function() {
              var that = this;

              $('input', this.header()).on('keyup change clear', function() {
                if (that.search() !== this.value) {
                  that.search(this.value).draw();
                }
              });
            });
        },
      });

      $('a.toggle-vis').on('click', function(e) {
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
      <h1><span class="accent-text">Users Email List</span></h1>
    </div>
  </header>

  <div style="padding-top: 10px; padding-bottom: 30px; width:90%; margin:auto; overflow:auto">

    <html lang="en" dir="ltr">

    <head>
      <meta charset="utf-8">
      <title>Send Email</title>
    </head>

    <body>
      <table style="margin-left:auto; margin-right:auto">
        <tr>
          <form class="" action="send.php" method="post">
        <tr>
          <td>
            <label>From Admin:</label>
          </td>
          <td>
            <textarea style="height:20px; width:500px" type="email" name="from" value="" required><?php echo $_SESSION["email"]; ?></textarea><br>
          </td>
        </tr>
        <tr>
          <td>
            <label>Email:</label>
          </td>
          <td>
            <textarea style="height:auto; width:500px;" type="text" name="email" placeholder="recipients" value="" required><?php
            // Create Connection to Database
            
            $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT Email FROM users";
            $result = $conn->query($sql);


            if ($result->num_rows > 0) {  //Grab all email address and populate Email field

              $rowCount = $result->num_rows;   //Get total # of Emails found
              $loops = 1;

              // Output data in the email field in form.  Creates email list separated by ';'.
              while ($row = $result->fetch_assoc()) {

                if ($loops == $rowCount) {
                  echo $row["Email"]; // omit comma at end.
                } else {
                  echo $row["Email"] . "; "; // Add ; to list
                }
                $loops += 1;  //increment loop count

              }
            } else {
              echo "0 results";
            }
            $conn->close();

            ?></textarea><br>
          </td>
        </tr>
        <tr>
          <td>
            <label>Subject:</label>
          </td>
          <td>
            <input style="height:20px; width:500px" type="text" name="subject" value="" placeholder='Enter a subject...' required> <br>
          </td>
        </tr>
        <tr>
          <td>
            <label>Message:</label>
          </td>
          <td>
            <textarea type="text" style="height:200px; width:500px" name="message" value="" placeholder='Enter a message...' row='10' required></textarea><br><br>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <button class=btn type="submit" name="send" style="display:block; margin:auto">Send</button><br>
          </td>
        </tr>
        </form>
        </tr>
        <tr>
          <td></td>
          <td>
            <form action="administration.php" method="post">
              <button class=btn type="submit" name="cancel" id="submit" style="display:block; margin:auto">Cancel</button>
          </td>
        </tr>
        </form>
        </tr>
      </table>
    </body>

    </html>
</body>

</html>