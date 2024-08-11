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
}
else {
  http_response_code(403);
  die('Forbidden');
}

require 'db_configuration.php';
// Create connection
$conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
// Check connection
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$sql = "SELECT count(*) AS num_schools, sum(current_enrollment) AS num_beneficiaries FROM `schools`";
$result = $conn->query($sql);
$total_array = $result->fetch_assoc();
$num_schools = $total_array['num_schools'];
$num_beneficiaries = $total_array['num_beneficiaries'];

$sql = "SELECT count(*) AS num_registrations FROM `registrations`";
$result = $conn->query($sql);
$total_array = $result->fetch_assoc();
$num_registrations = $total_array['num_registrations'];

$result->free();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="icon" href="images/icon_logo.png" type="image/icon type">
  <title>Reports</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <style>
	body {
		margin: auto;
		max-width: 100%;
	}

	table {
		border-collapse: collapse;
		width: 75%;
		margin: 5rem auto;
		table-layout: fixed;
	}

	th,
	td {
		border: 1px solid #ddd;
		padding: 8px;
		text-align: center;
	}

	th {
		background-color: #f2f2f2;
	}

	form {
		display: inline;
	}

	h2 {
		margin-top: 4rem;
	}
   </style>
</head>
<body>
<?php 
  include 'show-navbar.php';
  show_navbar();
?>
<header class="inverse">
  <div class="container">
    <h1><span class="accent-text">Reports</span></h1>
  </div>
</header>
  
<div class="container">
  <h2><b>Library Information</b></h2>
</div>
<table>
  <tr>
    <th>Statistic</th>
    <th>Total</th>
  </tr>
  <tr>
    <td>Schools With Libraries</td>
    <td><?php echo "$num_schools"; ?></td>
  </tr>
  <tr>
    <td>Student Beneficiaries</td>
    <td><?php echo "$num_beneficiaries"; ?></td>
  </tr>
  <tr>
    <td>Books Given To Schools</td>
    <td>N/A</td>
  </tr>
  <tr>
    <td>Cost / Support Provided</td>
    <td>N/A</td>
  </tr>
</table>

<div class="container">
  <h2><b>Student Information</b></h2>
</div>
<table>
  <tr>
    <th>Statistic</th>
    <th>Total</th>
  </tr>
  <tr>
    <td>Class Registrations</td>
    <td><?php echo "$num_registrations"; ?></td>
  </tr>
  <tr>
    <td>Earned Certification</td>
    <td>N/A</td>
  </tr>
  <tr>
    <td>Success Rate</td>
    <td>N/A</td>
  </tr>
</table>

</body>
</html>