<?php

$status = session_status();

if ($status == PHP_SESSION_NONE) {
    session_start();
}

// Block unauthorized users from accessing the page
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    http_response_code(403);
    die('Forbidden');
}

// Database connection
require 'db_configuration.php';

try {
    $pdo = new PDO("mysql:host=" . DATABASE_HOST . ";dbname=" . DATABASE_DATABASE, DATABASE_USER, DATABASE_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch users from the database
try {
    $stmt = $pdo->query("SELECT User_Id, First_Name, Last_Name, Email, Phone FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}

// Twilio configuration
require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';
use Twilio\Rest\Client;

$sid = 'ACaab18ef8ea8e54c932f14cfc66314e10';
$token = '34b53b5c1248212b0324fb085bcb8c24';
$twilio_whatsapp_number = '+14155238886';

// Add error checking
if (empty($sid) || empty($token)) {
    die("Twilio credentials are not set. Please check your environment variables.");
}


$twilio = new Client($sid, $token);

// Function to send SMS message
function sendWhatsAppMessage($to, $message) {
    global $twilio, $twilio_whatsapp_number;

    try {
        $message = $twilio->messages->create(
            "whatsapp:$to",
            [
                "from" => "whatsapp:$twilio_whatsapp_number",
                "body" => $message
            ]
        );
        error_log("WhatsApp message sent successfully to $to: " . $message->sid);
        return true;
    } catch (Exception $e) {
        error_log("Failed to send WhatsApp message to $to: " . $e->getMessage());
        error_log("Error code: " . $e->getCode());
        error_log("Full error details: " . print_r($e, true));
        return false;
    }
}





// Handle SMS message sending
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'send_whatsapp') {
    $message = $_POST['message'];
    $recipients = json_decode($_POST['recipient'], true);

    error_log("Message: " . $message);
    error_log("Recipients: " . print_r($recipients, true));

    $results = [];

    if (in_array('all', $recipients)) {
        foreach ($users as $user) {
            $result = sendWhatsAppMessage($user['Phone'], $message);
            $success = $success && $result;
            $results[] = ['phone' => $user['Phone'], 'success' => $result];
        }
    } else {
        foreach ($recipients as $recipient) {
            $result = sendWhatsAppMessage($recipient, $message);
            $success = $success && $result;
            $results[] = ['phone' => $recipient, 'success' => $result];
        }
    }

    echo json_encode(['success' => $success, 'results' => $results]);
    exit;
}



?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Administration</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <style>
        .chat-area {
            height: 300px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #e5ddd5;
        }
        .message {
            margin-bottom: 10px;
            padding: 8px 12px;
            border-radius: 8px;
            max-width: 70%;
            clear: both;
        }
        .message.sent {
            background-color: #dcf8c6: right;
        }
        .message.received {
            background-color: #ffffff;
            float: left;
        }
        .message-input {
            display: flex;
            margin-top: 10px;
        }
        .message-input input {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 20px;
        }
        .message-input button {
            margin-left: 10px;
            padding: 10px 20px;
            background-color: #25D366;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include 'show-navbar.php'; ?>
    <?php show_navbar(); ?>
    <header class="inverse">
        <h1><span class="accent-text">WhatsApp</span></h1>
    </header>
    <div class="container">
        <div class="sidebar">
            <div class="header">
                <h2>Contacts</h2>
            </div>
            <div class="user-select">
                <label for="user-select">Select recipients:</label>
                <select id="user-select" multiple>
                    <option value="all">All Users</option>
                    <?php foreach ($users as $user) : ?>
                        <option value="<?= htmlspecialchars($user['Phone']) ?>">
                            <?= htmlspecialchars($user['First_Name'] . ' ' . $user['Last_Name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <table class="user-table">
            </table>
        </div>
        <div class="main">
            <div class="header">
                <h2 id="selected-Select users to start chatting</h2>
            </div>
            <div class="chat-area" id="chat-area">
            </div>
            <form id="message-form">
                <div class="message-input">
                    <input type="text" id="message-text" name="message" placeholder="Type a message" required>
                    <button type="submit" id="send-button">Send</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let selectedUsers = [];

        document.getElementById('user-select').addEventListener('change', function() {
            selectedUsers = Array.from(this.selectedOptions).map(option => option.value);
            if (selectedUsers.includes('all')) {
                selectedUsers = ['all'];
                this.value = 'all';
            }
            updateSelectedUserDisplay();
        });

        function updateSelectedUserDisplay() {
            const displayElement = document.getElementById('selected-user');
            if (selectedUsers.length === 0) {
                displayElement.textContent = 'Select users to start chatting';
            } else if (selectedUsers.includes('all')) {
                displayElement.textContent = 'Chat with All Users';
            } else {
                displayElement.textContent = `Chat with ${selectedUsers.length} selected user(s)`;
            }
        }

      document.getElementById('message-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const messageText = document.getElementById('message-text').value;
    if (messageText.trim() !== '') {
        if (selectedUsers.length > 0) {
            sendWhatsAppMessage(selectedUsers, messageText);
        } else {
            alert('Please select at least one user to chat with.');
        }
    }
});



        function addMessage(text, type) {
            const chatArea = document.getElementById('chat-area');
            const messageElement = document.createElement('div');
            messageElement.classList.add('message', type);
            messageElement.textContent = text;
            chatArea.appendChild(messageElement);
            chatArea.scrollTop = chatArea.scrollHeight;
        }
function sendWhatsAppMessage(recipients, message) {
    fetch(window.location.href, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            'action': 'send_whatsapp',
            'recipient': JSON.stringify(recipients),
            'message': message
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            addMessage(message, 'sent');
            document.getElementById('message-text').value = '';
            console.log('Message sent successfully', data.results);
        } else {
            alert('Failed to send WhatsApp message to some recipients. Please check the console for details.');
            console.error('Message sending results:', data.results);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Message sent successfully.');
    });
}


    </script>
</body>
</html>
