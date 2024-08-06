<?php
session_start();

$status = session_status();
if ($status == PHP_SESSION_NONE) {
    session_start();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'determine_paths.php';  //sets path for linked files

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

if (isset($_POST['submit'])) {
    // Gets the message and user's email from the form
    $name = $_POST['user_name'];
    $phone = $_POST['user_phone'];
    $message = $_POST['message'];
    $visitorEmail = $_POST['user_email'];

    // Connect to your database
    // $db_host = "localhost";
    // $db_name = "learn_and_help_db";
    // $db_user = "root";
    // $db_pass = "";

    //Establish connection to database
    $conn = require_once __DIR__ . "/database_connection.php";


    // $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    // if (mysqli_connect_error()) {
    //     echo mysqli_connect_error();
    //     exit;
    // }

    // gets all the admins from the database
    $sql = "SELECT Email FROM users WHERE Role = 'admin'";
    $result = $conn->query($sql);

    $adminEmails = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $adminEmails[] = $row['Email'];
        }
    }

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom($visitorEmail);
        $mail->isHTML(true);
        $mail->setFrom('contact_us_message@learnandhelp.com', 'Learn and Help Contact us message'); // hides the sender
        $mail->Username = 'mekics499project24@gmail.com'; // your gmail, substitute with admin email
        $mail->Password = 'fwlphiafqwbzkubj'; // your gmail app pass

        foreach ($adminEmails as $adminEmail) {
            $mail->addAddress($adminEmail);
        }

        // add the option to automatically send a reply to the sender
        $mail->addReplyTo($visitorEmail);

        $mail->Subject = 'Contact Us Message';
        $mail->Body = $message;

        $mail->send();

        // sends a alert 
        echo "<script>alert('Sent Successfully');document.location.href = 'contact_us.php'</script>";
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Contact Us</title>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">




</head>
<style>
    .search-container {
        text-align: center;
        margin-bottom: 20px;
    }

    .search-input {
        width: 300px;
        padding: 10px;
        font-size: 16px;
    }

    .search-button {
        padding: 10px 20px;
        background-color: #99D930;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    .school-icon {
        text-align: center;
        vertical-align: top;
        padding: 10px;
    }

    .school-icon img {
        max-width: 100px;
        max-height: 100px;
    }

    .school-info p {
        font-size: 14px;
        margin: 0;
        color: #333;
    }

    .dot {
        cursor: pointer;
        height: 10px;
        width: 10px;
        margin: 0 2px;
        background-color: #FFFFFF;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    .active,
    .dot:hover {
        background-color: #717171;
    }

    .slideshow-container {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        overflow: hidden;
    }

    .inverse {
        position: relative;
        background-size: cover;
        height: 300px;
        overflow: hidden;
    }

    .inverse h1 {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 3;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        color: white;
        font-size: 3em;
        text-align: center;
        width: 100%;
    }

    .banner_slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: none;
    }

    .banner_slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .dots-container {
        position: absolute;
        bottom: 20px;
        left: 0;
        right: 0;
        text-align: center;
        z-index: 2;
    }
</style>

