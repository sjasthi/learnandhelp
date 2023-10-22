<?php

// print error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Define the database connection parameters
$hostname = 'localhost'; 
$username = 'root'; 
$password = ''; 
$database = 'learn_and_help_db';

// Check if the 'id' parameter is provided in the request
if (isset($_GET['id'])) {
    // Get the school ID from the request
    $schoolId = $_GET['id'];

// Create a new MySQLi object for the database connection
$connection = new mysqli($hostname, $username, $password, $database);

    // Check for a successful database connection
    if ($connection->connect_error) {
        die("Failed to connect to the database: " . $connection->connect_error);
    }

    // Prepare an SQL statement to retrieve school information by ID
    $sql = "SELECT * FROM schools WHERE id = ?";

    // Use prepared statements to prevent SQL injection
    $stmt = $connection->prepare($sql);

    if ($stmt === false) {
        die("Failed to prepare the statement: " . $connection->error);
    }

    // Bind the parameter and execute the statement
    $stmt->bind_param("s", $schoolId);

    if ($stmt->execute()) {
        // Fetch the result
        $result = $stmt->get_result();

        // Check if a record was found
        if ($result->num_rows > 0) {
            // Fetch the school data as an associative array
            $schoolData = $result->fetch_assoc();
            echo json_encode($schoolData);
        } else {
            // school not found
            echo json_encode(array("error" => "school not found"));
        }
    } else {
        // Error executing the statement
        echo json_encode(array("error" => "Database error"));
    }

    // Close the database connection
    $stmt->close();
    $connection->close();
} else {
    // 'id' parameter is missing
    echo json_encode(array("error" => "Missing 'id' parameter"));
}
?>
