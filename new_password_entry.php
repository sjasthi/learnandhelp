<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
 ?>
 
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>New Password Entry</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <script>
      var check = function() {
        if (document.getElementById('password1').value == document.getElementById('password2').value) {
          document.getElementById('message').style.color = 'green';
          document.getElementById('message').innerHTML = 'Password match';
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Password does not match';
      }
    }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
      function showPassword() {
        var x = document.getElementById("password1");
        var y = document.getElementById("password2");
        if (x.type === "password" || y.type === "password") {
          x.type = "text";
          y.type = "text";
          } else {
              x.type = "password";
              y.type = "password";
      }
    }
</script>
  </head>
  <body>
  <?php include 'show-navbar.php'; ?>
  <?php show_navbar(); ?>
  <header class="inverse">
      <div class="container">
          <h1><span class="accent-text">Reset your password</span></h1>
      </div>
  </header>
  <br>
  <form action="password_change_confirmation.php" method="post"> 
      <input type="password" name="password1" id="password1"  onkeyup='check();' placeholder="New password" style="width:400px" required/>
      <br>
      <input type="password" name="password2" id="password2" onkeyup='check();' placeholder="Repeat new password" style="width:400px" required/> 
      <br>
      <input type="checkbox" onclick="showPassword()">Show Password
      <br>
      <span id='message'></span>
      <br>
      <input type="submit" id="submit" value="Save password"/>
  </form>
  </body>
</html>