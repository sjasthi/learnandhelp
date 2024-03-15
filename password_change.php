<?php
require 'db_configuration.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$subject = 'Password Reset';
$message = 'please click the following link to proceed to the change password: http://localhost/learnandhelp/new_password_entry.php';

// Connect to your database
$connection = mysqli_connect(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

// Check if the connection is established
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    if (isset($_POST['usermail'])) {
        $emails = $_POST['usermail'];  // reads in the comma delimited list from email field
        $emailArray = explode(';', $emails);   // Converts the list to an array

        $mail = new PHPMailer(true);        //Get new instance of the class for PHMailer()
        
        // Retrieve the user's email from the form
        $email = $_POST['usermail'];
        
        // Check if the email exists in the database
        $selectQuery = "SELECT * FROM users WHERE Email = '$email'";
        $result = mysqli_query($connection, $selectQuery);

        if (!$result) {
            // If there was an error in the query, display the error message
            echo "Error checking email: " . mysqli_error($connection);
        } else {
            // Check if the email exists
            if (mysqli_num_rows($result) == 0) {
                // If the email does not exist in the database, inform the user
                echo"<script> alert('Email not found please try again');document.location.href = 'forgot_password.php'</script>";
            }
        }

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


            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->send();
        }
        
        // Close the database connection
        mysqli_close($connection);
        echo"<script> alert('email sent');document.location.href = 'password_reset_notification.php'</script>";
    } else {  
        $emails = array();
    }
}
?>
