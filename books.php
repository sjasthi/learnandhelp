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
     <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
     <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
     <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
     <script type="text/javascript" src="js/book_functions.js"></script>
     <script>
       $(document).ready( function () {
         $('#books_table').DataTable()
       } );
     </script>
   </head>
   <body>
   <?php include 'show-navbar.php'; ?>
   <?php show_navbar(); ?>
     <header class="inverse">
       <div class="container">
         <h1><span class="accent-text">Books</span></h1>
       </div>
     </header>
     <!-- Book list -->
     <form id="booklist" action="create_booklist.php" method="post" hidden="hidden">
       <h1>Book list</h1>
       <div id="booklist_labels">
         <div class="list_labels">
           <label>Id</label>
         </div>
         <div class="list_labels">
           <label>Title</label>
         </div>
         <div class="list_labels">
           <label>Publisher</label>
         </div>
         <div class="list_labels">
            <label>Price</label>
         </div>
         <div class="list_labels">
           <label>Quantity</label>
         </div>
       </div>
       <div id="booklist_entries">
       </div>
       <input type="hidden" id="entry_count" name="entry_count" value="0">
       <input id="booklist_submit" type="submit" name="submit" value= "Generate Receipt">
     </form>
     <!-- Jquery Data Table -->
     <div style="padding-top: 10px; padding-bottom: 30px; width:90%; margin:auto; overflow:auto">
       <table id="books_table" class="display compact">
         <thead>
           <tr>
             <th>ID</th>
             <th>Image</th>
             <th>Title</th>
             <th>Author</th>
             <th>Publisher</th>
             <th>Year Published</th>
             <th>Page Count</th>
             <th>Price</th>
             <th>Action</th>
           </tr>
         </thead>
         <tbody>
           <!-- Populating table with data from the database-->
           <?php
             require 'db_configuration.php';
             // Create connection
             $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
             // Check connection
             if ($conn->connect_error) {
               die("Connection failed: " . $conn->connect_error);
             }

             $sql = "SELECT * FROM book";
             $result = $conn->query($sql);

             if ($result->num_rows > 0) {
               // Create table with data from each row
               while($row = $result->fetch_assoc()) {
                 echo "<tr><td>" . $row["id"]. "</td><td id='book_image'><img src='" . $row["image"] . "' onerror=\"src='images/books/default.png'\">
                 </td><td>". $row["title"]. "</td><td>" .
                 $row["author"]. "</td><td>" . $row["publisher"].
                 "</td><td>" . $row["publishYear"]. "</td><td>" .
                 $row["numPages"]. "</td><td>₹" . $row["price"]."</td>
                 <td>
                     <Button onclick='addToList(this)'>Add to List</Button>
                 </td></tr>";
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
