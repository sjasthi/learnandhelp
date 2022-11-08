<script>
</script>
<html lang="en-us">
  <head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Administration</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
    <?php include 'show-navbar.php'; ?>
    <?php show_navbar(); ?>
    <header class="inverse">
      <div class="container">
        <h1><span class="accent-text">Administration</span></h1>
      </div>
    </header>
    <div id="admin_icons" style="width: 60%; margin: auto;">
      <div class="admin_icon">
        <a href="admin_registrations.php" name="registraions"><img src="images/admin_icons/registrations_icon.png"></a>
        <br>
        <label for="registrations">Registrations</label>
      </div>
      <div class="admin_icon">
        <a href="#" name="users"><img src="images/admin_icons/users_icon.png"></a>
        <br>
        <label for="users">Users</label>
      </div>
      <div class="admin_icon">
        <a href="#" name="causes"><img src="images/admin_icons/causes_icon.png"></a>
        <br>
        <label for="causes">Causes</label>
      </div>
      <br>
      <div class="admin_icon">
        <a href="#" name="blogs"><img src="images/admin_icons/blogs_icon.png"></a>
        <br>
        <label for="blogs">Blogs</label>
      </div>
      <div class="admin_icon">
        <a href="#" name="reports"><img src="images/admin_icons/reports_icon.png"></a>
        <br>
        <label for="reports">Reports</label>
      </div>
    </div>
    <br>
    <div id="icon_attribution">
      <a href="https://www.flaticon.com/authors/freepik" title="freepik icons" id="icon_attribution">Icons created by Freepik - Flaticon</a>
    </div>
  </body>
</html>
