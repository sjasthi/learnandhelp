<?php

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "learn_and_help_db";

    // connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Checks connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Checks if a file is uploaded
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['file']['tmp_name'];

        // Reads the uploaded file
        $handle = fopen($file, "r");

        // Skips the header row
        fgetcsv($handle);
        $row_count = 0;
        while (($data = fgetcsv($handle, 1000, ",")) !== false && $row_count < 10) {
            // Replaces empty strings with NULL
            foreach ($data as $key => $value) {
                if ($value === '') {
                    $data[$key] = 'NULL';
                } else {
                    $data[$key] = "'" . $conn->real_escape_string($value) . "'";
                }
            }

            // Generate the query using the values from the CSV
            $sql = "INSERT INTO schools (id, name, type, category, grade_level_start, grade_level_end, current_enrollment, address_text, state_name, state_code, pin_code, contact_name, contact_designation, contact_phone, contact_email, status, notes, referenced_by, supported_by) 
                    VALUES ($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10], $data[11], $data[12], $data[13], $data[14], $data[15], $data[16], $data[17], $data[18]) 
                    ON DUPLICATE KEY UPDATE 
                    name = VALUES(name), type = VALUES(type), category = VALUES(category), grade_level_start = VALUES(grade_level_start), grade_level_end = VALUES(grade_level_end), current_enrollment = VALUES(current_enrollment), 
                    address_text = VALUES(address_text), state_name = VALUES(state_name), state_code = VALUES(state_code), pin_code = VALUES(pin_code), contact_name = VALUES(contact_name), 
                    contact_designation = VALUES(contact_designation), contact_phone = VALUES(contact_phone), contact_email = VALUES(contact_email), status = VALUES(status), 
                    notes = VALUES(notes), referenced_by = VALUES(referenced_by), supported_by = VALUES(supported_by)";

            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $row_count++;
        }

        fclose($handle);
        echo "Data uploaded successfully!";
    } else {
        echo "Error uploading file.";
    }

    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Upload CSV</title>
</head>

<style>
       body {
            font-family: Arial, sans-serif;
            margin: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h2 {
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="file"] {
            margin-right: 10px;
        }

        input[type="submit"] {
            padding: 5px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        .success {
            color: green;
            font-weight: bold;
        }
</style>

<body>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <input type="submit" name="submit" value="Upload">
    </form>
</body>

</html>
