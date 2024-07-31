<?php
require 'paypal_config.php';
require 'paypal_functions.php';

session_start();

if (!isset($_SESSION['User_Id'])) {
    header('Location: login.php');
    exit;
}
print $_POST['course_fee'];
$course_fee = isset($_POST['course_fee']) ? $_POST['course_fee'] : '10.00'; // Default to 10.00 if not set
$reg_id = $_POST['reg_id'];
print $course_fee;
$description = 'Course Fee';
$returnUrl = 'http://localhost/learnandhelp/execute_course_payment.php?success=true&reg_id=' .  urlencode($reg_id);
$cancelUrl = 'http://localhost/learnandhelp/execute_course_payment.php?success=false&reg_id=' .  urlencode($reg_id);

$approvalUrl = createPayPalPayment($course_fee, 'USD', $description, $returnUrl, $cancelUrl);

if (strpos($approvalUrl, 'Error:') === false) {
    header("Location: {$approvalUrl}");
    exit;
} else {
    echo $approvalUrl; // Display the error message
}
?>
