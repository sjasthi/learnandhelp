<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quote of the Day</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your styles here -->
</head>
<body>
    <?php include 'show_navbar.php'; ?>
    <div class="quote-container">
        <h1>Quote of the Day</h1>
        <p id="quote"></p>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('fetch_quote.php')
                .then(response => response.text())
                .then(quote => {
                    document.getElementById('quote').textContent = quote;
                })
                .catch(error => {
                    document.getElementById('quote').textContent = 'Failed to fetch quote.';
                });
        });
    </script>
</body>
</html>
