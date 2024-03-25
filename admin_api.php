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
      $('#classes_table thead tr').clone(true).appendTo( '#classes_table thead' );
      $('#classes_table thead tr:eq(1) th').each(function () {
      var title = $(this).text();
      $(this).html('<input type="text" placeholder="Search ' + title + '" />');
      });

      var table = $('#classes_table').DataTable({
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
        <h1><span class="accent-text">API Support</span></h1>
      </div>
    </header>
    <h3>API Documentation:</h3>
    <p1>
    To do an API call to get school information, type the following link into the URL
    http://localhost/learnandhelp/api/get_school_info.php?id=(index)
     </p1>
     <br>
     <p2>
     To do an API call to get book information, type the following link into the URL
     http://localhost/learnandhelp/api/get_book_info.php?id=(index)
     </p2>
     <br>
     <h3> Parameters:</h3>
     <p3>
     The parameters of the URL after the equal sign is the index in which users can input to get information
     of a specific book or a specific school at that index.
     </p3>

     <h3>Examples:</h3>
    <p1>Clicking this URL will fetch the school info of #10. You can change the ID in the URL to get the school information of a different school.</p1>
    <a href="http://localhost/learnandhelp/api/get_school_info.php?id=10">http://localhost/learnandhelp/api/get_school_info.php?id=10</a>
    <br>
    <img src="images/api_example1.png" alt="API example 1">
    <br>
    <p1>Clicking this URL will fetch the book info of #1389. You can change the ID in the URL to get the book information of a different book.</p1>
    <a href="http://localhost/learnandhelp/api/get_book_info.php?id=1389">http://localhost/learnandhelp/api/get_book_info.php?id=1389</a>
    <img src="images/books_api.png" alt="API example 2" width= 966;height= 175;>

