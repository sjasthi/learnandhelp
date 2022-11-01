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
      $(document).ready( function () {
        $('#registration_table').DataTable()
      } );
    </script>
  </head>
  <body>
  <?php include 'show-navbar.php'; ?>
    <header class="inverse">
      <div class="container">
        <h1><span class="accent-text">Administration</span></h1>
      </div>
      <?php show_navbar(); ?>
    </header>
    <!-- Jquery Data Table -->
    <h1 style="margin:auto; padding-top: 30px">Registrations</h1>
    <div style="padding-top: 10px; padding-bottom: 30px; width:90%; margin:auto; overflow:auto">
      <table id="registration_table" class="display compact">
        <thead>
          <tr>
            <th>Reg Id</th>
            <th>Sponsor Name</th>
            <th>Sponsor Email</th>
            <th>Sponsor Phone Number</th>
            <th>Spouse Name</th>
            <th>Spouse Email</th>
            <th>Spouse Phone Number</th>
            <th>Student Name</th>
            <th>Student Email</th>
            <th>Student Phone Number</th>
            <th>Class</th>
            <th>Cause</th>
            <th>Date Modified</th>
            <th>Date Created</th>
            <th>Options</th>
          </tr>
        </thead>
        <tbody>
          <!-- Populating table with data from the database-->
          <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "learn_and_help_db";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM registrations";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              // Create table with data from each row
              while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Reg_Id"]. "</td><td>" . $row["Sponsor_Name"].
                "</td><td>". $row["Sponsor_Email"]. "</td><td>" .
                $row["Sponsor_Phone_Number"]. "</td><td>" . $row["Spouse_Name"].
                "</td><td>" . $row["Spouse_Email"]. "</td><td>" .
                $row["Spouse_Phone_Number"]. "</td><td>" . $row["Student_Name"].
                "</td><td>" . $row["Student_Email"]. "</td><td>" .
                $row["Student_Phone_Number"]. "</td><td>" . $row["Class"].
                "</td><td>" . $row["Cause"]. "</td><td>" .
                $row["Modified_Time"]. "</td><td>" . $row["Created_Time"].
                "</td>
                <td>
                  <form action='admin_edit.php' method='POST'>
                    <input type='text' name='Reg_Id' value='". $row["Reg_Id"] . "' hidden='hidden'>
                    <input type='submit' id='admin_buttons' name='edit' value='Edit'/>
                  </form>
                  <form action='admin_delete.php' method='POST'>
                    <input type='text' name='Reg_Id' value='". $row["Reg_Id"] . "' hidden='hidden'>
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
  </body>
</html>
