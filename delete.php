
  
    <?php
    $status = session_status();
    if ($status == PHP_SESSION_NONE) {
      session_start();
    }
    
    require 'db_configuration.php';
    // Create connection
    $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $id= $_POST['id'];
    include 'show-navbar.php';
    
    $sql = "DELETE FROM books WHERE Id = " . $id;
    $result = $conn->query($sql);

    $conn->close();
    header("Location: books.php");
    ?>