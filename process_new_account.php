<?PHP
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$usermail = $_POST['usermail'];
$password = $_POST['password'];
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
        VALUES ('".$firstname."','".$lastname."','".$usermail."',SHA1('".$password."'),'yes','student',SYSDATE(),SYSDATE())";
    $conn->query($sql);
    setcookie("username", $firstname, strtotime('+30 days'));
    header('Location:homepage.php');
}
?>
