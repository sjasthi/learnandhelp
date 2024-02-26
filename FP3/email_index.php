<!DOCTYPE html>
<html lang="en">
<?php
$local = true;
$path = $_SERVER["DOCUMENT_ROOT"] . "/ICS_Classes/ICS499 Project/Labs/FP3/email_index/";
// $path = "http://" . $_SERVER['HTTP_HOST'] . "/ICS_Classes/ICS499/Labs/FP3/fetch_n_display/";
if ($local == false) {
}
?>

<head>
 <meta charset="UTF-8" />
<title>Send Email</title>
</head>
<body>
    <form class="" action="send.php" method="post">
        Email <input type="email" name="email" value=""><br> <br>
        Subject <input type= "text" name = "subject" value=""> <br> <br>
        Message <input type= "text" name = "message" value=""> <br> <br>
        <button type= "Submit" name= "Send">Send</button>

</form>
</body>
</html>
        