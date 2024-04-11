<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Start session if needed
session_start();

// Include show-navbar.php
include 'show-navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Suggest a School</title>
    <!-- main css -->
    <link rel="stylesheet" href="css/main.css" />
    <style>


      .container {
        max-width: 600px;
        margin: 3rem auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      h2 {
        text-align: center;
      }

      .form-group {
        margin-bottom: 15px;
      }

      label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
      }

      input[type="text"],
      input[type="tel"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
      }

      textarea {
        width: 100%;
        height: 100px;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
        box-sizing: border-box;
      }

      input[type="submit"]:hover {
        background-color: #0056b3;
      }
    </style>
  </head>

  <body>
    <?php
      show_navbar();
     ?>
    <div class="container">
      <h2>Suggest a School</h2>
      <form action="process_suggestion.php" method="post">
        <div class="form-group">
          <label for="school_name">School Name *</label>
          <input type="text" id="school_name" name="school_name" required />
        </div>
        <div class="form-group">
          <label for="contact_name"
            >Name of Contact at School (Teacher or Head Master) *</label
          >
          <input type="text" id="contact_name" name="contact_name" required />
        </div>
        <div class="form-group">
          <label for="contact_mobile">Mobile Number of Contact</label>
          <input type="tel" id="contact_mobile" name="contact_mobile" />
        </div>
        <div class="form-group">
          <label for="commitment_statement"
            >Statement of Commitment (Indicate how you want to administer the
            library)</label
          >
          <textarea
            id="commitment_statement"
            name="commitment_statement"
          ></textarea>
        </div>
        <input type="submit" value="Submit" />
      </form>
    </div>
  </body>
</html>
