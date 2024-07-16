<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    http_response_code(403);
    die('Forbidden');
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $notes = $_POST['admin_notes'] ?? '';

    $filename = 'admin_notes.txt';

    if (file_put_contents($filename, $notes) !== false){
        header("Location: administration.php?status=success");
        exit;
    } else {
        header("Location: administration.php?status=error");
        exit;
    }
} else {
    header("Location: administration.php");
    exit;
}
?>