<!DOCTYPE html>
<html>
<head>
  <link rel="icon" href="images/icon_logo.png" type="image/icon type">
  <title>Learn and Help</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <style>
    h3{
        text-align: center;
        font-size: 20px;
    }
    .book-card {
      max-width: 200px;
      height: 250px;
      text-align: center;
      cursor: pointer;
      border: 1px solid #ccc;
      padding: 10px;
      margin: 10px;
      border-radius: 5px;
    }

    .book-card img {
      max-width: 100px;
      max-height: 100px;
    }

    .book-grid-container {
      max-width: 100%;
      margin: 0 5rem;
      display: grid;
      /* Auto fill */
      grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      /* justify-content: center; */
    }
  </style>
</head>
<body>
  <?php include 'show-navbar.php'; ?>
  <?php show_navbar(); ?>
  <header class="inverse">
    <div class="container">
      <h1 class="accent-text">Books(Grid)</h1>
    </div>
  </header>

  <div class="book-grid-container">
    <?php
    // Replace this section with code to fetch and display book data in a grid view
    // Use your database connection and query to fetch book data
    require 'db_configuration.php'; // Include your database configuration

    $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
    }

    $sql = "SELECT * FROM books"; // Replace 'books' with your actual table name
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '<div class="book-card" onclick="openBookDetails(' . $row['id'] . ')">';
        echo '<img src="images/books/default.png" alt="' . $row['title'] . '">';
        echo '<h3>' . $row['title'] . '</h3>';
        echo '<p>Author: ' . $row['author'] . '</p>';
        echo '</div>';
      }
    } else {
      echo '<p>No books found.</p>';
    }

    $connection->close();
    ?>
  </div>

  <script>
    // JavaScript function to open book details page
    function openBookDetails(bookId) {
      window.location.href = 'book_details.php?book_id=' + bookId;
    }
  </script>
</body>
</html>
