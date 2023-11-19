<!-- review_suggestions.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review Suggested Schools</title>
    <!-- css stylesheet main.css -->
    <link href="css/main.css" rel="stylesheet">

    <style>
        body{
             margin: auto;
             max-width: 100%;
        }
        table {
            border-collapse: collapse;
            width: 75%;
            margin: 5rem auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            display: inline;
        }
        .container{
            margin-top: 4rem;
        }

        .move{
            margin-left: 1rem;
        }
    </style>
</head>
<body>
    <?php
    // Show errors
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Start session
    session_start();
    include 'show-navbar.php';
    show_navbar();
     ?>
    
      <div class="container">
        <h1 class="accent-text">Suggested Schools</h1>
      </div>
  

    <?php

    // Include database configuration and connect to the database
    require 'db_configuration.php';
    $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Fetch suggested schools
    $sql = "SELECT * FROM schools_suggested";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>
                <th>School Name</th>
                <th>Contact Name</th>
                <th>Contact Mobile</th>
                <th>Commitment Statement</th>
                <th>Action</th>
              </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['school_name'] . "</td>";
            echo "<td>" . $row['contact_name'] . "</td>";
            echo "<td>" . $row['contact_mobile'] . "</td>";
            echo "<td>" . $row['commitment_statement'] . "</td>";

            // Delete button
            echo "<td>";
            echo "<form action='delete_suggestion.php' method='post'>";
            echo "<input type='hidden' name='suggested_school_id' value='" . $row['id'] . "'>";
            echo "<input type='submit' value='Delete'>";
            echo "</form>";


            // Move to schools button

            echo "<form class='move' action='move_to_schools.php' method='post'>";
            echo "<input type='hidden' name='suggested_school_id' value='" . $row['id'] . "'>";
            echo "<input type='submit' value='Move to Schools'>";
            echo "</form>";
            echo "</td>";

            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No suggested schools found.";
    }

    // Close the database connection
    $conn->close();
    ?>

</body>
</html>
