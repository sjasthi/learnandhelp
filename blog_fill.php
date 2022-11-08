<?php
  function fill_blog() {
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

    $sql = "SELECT * FROM blogs ORDER BY Created_Time DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // Create Post from data from each row
      while($row = $result->fetch_assoc()) {
        if ($row["Video_Link"] != NULL) {
          $blog_link = '<a class="blog_link" href=' . $row["Video_Link"] . '> Video </a> </div>';
        } else {
          $blog_link = '</div>';
        }
        $picture_sql = "SELECT Location FROM blog_pictures WHERE Blog_Id = " . $row["Blog_Id"];
        $picture_locations = $conn->query($picture_sql);
        $blog_pictures = '';
        if ($picture_locations->num_rows > 0) {
          while($picture = $picture_locations->fetch_assoc()) {
            $blog_pictures = $blog_pictures . '<img class="blog_picture" src="'. $picture['Location'] . '"> <br>';
          }
        }
        $blog_body =
        '
        <div class="blog_post">
          <h2 id="'. $row['Title'] . '">' . $row['Title'] . '</h2>
          <h3> By: ' . $row['Author'] . '</h3>
          <p>' . $row['Created_Time'] . '</p>
          <p>' . nl2br($row['Description']) . '</p> <br>
        ';
        echo $blog_body.$blog_pictures.$blog_link;
      }
    } else {
      echo "0 results";
    }
    $conn->close();
  }

  function fill_TOC() {
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

    $sql = "SELECT Title FROM blogs ORDER BY Created_Time DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // Place title in TOC
      while($row = $result->fetch_assoc()) {

        $TOC_Entry = '<li><a href="#'. $row['Title'] .'">' . $row['Title'] . '</a></li>';
        echo $TOC_Entry;
      }
    } else {
      echo "0 results";
    }
    $conn->close();
  }
  ?>
