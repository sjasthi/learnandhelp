<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>School location</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <style>
        .google-map {
            width: 100%;
            height: calc(100vh - 100px);
        }
    </style>
</head>
<body>
<?php include 'show-navbar.php'; ?>
<?php show_navbar(); ?>
<header class="inverse">
    <div class="container">
        <h1><span class="accent-text">School location</span></h1>
    </div>
</header>
<br>
<div class="google-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m0!3m2!1sen!2sus!4v1649772715403!10m0!3m2!1sen!2sus" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
</body>
</html>
