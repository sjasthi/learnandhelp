
  
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
    $id = $_GET['id'];
   
   
    include 'show-navbar.php';
    
   
    echo "<!DOCTYPE html>
    <html>
      <head>
        <link rel=\"icon\" href=\"images/icon_logo.png\" type=\"image/icon type\">
        <title>Learn and Help</title>
        <link href=\"https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap\" rel=\"stylesheet\">
        <link href=\"css/main.css\" rel=\"stylesheet\">
        <style>
            dialog{
                border: 1px solid rgb(100, 220, 220);
                width: 60%;
            }

            /* Optional: change the modal backdrop */
            dialog::backdrop {
                background-color: hsla(260, 3%, 77%, 0.25);
            }
            .container{
                padding-top: 2%;
            }
            .form-control, .btn{
                border-radius: 0px;
            }
            :root *:focus, button.focus {
                outline-offset:0;
                outline:1px solid #000;
            }
          </style>
      </head>
      <body onload='display()'>";
        show_navbar();
      echo  "<header class=\"inverse\">
              <div class=\"container\">
                  <h1><span class=\"accent-text\">Confirm Delete</span></h1>
              </div>
              </header>
          <h3> Delete book</h3>
        <div id=\"container_2\">
        <dialog class='modal'>
        <form action='delete.php' method='post'>
            <div style='padding-top: 2%'>Are you sure you want to delete this book?<br> Book Id: $id </div>
            <div class='input-group'>
                <input hidden='true' type='text' name='id' value=\"$id\" >
                <button type='button' onclick='noDelete()' class='btn btn-primary btn_no'>  No  </button>&nbsp;
                <button type='submit' name='submit' onclick='yesDelete()' class='btn btn-danger btn_delete'>  Yes  </button>
            </div>
        </form>
      </dialog>
        </div>
        <script>
        modal=document.querySelector('.modal');
          function display(){
          modal.showModal();
          }

          function noDelete(){
            location.href='/learnandhelp/books.php';
          }

          var resp=document.querySelector('.resp');
          var btn=document.querySelector('.btn_no');
          var btn_delete=document.querySelector('.btn_delete');
          function yesDelete(){
            location.href='/learnandhelp/delete.php';
          }
        </script>
        </body>
        </html>";

    $conn->close();
    ?>