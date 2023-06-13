<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
?>

<!DOCTYPE html>
<script>
</script>
<html>
  <head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Learn and Help</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready(function () {
        $('#causes thead tr').clone(true).appendTo( '#causes thead' );
        $('#causes thead tr:eq(1) th').each(function () {
        var title = $(this).text();
        $(this).html('<input type="text" placeholder="Search ' + title + '" />');
        });

        var table = $('#causes').DataTable({
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
    <div style="padding-top: 10px; padding-bottom: 30px; width:90%; margin:auto; overflow:auto">
      <table id="causes" class="display compact">

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
              echo '<div class="photo-grid">';
              while($row = $result->fetch_assoc()) {
                echo '<div class="photo">';
                echo '<a href="#" onclick="openNewTab(\'ID: ' . $row["id"] . ' , NAME: '. $row["name"]. ' , TYPE: '  .$row["type"]. ' , CATEGORY: '.$row["category"]. ' , GRADE LEVEL START: '.$row["grade_level_start"]. 
                ' , GRADE LEVEL END: '.$row["grade_level_end"]. ' , CURRENT ENROLLMENT: '. $row["current_enrollment"] . ' , ADDRESS TEXT: '.$row["address_text"]. ' , STATE NAME:' .$row["state_name"]. ' , STATE CODE:' 
                . $row["state_code"]. ' , PIN CODE: ' .$row["pin_code"]. ' , CONTACT NAME: ' . $row["contact_name"]. ' , CONTACT DESIGNATION: ' . $row["contact_designation"]. ' , CONTACT PHONE: ' . $row["contact_phone"]. 
                ' , CONTACT EMAIL: ' . $row["contact_email"]. ' , STATUS: ' . $row["status"]. ' , NOTES: ' . $row["notes"].'\'); return false;">';
                echo '<div class="photo">';
                echo '<img src="images/school_default.png" alt="Photo">';
                echo '</a>';
                echo '<a href="#" onclick="openNewTab(\'ID: ' . $row["id"] . ' , NAME: '. $row["name"]. ' , TYPE: '  .$row["type"]. ' , CATEGORY: '.$row["category"]. ' , GRADE LEVEL START: '.$row["grade_level_start"]. 
                ' , GRADE LEVEL END: '.$row["grade_level_end"]. ' , CURRENT ENROLLMENT: '. $row["current_enrollment"] . ' , ADDRESS TEXT: '.$row["address_text"]. ' , STATE NAME:' .$row["state_name"]. ' , STATE CODE:' 
                . $row["state_code"]. ' , PIN CODE: ' .$row["pin_code"]. ' , CONTACT NAME: ' . $row["contact_name"]. ' , CONTACT DESIGNATION: ' . $row["contact_designation"]. ' , CONTACT PHONE: ' . $row["contact_phone"]. 
                ' , CONTACT EMAIL: ' . $row["contact_email"]. ' , STATUS: ' . $row["status"]. ' , NOTES: ' . $row["notes"].'\'); return false;">';
                echo '<div class="description">' . $row["id"] . '</div>';
                echo '</a>';
                echo '</div>';
                echo '</div>';

                }
                echo '</div>';
                echo '<script>';
                echo 'function openNewTab(info1) {';
                  echo '    var newTab = window.open("", "_blank");';
                  echo '    var content = "<html><head><title>School Information</title></head><body><h1>School Information</h1><p>" + info1 + "</p></body></html>";';
                  echo '    newTab.document.write(content);';
                  echo '}';
                echo '</script>';
            } else {
              echo "0 results";
            }
            $columns = 3;
            $conn->close();
              echo '<style>';
              echo '.grid-container { display: flex; justify-content: center; }';
              echo '.photo {  width: 150;  height: 150;}';
              echo '.photo-grid { display: grid; grid-template-columns: repeat(' .$columns. ', 1fr); grid-gap: 10px; }';
              echo '.photo { width: 100%; max-width: 600px; }'; 
              echo '.photo img { width: 100%; height: auto; }'; 
              echo '.description { margin-top: 5px; }';
              echo '</style>';
            ?>
      </table>
    </div>
  </body>
</html>
