<?php

$status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
             require 'db_configuration.php';
            // Create connection
                      $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

                      // Check connection
                      if ($conn->connect_error)
                      {
                        die("Connection failed: " . $conn->connect_error);
                      }

                      $sql = "SELECT * FROM `schools`;";
                      $result = $conn->query($sql);

                        if ($result->num_rows > 0){
                            // Create table with data from each row
                            while($row = $result->fetch_assoc()){
                                $pin = $row['pin_code'];

                            }
                        }
            $conn->close();
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>School location</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <style>
        .google-map {
            width: 100%;
            height: 100vh;
            position: relative;
            overflow: hidden;
        }
        
        .google-map iframe {
            position: absolute;
            top: -100px; /* Adjust top position to hide the black bars */
            left: 0;
            width: 100%;
            height: calc(100% + 200px); /* Adjust height to include the black bars */
            border: 0;
        }
    </style>
</head>

<body>
    <?php include 'show-navbar.php'; ?>
    <?php show_navbar(); ?>
    <header class="inverse">
        <div class="container">
            <h1><span class="accent-text">School location</span></h1>
        </div>
    </header>
    <br>
    <div class="google-map">
        <iframe src="https://www.google.com/maps/d/u/0/embed?mid=15Z3ti2e87K_gqlgufm7YPgjBNI-g2Pw&ehbc=2E312F" width="100%" height="100%" frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
</body>

</html>