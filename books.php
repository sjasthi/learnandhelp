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
     <script type="text/javascript" src="js/book_functions.js"></script>

     <style>
        .view-buttons button {
            display: inline-block;
            position: relative;
            top: 50%;
            transform: translateX(-50%);
            width: 100px; /* Adjust the width as needed */
            margin-right: 300px; /* Adjust the margin as needed */
        }

        
    </style>


     

     
     <script>
       $(document).ready(function () {
         $('#books_table thead tr').clone(true).appendTo( '#books_table thead' );
         $('#books_table thead tr:eq(1) th').each(function () {
         var title = $(this).text();
         $(this).html('<input type="text" placeholder="Search ' + title + '" />');
         });

         $.ajax({
           url: 'books_get_all.php',
           type: "GET",
           async: false,
           success: function (data) {
             var bookList = JSON.parse(data);
             $( "#book_body").append(bookList.data);
             $( "#books_page").removeAttr('hidden');
             $( "#loading").attr("hidden", "true");
           }
         })

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

<!-- Add buttons for grid view and list view -->
<div class="view-buttons">

    <button id="grid-view-btn">Grid View</button>
    
    <button id="list-view-btn">List View</button>
</div>

<style>

#grid-view-btn{
  margin-left: -645px;

}

#list-view-btn {
  margin-left: -255px; 
}




</style>



<script>
    document.getElementById("grid-view-btn").addEventListener("click", function() {
        window.location.href = "books_grid.php"; 
    });

    document.getElementById("list-view-btn").addEventListener("click", function() {
        window.location.href = "books.php";  
    });
</script>

<div id="loading">
      
       <h2> Loading Please Wait </h2>
       <img src="images/loadingIcon.gif"></img>
     </div>
	 <div id="books_page" hidden>
  	 <?php if (isset($_SESSION['role']) and $_SESSION['role'] == 'admin') { ?>
		<form action='book_edit.php' method='post' enctype='multipart/form-data'>
			<input type='hidden' name='book_id' value=''>
			<input type='submit' name='edit_book' value='Add New Book'>
		</form>


</body>
</html>


<?php
if(isset($_POST['redirect'])) {
    // Redirect the user to another page
    header("Location: books_grid2.php");
    exit;
}
?>


     

     <?php } ?>
       <!-- Select books by grade level -->
       <form action="book_create_list_by_grade.php" method="post">
         <h4>Select Books by Grade Level</h4>
         <input class="checkboxes" type="checkbox" name="high_school" value="True" required>High School&nbsp;&nbsp;&nbsp;&nbsp;</input>
         <input class="checkboxes" type="checkbox" name="primary_school_upper" value="True" required>Primary School Upper&nbsp;&nbsp;&nbsp;&nbsp;</input>
         <input class="checkboxes" type="checkbox" name="primary_school" value="True" required>Primary School&nbsp;&nbsp;&nbsp;&nbsp;</input>
         <br>
         <input type="submit" name="submit" value="Get Selections">
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
			<?php if (isset($_SESSION['role']) AND $_SESSION['role'] == 'admin') { ?> 
           - <a class="toggle-vis" data-column="7">Price</a>
		   - <a class="toggle-vis" data-column="8">Available</a>
			
           <?php } else { ?>
                
		   - <a class="toggle-vis" data-column="7">Available</a>
			
           <?php } ?>
           

			<?php if (isset($_SESSION['role']) AND $_SESSION['role'] == 'admin') { ?> 
           - <a class="toggle-vis" data-column="9">Edit</a>
			<?php } ?>
            
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
			<?php if (isset($_SESSION['role']) AND $_SESSION['role'] == 'admin') { ?> 
               <th>Price</th>
			<?php } ?>
            
               <th>Available</th>
			<?php if (isset($_SESSION['role']) AND $_SESSION['role'] == 'admin') { ?> 
               <th>Edit</th>
			<?php } ?>
            
             </tr>
           </thead>
           <tbody id="book_body">
             <!-- Populating table with data from the database-->
           </tbody>
         </table>
       </div>
     </div>
   
   <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript" charset="utf8"
            src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
   
   
            <script>
    $(document).ready(function () {
        // Show grid view by default
        $('#books_table').addClass('grid-view');

        // Function to switch to grid view
        $('#grid-view-btn').click(function () {
            $('#books_table').removeClass('list-view').addClass('grid-view');
        });

        // Function to switch to list view
        $('#list-view-btn').click(function () {
            $('#books_table').removeClass('grid-view').addClass('list-view');
        });
    });
</script>
   
   
   
   
   <script>
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


    
</body>
 </html>
