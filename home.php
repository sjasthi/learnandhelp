<?php
$status = session_status();
if ($status == PHP_SESSION_NONE) {
  session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="icon" href="images/icon_logo.png" type="image/icon type">
  <title>Home</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">
  <style>
	.stats {
	  font-size: 30px;
      font-weight: 400;
	}
    .slidein1 {
      animation: slidein 1.5s forwards;
	  overflow: hidden;
    }
	.slidein2 {
	  opacity: 0;
      animation: slidein 1.9s 0.1s forwards;
	  overflow: hidden;
    }
	.slidein3 {
      opacity: 0;
      animation: slidein 2.2s 0.2s forwards;
	  overflow: hidden;
    }
    @keyframes slidein {
      from {
		opacity: 0;
        translate: 20vw;
      }
      to {
		opacity: 1;
        translate: 0;
      }
    }
  </style>
</head>
<body>
  <?php include 'show-navbar.php';
  show_navbar(); ?>
  <header class="inverse">
    <div class="container">
      <h1><span class="accent-text">Home</span></h1>
    </div>
  </header>
    <div class="container">
	<?php
	require 'db_configuration.php';
	// Create connection
	$conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
	// Check connection
	if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
	
	$sql = "SELECT count(*) as num_schools FROM `schools`";
	$result = $conn->query($sql);
    $total_array = $result->fetch_assoc();
	$num_schools = $total_array['num_schools'];
	
	$sql = "SELECT count(*) as num_books FROM `books`";
	$result = $conn->query($sql);
    $total_array = $result->fetch_assoc();
	$num_books = $total_array['num_books'];
	
	$sql = "SELECT count(DISTINCT(User_Id)) as num_students FROM `registrations`";
	$result = $conn->query($sql);
    $total_array = $result->fetch_assoc();
	$num_students = $total_array['num_students'];
	
	$result->free();
	$conn->close();
	echo "<h2><b>Learn and Help Program Summarized</b></h2>
		<p class=\"stats slidein1\"><span class=\"value\" data-value=\"$num_schools\">0</span> Schools Supported</p>
		<p class=\"stats slidein2\"><span class=\"book_value\" data-value=\"$num_books\">0</span> Books Shipped</p>
		<p class=\"stats slidein3\"><span class=\"value\" data-value=\"$num_students\">0</span> Students Enrolled</p>
	</div>
	</body>
		<script>
		  // Dynamically increment school and student values
		  let allValues = document.querySelectorAll(\".value\");
		  allValues.forEach((singleValue) => {
		    let startValue = 0;
		    let endValue = parseInt(singleValue.getAttribute(\"data-value\"));
		    let duration = Math.floor(2000 / endValue);
		    let counter = setInterval(function () {
		      startValue += 1;
		      singleValue.textContent = startValue;
		      if (startValue == endValue) {
		        clearInterval(counter);
		      }
		    }, duration);
		  });
		  // Faster counter for larger book total
		  let startNum = 0,
		  endNum = $num_books,
		  nSecond = 2,
		  resolutionMS = 33,
		  deltaNum = (endNum - startNum) / (900 / resolutionMS) / nSecond;
		  function countIni() {
		    var handle = setInterval(() => {
		      var x = startNum.toLocaleString(undefined, {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
              });
              document.querySelector('.book_value').innerHTML = x.toString();
		      // if already updated the endNum, stop
		      if (startNum >= endNum) clearInterval(handle);
		        startNum += deltaNum;
		      startNum = Math.min(startNum, endNum);
		    }, resolutionMS);
		  }
		  countIni();
		</script>
	</html>";
?>