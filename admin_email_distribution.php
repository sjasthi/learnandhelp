<?php

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
              <form class="" action="send.php" method="post">
              From: <textarea style="height:20px; width:500px" type="email" name="from"><?php

              ?></textarea><br>
              Email: <input style="height:20px; width:500px" type="email" name="email" placeholder="recipients" value=""> <br>
              Subject: <input style="height:20px; width:500px" type="text" name="subject" value="" placeholder='Enter a subject...'> <br>
              <label> Message: </lable>
              <textarea type="text" style="height:200px; width:500px" name="message" value="" placeholder='Enter a message...' row='10'></textarea> <br>
              <button type="submit" name="send">Send</button>
              <button type="reset" value="Reset">Cancel</button> <br>
              <label>Email List:</lable> <br>
              <textarea rows="10" cols="140"> <?php
                // Connect to your database
                                $db_host = "localhost";
                                $db_name = "learn_and_help_db";
                                $db_user = "root";
                                $db_pass = "";

                                $conn = mysqli_connect ($db_host, $db_user, $db_pass, $db_name);
                                if(mysqli_connect_error()){
                                    echo mysqli_connect_error();
                                    exit;
                                }

                                $sql = "SELECT Email FROM users";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // Output data in the email row
                                    while($row = $result->fetch_assoc()) {
                                        echo $row["Email"] . "; ";
                                    }
                                } else {
                                    echo "0 results";
                                }

                                $conn->close();
              ?></textarea>
              </form>
          </body>
      </html>
  </body>
</html>
