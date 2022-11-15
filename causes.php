<!DOCTYPE html>
<script>
</script>
<html>
  <head>
    <style>
      #causes {
        margin-left: auto;
        margin-right: auto;
        width: 80%
      }

      th, td {
        border: solid black 1px;
      }
    </style>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Learn and Help</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
  <?php include 'show-navbar.php'; ?>
  <?php include 'cause_fill.php'; ?>
  <header class="inverse">
    <div class="container">
      <h1><span class="accent-text">Causes</span></h1>
    </div>
    <?php show_navbar(); ?>
  </header>

    <?php show_causes(); ?>

  </body>
</html>
