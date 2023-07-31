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
    <title>Administration</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <style>
      td{
        padding: 4%;
      }
    </style>

  </head>
  <body>
  <?php include 'show-navbar.php'; ?>
  <?php show_navbar(); ?>
    <header class="inverse">
      <div class="container">
        <h1><span class="accent-text">School List</span></h1>
      </div>
    </header>

    <div style="padding-top: 10px; padding-bottom: 30px; width:90%; margin:auto; overflow:auto">
      <table id="schools_table" class="display compact">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Type</th>
            <th>Category</th>
            <th>Email</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- Populating table with data from the database-->
          <?php
          //href='admin_list.php?id=".$row['SerialNo']."'
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
                <td>" . $row["id"]. "</td><td>
                <a href='schools.php?id=".$row['id']."'>
                </br>" . $row["name"]. "</td>
                <td>" . $row["type"]. "</td>
                <td>" . $row["category"]. "</td>
                <td>" . $row["contact_email"]. "</td>
                <td>
                <form action='fill_blog_admin.php' method='POST'>
                    <input type='hidden' name='id' value='". $row["id"] . "'>
                    <input type='submit' id='admin_buttons' name='submit' value='Assign blog admin'/>
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
