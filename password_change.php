<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
$subject = 'Password Reset';
$message = 'please click the following link to proceed to the change password: http://localhost/learnandhelp/new_password_entry.php';

if (isset($_POST['submit'])) {

    if (isset($_POST['usermail'])) {
        $emails = $_POST['usermail'];  // reads in the comma delimited list from email field
        $emailArray = explode(';', $emails);   // Converts the list to an array

        $mail = new PHPMailer(true);        //Get new instance of the class for PHMailer()


        // print "Values from email list: <br>";
        for ($i = 0; $i < count($emailArray); $i++) {
            // print "$emailArray[$i]<br>";  //debug line -- Remove when not needed.


            // $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mekics499project24@gmail.com'; // your gmail, substitute with admin email
            $mail->Password = 'fwlphiafqwbzkubj'; // your gmail app pass
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('mekics499project24@gmail.com'); // your gmail

            $mail->addAddress($emailArray[$i]);   // Get email from array segment
            // $mail->addAddress('schoolkolles@gmail.com');   // Get email from array segment

            $mail->isHTML(true);

            // $mail->Subject = $_POST["subject"];
            // $mail->Body = $_POST["message"];
            $mail->Subject = $subject;
            $mail->Body = $message;
            // $mail->Body = $POST["please click the following link to proceed to the questionnaire: http://localhost/learnandhelp/new_password_entry.php"];

            $mail->send();
        }
        // Report sending of all emails is complete.
        echo
        "
        <script>
        alert('Sent Successfully');
        document.location.href = 'password_reset_notification.php'
        </script>
        ";
    } else {  // 
        $emails = array();
    }

    // $emails = $_POST['email'];
    // print "<br>";
    // print_r($emails);
}
