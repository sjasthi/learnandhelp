<?php
  $status = session_status();
  if ($status == PHP_SESSION_NONE) {
    session_start();
  }
?>

<!DOCTYPE html>
<html>
  <head>
   <title>Align Content to Left</title>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Learn and Help</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">

    <style>
      .content-container {
       position: absolute;
       text-align: left;
       top: 70%; 
       left: 20px; 
       transform: translateY(-50%); 
       padding: 20px;
       border: 1px solid #ccc;
       border-radius: 5px;
    }



    .top-right-container {
      position: absolute;
      top: 70%;
      right: 0;
      transform: translateY(-50%); 
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
  }
</style>
  
  </head>
  <body>
  <?php include 'show-navbar.php'; ?>
  <?php show_navbar(); ?>

  
  <header class="inverse">
    
      <div class="container">
        <h1> <span class="accent-text">About</span></h1>
      </div>
  </header>
    <section class="about-me">
      <div class="container">
      <div class="input-row">
      <div class="content-container">
  
      
       
                   <a href = "form_send_email.php" >Send Email</a>
                   
             </div>
        <h2><span class="accent-text">Any Questions?</span></h2>
        <p>Please contact <strong>Siva Jasthi</strong></p>
        <a href="mailto: Siva.Jasthi@gmail.com"> Siva.Jasthi@gmail.com</a>
        <p>651.276.4671</p>
        <br>
        <h2>Website Creators</h2>
        <p>Learn and Help 1.0 development team:</p>
        <p><b>Daniel Duea</b>: DanielDuea@gmail.com</p>
        <p><b>Luis Duran-Enriquez</b>: duranluis320@gmail.com</p>
        <p><b>Michael Olson</b>: michaelolson01@gmail.com</p>
        <p><b>William Vicic</b>: william.vicic@gmail.com</p>
        <p><b>Seth Arndt</b>: 17seth.arndt@gmail.com</p>
        <p><b>Robert LaPrise</b>: lapriserobert1@gmail.com</p>

        </section>
    <section class="about-me2">
      <div class="container22">
        <div class="info-box">

          <h2><span class="accent-text">Contact Information </span></h2>
          <p>Contact Email: siva.jasthi@gmail.com</p>
          <p><a href="http://localhost/learnandhelp.php">Learn and Help PDF</a></p>

         
      </div>
    </section>
  </body>
</html>
