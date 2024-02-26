<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';

    if(isset($_POST['send'])){
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mekics499project24@gmail.com'; // your gamil, substitute with admin email
        $mail->Password = 'fwlphiafqwbzkubj'; // your gmail app pass
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('mekics499project24@gmail.com'); // your gmail

        $mail->addAddress($_POST["email"]);

        $mail->isHTML(true);

        $mail->Subject = $_POST["subject"];
        $mail->Body = $_POST["message"];

        $mail->send();

        echo
        "
        <script>
        alert('Sent Successfully');
        document.location.href = 'admin_email_distribution.php'
        </script>
        ";
    }

?>