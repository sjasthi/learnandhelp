<?PHP
$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$usermail = $_POST['usermail'];
$password = $_POST['password'];
$hash = sha1($password);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learn_and_help_db";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check to see if this email is already in the database.
$sql = "SELECT * FROM users WHERE Email = '$usermail';";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // I am empty body for error messages...
    // Put failure message out there.
    $failure = true;
} else {
    // Add the new user to the database
    $sql = "INSERT INTO users (First_Name, Last_Name, Email, Hash, Active, Role, Modified_Time, Created_Time)
        VALUES ('$firstname' , '$lastname', '$usermail', '$hash', 'yes', 'student', SYSDATE(), SYSDATE());";
    $conn->query($sql);
    // Set session variables for the user
    $_SESSION['email'] = $usermail;
    $_SESSION['first_name'] = $firstname;
    $_SESSION['role'] = $role;
    // Send the user to the registration page.
    header('Location: homepage.php');
}
?>
