<?php
function fill_form() {
    $sponsor_name = $_POST['sponsers-name'];
    $sponsor_email = $_POST['sponsers-email'];
    $sponsor_phone = $_POST['sponsers-phone'];
    $spouse_name = $_POST['spouses-name'];
    $spouse_email = $_POST['spouses-email'];
    $spouse_phone = $_POST['spouses-phone'];
    $student_name = $_POST['students-name'];
    $student_email = $_POST['students-email'];
    $student_phone = $_POST['students-phone'];
    $class = $_POST['class'];
    $cause = $_POST['cause'];

    echo "<form id=\"survey-form\" action=\"form-submit.php\" method = \"post\">
        <!---Sponsors Section -->
        <label id=\"name-label\">Sponsor's Name</label>
        <input type=\"text\" id=\"sponsers-name\" name=\"sponsers-name\" class=\"form\" value=\"$sponsor_name\" required><br><!--name--->
        <label id=\"sponsers-email-label\"> Sponsor's Email</label>
        <input type=\"email\" id=\"sponsers-email\" name=\"sponsers-email\" class=\"form\" value=\"$sponsor_email\" required><br><!---email-->
        <label id=\"sponsors-number-label\">Sponsor's Phone Number</label>
        <input type=\"tel\" id=\"sponsers-phone\" name=\"sponsers-phone\" value=\"$sponsor_phone\" required>
        <br>
        <br> 
        <br>
        <!---Spouse Section -->
        <label id=\"spouses-name-label\">Spouse's Name</label>
        <input type=\"text\" id=\"spouses-name\" name=\"spouses-name\" class=\"form\" value=\"$spouse_name\" required><br>
        <label id=\"spouses-email-label\"> Spouse's Email</label>
        <input type=\"email\" id=\"spouses-email\" name=\"spouses-email\" class=\"form\" value=\"$spouse_email\" required ><br>
        <label id=\"spouses-number-label\">Spouse's Phone Number</label>
        <input type=\"tel\" id=\"spouses-phone\" name=\"spouses-phone\" value=\"$spouse_phone\" required>
        <br>
        <br> 
        <br>
        <!---Student Section -->  
        <label id=\"students-name-label\">Student's Name</label>
        <input type=\"text\" id=\"students-name\" name=\"students-name\" class=\"form\" required value=\"$student_name\"><br>
        <label id=\"students-email-label\"> Student's Email</label> 
        <input type=\"email\" id=\"students-email\" name=\"students-email\" class=\"form\" required value=\"$student_email\"><br
        <label id=\"students-number-label\">Student's Phone Number</label>
        <input type=\"tel\" id=\"students-phone\" name=\"students-phone\" value=\"$student_phone\" required>
        <br>
        <br>
        <label id=\"class\">Select Class</label>
        <select id=\"dropdown\" name=\"role\" required>
          <option disabled value>
            Select your class
          </option>
          <option value=\"py1\" ";
            if ($class == "py1")
                echo "selected";
        echo  ">
            Python 101
          </option>
          <option value=\"java1\" ";
          if ($class == "java1")
              echo "selected";
        echo ">
            Java 101
          </option>
          <option value=\"py2\" ";
          if ($class == "py2")
              echo "selected";
        echo ">
            Python 201
          </option>
		  <option value=\"java2\" ";
          if ($class == "java2")
              echo "selected";
        echo ">
			Java 201
		  </option>
		</select>
		<!--dropdown--->
		<p><strong>Cause</strong></p>   
		<label>
		  <input type=\"radio\" name=\"cause\" value=\"lib\" ";
          if ($cause == "Library")
              echo "checked=\"checked\"";
        echo ">Library
		</label>
		<br>
		<label>
		  <input type=\"radio\" name=\"cause\" value=\"Dig_class\" ";
          if ($cause == "Digital Classroom")
              echo "checked=\"checked\"";
        echo ">Digital Classroom</label>
		<label>
		  <br>
		  <input type=\"radio\" name=\"cause\" value=\"Other\" ";
          if ($cause == "No Preference")
              echo "checked=\"checked\"";
        echo "> No Preference
		</label><!---radioButtons--->";
}
?>