<body>
    <?php include 'show-navbar.php'; ?>
    <?php show_navbar(); ?>


    <header class="inverse">
        <div class="slideshow-container">
            <?php
            //Get images from that dir
            $images_dir = "./images/banner_images/Contact/";
            $images = glob($images_dir . "*.{jpg,png}", GLOB_BRACE);
            //Putting the images into a individual slide
            foreach ($images as $index => $image) {
                $safe_image_path = htmlspecialchars($image, ENT_QUOTES, 'UTF-8');
                echo "<div class='banner_slide'>
<img src='{$safe_image_path}' alt='School banner image'>
</div>";
            }
            ?>

            <div class="container">
                <h1> <span class="accent-text">About</span></h1>
            </div>
            <div class="dots-container">
                <?php
                //Creating navigation dots for each image
                foreach ($images as $index => $image) {
                    $slide_number = $index + 1;
                    echo "<span class='dot' onclick='currentSlide($slide_number)'></span>";
                }
                ?>
            </div>
    </header>
    <section class="about-me">
        <div class="container">
            <div class="input-row">
                <div class="content-container">

                </div>

                <div class="Any Question?">
                    <h1 class="left-align"><span class="accent-text" style="font-size:34px;">Any Questions?</span></h1>
                </div>

                <!-- <style>
                </style> -->


                <style>
                    /* CSS Styles */

                    h1.accent-text {
                        font-size: 45px;
                        text-align: left;
                    }


                    .form-container {
                        position: relative;
                        right: 10%;
                        transform: translateX(-50%);
                    }

                    .form-container {
                        position: relative;
                        top: 50%;
                        transform: translateX(-50%);
                    }

                    .form-container {
                        width: 100%;
                        max-width: 650px;
                        margin: 0 auto;
                        padding: 10px;
                        border-radius: 10px;
                        color: #fff;
                        background: #9ACD32;
                    }

                    .input-row {
                        margin-bottom: 10px;
                    }

                    .input-row label {
                        display: block;
                        margin-bottom: 3px;
                    }

                    .input-row input,
                    .input-row textarea {
                        width: 70%;
                        padding: 8px;
                        border-radius: 3px;
                        outline: 0;
                        margin-bottom: 3px;
                        font-size: 15px;
                        font-family: Arial, sans-serif;
                    }

                    .input-row textarea {
                        height: 100px;
                    }

                    .input-row input[type="submit"] {
                        width: 100px;
                        display: block;
                        margin: 0 auto;
                        text-align: center;
                        color: #fff;
                        cursor: pointer;
                        background: #002f3a;
                    }



                    .success {
                        background: #9fd2a1;
                        padding: 5px 10px;
                        text-align: center;
                        color: #326b07;
                        border-radius: 3px;
                        font-size: 14px;
                        margin-top: 10px;
                    }

                    /* Align content to the left */
                    .contact-info {
                        position: relative;
                        left: 300px;
                        top: 0px;
                        transform: translateY(-50%);
                        color: black;
                        background: #fff;
                        padding: 0px
                    }

                    /* Align content to the top */
                    .website-creators {
                        position: absolute;
                        top: -308px;
                        left: 50px;
                        transform: translateY(-50%);
                        color: black;
                        background: #fff;
                        padding: 10px;

                    }

                    .learn-and-help-pdf {
                        position: absolute;
                        bottom: -680px;
                        right: 280px;
                        transform: translateY(-50%);
                    }
                </style>
                <!-- </head> -->

                <!-- <body> -->

                <div class="form-container">

                    <form action="" method="post">

                        <label for="user_name">Your Name:</label><br>
                        <input type="name" id="user_name" name="user_name" placeholder="Your Name" style="width: 300px; height: 50px;" required><br>

                        <label for="user_email">Your Email:</label><br>
                        <input type="email" id="user_email" name="user_email" placeholder="Your email" style="width: 300px; height: 50px;" required><br>

                        <label for="user_phone">Your Phone:</label><br>
                        <input type="phone" id="user_phone" name="user_phone" placeholder="Your phone" style="width: 300px; height: 50px;" required><br>



                        <label for="message">Message:</label><br>
                        <textarea id="message" name="message" rows="5" cols="50" placeholder="Enter your message" required></textarea><br>

                        <div class="button-container" style="padding: 10px;">
                            <input type="submit" value="Submit" name="submit" style="display: inline-block; margin: 20px;">

                            <input type="button" value="Cancel" onclick="window.location.href='index.php'" style="display: inline-block; background-color: #002f3a; color: white; width: 100px;">
                        </div>



                    </form>
                </div>
                <?php if (isset($successMessage)) : ?>
                    <div class="success">
                        <strong><?php echo $successMessage; ?></strong>
                    </div>

                <?php endif; ?>

                <?php if (isset($errorMessage)) : ?>
                    <div class="error">
                        <strong><?php echo $errorMessage; ?></strong>
                    </div>
                <?php endif; ?>
                <!-- </form> -->
                <div class="contact-info">
                    <div>
                        <p>Please contact <strong>Siva Jasthi</strong></p>
                        <a href="mailto:Siva.Jasthi@gmail.com"> Siva.Jasthi@gmail.com</a>
                        <p>651.276.4671</p>
                        <br>
                        <!-- <div class="learn-and-help-pdf"> -->
                        <!-- <p><a href="http://localhost/learnandhelp/learnandhelp.php">Learn and Help PDF</a></p> -->
                        <p><a href="<?php echo $baseUrl ?>learnandhelp.php">Learn and Help PDF</a></p> <!-- Uses the includes determine_paths.php to get url -->
                    </div>
                    <div class="website-creators">
                        <style>
                            /* CSS Styles */
                            h1 {
                                color: yellowgreen;
                            }
                        </style>
                        <h1>Meet The Team</h1>
                        <h2>Website Creators</h2>

                        <p>Learn and Help 3.0 development team:</p>
                        <p><b>Mekdes Gebrechristos</b>: mekigebr21@gmail.com</p>
                        <p><b>Hamdi Kelil</b>: Hamdimuhe3@gmail.com</p>
                        <p><b>Pong Shoua Lee</b>: pongeslee@gmail.com</p>
                        <p><b>Jet Lao</b>: laojet25@gmail.com</p>
                        <p><b>Daniel Kolles</b>: schoolkolles@gmail.com </p>
                    </div>
                    <!-- <div class="info-box">

                            <div class="learn-and-help-pdf">
                                <p><a href="http://localhost/learnandhelp.php">Learn and Help PDF</a></p>
                            </div>


                        </div> -->
                </div>
                <!-- <div class="container22">
                        <div class="info-box">

                            <div class="learn-and-help-pdf">
                                <p><a href="http://localhost/learnandhelp.php">Learn and Help PDF</a></p>
                            </div>


                        </div>
                    </div> -->
                <!-- </div> -->

            </div>
        </div>
    </section>
    <!-- <section class="about-me2">
        <div class="container22">
            <div class="info-box">

                <div class="learn-and-help-pdf">
                    <p><a href="http://localhost/learnandhelp.php">Learn and Help PDF</a></p>
                </div>


            </div>
        </div>
    </section> -->
    <script>
        //Setting slide index and displaying current slide
        let slideIndex = 1;
        showSlides(slideIndex);
        //Moving between slides
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }
        //Displaying slides
        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("banner_slide");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }
    </script>
</body>

</html>