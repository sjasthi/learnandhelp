<!DOCTYPE html>
<script>
</script>
<html>
  <head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Learn and Help</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
  </head>
  <body>
  <?php include 'show-navbar.php'; ?>
    <header class="inverse">
      <div class="container">
        <h1><span class="accent-text">Causes</span></h1>
      </div>
      <?php show_navbar(); ?>
    </header>
      <form action="create_post.php" method="POST" enctype="multipart/form-data">
        <div id=blog_creation_left>
          <label>Blog Title</label>
          <br>
          <input type="text" name="title" maxlength=100 required>
          <br>
          <label for="description">Description</label>
          <br>
          <textarea name="description" rows=9 cols=50 required></textarea>
        </div>
        <div id=blog_creation_right>
          <label for="author">Author</label>
          <br>
          <input type="text" name="author" maxlength=50 required>
          <br>
          <label>Image(s)</label>
          <br>
          <input type="file" name="file[]" accept="image/*" multiple="multiple">
          <br>
          <label>Video Link</label>
          <br>
          <input type="text" name="video_link" maxlength=100>
        </div>
        <br>
        <input type="submit" name="create_post" value="Create Post">
      </form>
  </body>
</html>
