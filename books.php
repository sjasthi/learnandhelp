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
       $(document).ready(function () {
         $('#books_table thead tr').clone(true).appendTo( '#books_table thead' );
         $('#books_table thead tr:eq(1) th').each(function () {
         var title = $(this).text();
         $(this).html('<input type="text" placeholder="Search ' + title + '" />');
         });

         var table = $('#books_table').DataTable({
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
         <h1><span class="accent-text">Books</span></h1>
       </div>
     </header>
     <!-- Generate books by grade level -->
     <form action="create_booklist_by_grade.php" method="post">
       <h3> Generate Books by grade level </h3>
       <label for="high">High</label>
       <input class="checkboxes" type="checkbox" name="high" value="True" required>
       <label for="high">Middle</label>
       <input class="checkboxes" type="checkbox" name="middle" value="True" required>
       <label for="high">Elementary</label>
       <input class="checkboxes" type="checkbox" name="elementary" value="True" required>
       <br>
       <input type="submit" name="submit">
     </form>
     <!-- Book list -->
     <form id="booklist" action="create_booklist.php" method="post" hidden="hidden">
       <h1>Book list</h1>
       <div id="booklist_labels">
         <div class="list_labels">
           <label>Grade Level</label>
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
     <div class="toggle_columns">
       Toggle column: <a class="toggle-vis" data-column="0">Grade Level</a>
         - <a class="toggle-vis" data-column="1">Image</a>
         - <a class="toggle-vis" data-column="2">Title</a>
         - <a class="toggle-vis" data-column="3">Author</a>
         - <a class="toggle-vis" data-column="4">Publisher</a>
         - <a class="toggle-vis" data-column="5">Year Published</a>
         - <a class="toggle-vis" data-column="6">Page Count</a>
         - <a class="toggle-vis" data-column="7">Price</a>
         - <a class="toggle-vis" data-column="8">Action</a>
         <?php if (isset($_SESSION['role']) AND $_SESSION['role'] == 'admin') { echo '- <a class="toggle-vis" data-column="9">Change Picture</a>'; } ?>
     </div>
     <div style="padding-top: 10px; padding-bottom: 30px; width:90%; margin:auto; overflow:auto">
       <table id="books_table" class="display compact">
         <thead>
           <tr>
             <th>Grade Level</th>
             <th>Image</th>
             <th>Title</th>
             <th>Author</th>
             <th>Publisher</th>
             <th>Year Published</th>
             <th>Page Count</th>
             <th>Price (₹)</th>
             <th>Action</th>
             <?php if (isset($_SESSION['role']) AND $_SESSION['role'] == 'admin') { echo '<th>Change Picture</th>'; } ?>
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

             $sql = "SELECT * FROM book ORDER BY id;";
             $result = $conn->query($sql);

             if ($result->num_rows > 0) {
               // Create table with data from each row
               while($row = $result->fetch_assoc()) {
                 if (isset($_SESSION['role']) AND $_SESSION['role'] == 'admin') {
                   echo "<tr>
                          <td><div contenteditable='true' onBlur='updateValue(this,\"grade_level\",". $row["id"] .")'>" . $row["grade_level"]. "</div></td>
                          <td id='book_image'><img src='" . $row["image"] . "' onerror=\"src='images/books/default.png'\"></td>
                          <td><div contenteditable='true' onBlur='updateValue(this,\"title\",". $row["id"] .")'>" . $row["title"]. "</div></td>
                          <td><div contenteditable='true' onBlur='updateValue(this,\"author\",". $row["id"] .")'>" . $row["author"]. "</div></td>
                          <td><div contenteditable='true' onBlur='updateValue(this,\"publisher\",". $row["id"] .")'>" . $row["publisher"]. "</div></td>
                          <td><div contenteditable='true' onBlur='updateValue(this,\"publishYear\",". $row["id"] .")'>" . $row["publishYear"]. "</div></td>
                          <td><div contenteditable='true' onBlur='updateValue(this,\"numPages\",". $row["id"] .")'>" . $row["numPages"]. "</div></td>
                          <td><div contenteditable='true' onBlur='updateValue(this,\"price\",". $row["id"] .")'>" . $row["price"]. "</div></td>
                          <td><Button onclick='addToList(this)'>Add to List</Button></td>
                          <td style='min-width: 300px;'>
                            <form action='edit_book_picture.php' method='post' enctype='multipart/form-data'>
                              <input type='file' name='file' accept='image/*'>
                              <input type='hidden' name='book_id' value='".$row['id']."'>
                              <input type='submit' value='Change Picture'>
                            </form>
                         </tr>";
                 } else {
                   echo "<tr>
                          <td>" . $row["grade_level"] . "</td>
                          <td id='book_image'><img src='" . $row["image"] . "' onerror=\"src='images/books/default.png'\"></td>
                          <td>" . $row["title"] . "</td>
                          <td>" . $row["author"] . "</td>
                          <td>" . $row["publisher"] . "</td>
                          <td>" . $row["publishYear"] . "</td>
                          <td>" . $row["numPages"] . "</td>
                          <td>" . $row["price"] . "</td>
                          <td><Button onclick='addToList(this)'>Add to List</Button></td>
                         </tr>";
                 }
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
   <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript" charset="utf8"
            src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
   <script>
      function updateValue(element,column,id){
            console.log(element.innerText)
            var value = element.innerText
            $.ajax({
                url:'inline-edit.php',
                type: 'post',
                data:{
                    value: value,
                    column: column,
                    id: id,
                    table: "book",
                    idName: "id"
                },
                success:function(php_result){
    				console.log(php_result);

                }

            })
        }
      $(document).ready(function(){
        var checkboxes = $('.checkboxes');
        checkboxes.change(function(){
            if($('.checkboxes:checked').length>0) {
                checkboxes.removeAttr('required');
            } else {
                checkboxes.attr('required', 'required');
            }
        });
      });
    </script>
 </html>
