<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if(isset($_POST["send"])){
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'pongeslee@gmail.com';                 //gmail account
    $mail->Password = 'ufwdtrhbaxmgzmam';                 //password
    $mail->SMTPSecure = 'ssl';
    $mail-> Port= 465;

    $mail->setFrom('pongeslee@gmail.com');                    // sender gmail account from the admin

    $mail->addAddress($_POST["email"]);   //recepient email address (user email address)
    $mail->isHTML(true);

    $mail->Subject = $_POST["subject"];
    $mail->Body = $_POST["message"];

    $mail->send();

    echo 
    "
    <script>
    alert('sent Successfully');
    document.location.href = 'email_index.php';
    </script>
    ";
}
?>