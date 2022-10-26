<?PHP
    global $firstname;
    $firstname = $_POST['firstname'];
    global $lastname;
    $lastname = $_POST['lastname'];
    global $usermail;
    $usermail = $_POST['usermail'];
    global $password;
    $password =$_POST['password'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "learn_and_help_db";
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM Users WHERE email = '.$usermail.'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo 'Account already exists';
    }
    else {
    // INSERT INTO Users (First_Name, Last_Name, Email, Hash, Active, Role, Modified_Time, Created_Time)
    // VALUES ('Michael', 'Hunt', 'michaelhunt@tinder.com', PASSWORD('somepassword'), true, 'student', SYSDATE(), SYSDATE());
        $sql = "INSERT INTO Users (First_Name, Last_Name, Email, Hash, Active, Role, Modified_Time, Created_Time) VALUES ('"
            .$firstname."','".$lastname."','".$usermail."',SHA1('".$password."'),'yes','student',SYSDATE(),SYSDATE())";
        $result = $conn->query($sql);
        setcookie("username", $firstname, strtotime('+30 days'));
        header('Location:homepage.php');
    }
?>
