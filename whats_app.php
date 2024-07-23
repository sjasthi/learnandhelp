<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}

// Block unauthorized users from accessing the page
if (isset($_SESSION['role'])) {
  if ($_SESSION['role'] != 'admin') {
    http_response_code(403);
    die('Forbidden');
  }
} else {
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
    /* ... (keep the existing styles) ... */
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
      background-color: #dcf8c6;
      float: right;
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
      <table class="user-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $user) : ?>
            <tr class="user-item" data-id="<?= htmlspecialchars($user['User_Id']) ?>" data-phone="<?= htmlspecialchars($user['Phone']) ?>">
              <td><?= htmlspecialchars($user['First_Name'] . ' ' . $user['Last_Name']) ?></td>
              <td><?= htmlspecialchars($user['Email']) ?></td>
              <td><?= htmlspecialchars($user['Phone']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="main">
      <div class="header">
        <h2 id="selected-user">Select a user to start chatting</h2>
      </div>
      <div class="chat-area" id="chat-area">
        <!-- Messages will be dynamically added here -->
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
    let selectedUserId = null;
    let selectedUserEmail = null;
    let selectedUserPhone = null;

    document.querySelectorAll('.user-item').forEach(item => {
      item.addEventListener('click', function() {
        selectedUserId = this.getAttribute('data-id');
        selectedUserEmail = this.querySelector('td:nth-child(2)').textContent;
        selectedUserPhone = this.getAttribute('data-phone');
        const userName = this.querySelector('td').textContent;
        document.getElementById('selected-user').textContent = 'Chat with ' + userName;
        document.getElementById('chat-area').innerHTML = ''; // Clear previous messages
      });
    });

    document.getElementById('message-form').addEventListener('submit', function(e) {
      e.preventDefault();
      if (selectedUserId) {
        const messageText = document.getElementById('message-text').value;
        if (messageText.trim() !== '') {
          addMessage(messageText, 'sent');
          document.getElementById('message-text').value = '';
        }
      } else {
        alert('Please select a user to chat with.');
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
  </script>
</body>

</html>
?>