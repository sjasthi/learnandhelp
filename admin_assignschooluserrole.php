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


 ?>

<!DOCTYPE html>
<script>
</script>
<html>
  <head>
    <link rel="icon" href="images/icon_logo.png" type="image/icon type">
    <title>Administration</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;900&display=swap" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function () {
      $('#Blog_table thead tr').clone(true).appendTo( '#Blog_table thead' );
      $('#Blog_table thead tr:eq(1) th').each(function () {
      var title = $(this).text();
      $(this).html('<input type="text" placeholder="Search ' + title + '" />');
      });

      var table = $('#Blog_table').DataTable({
         initComplete: function () {
             // Apply the search
             this.api()
                 .columns()
                 .every(function () {
                     var that = this;

                     $('input', this.header()).on('keyup change clear', function () {
                         if (that.search() !== this.value) {
                             that.search(this.value).draw();
                         }
                     });
                 });
             },
         });

      $('a.toggle-vis').on('click', function (e) {
      e.preventDefault();

      // Get the column API object
      var column = table.column($(this).attr('data-column'));

      // Toggle the visibility
      column.visible(!column.visible());
      });
     });
    </script>
  </head>
  <body>
  <?php include 'show-navbar.php'; ?>
  <?php show_navbar(); ?>
    <header class="inverse">
      <div class="container">
        <h2><span class="accent-text">Assign School User</span></h2>
      </div>
    </header>
	<!-- Jquery Data Table -->

    <div class="toggle_columns">
      Toggle column: 
          <a class="toggle-vis" data-column="0">School User Id</a>
        - <a class="toggle-vis" data-column="1">School</a>
        - <a class="toggle-vis" data-column="2">First Name</a>
        - <a class="toggle-vis" data-column="3">Last Name</a>
        - <a class="toggle-vis" data-column="4">Role</a>
        - <a class="toggle-vis" data-column="5">Email</a>
        - <a class="toggle-vis" data-column="6">Created_Time</a>
        - <a class="toggle-vis" data-column="7">ModifiedDateTime </a>
        - <a class="toggle-vis" data-column="8">Status </a>
        
    </div>
    <div style="padding-top: 10px; padding-bottom: 30px; width:90%; margin:auto; overflow:auto">
      <table id="Blog_table" class="display compact">
        <thead>
          <tr>
            <th>ID</th>
            <th>School</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Role</th>
            <th>Email</th>
            <th>Created DateTime</th>
            <th>Modified DateTime</th>
            <th>Status</th>
            <th>Option</th>
          </tr>
        </thead>
        <tbody>
          <!-- Populating table with data from the database-->
          <?php
            require 'db_configuration.php';
            // Create connection
            $conn = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
            // Check connection
            if ($conn->connect_error) 
            {
              die("Connection failed: " . $conn->connect_error);
            }
            $sql = "select school_user.SchoolUser_Id,schools.id,schools.name,users.User_Id,users.First_Name,users.Last_Name,users.Role,users.Email,school_user.Created_Time,school_user.Modified_Time,school_user.Status
             from school_user INNER join users on users.User_Id = school_user.User_Id INNER join schools on schools.id = school_user.School_id;";
            $result = $conn->query($sql);

            $sqlSchool = "SELECT * FROM `schools`";
            $sqlSchool = $conn->query($sqlSchool);

            $sqlUser = "SELECT * FROM `users` where Active='yes' and Role='admin'";
            $sqlUser = $conn->query($sqlUser);

            if ($result->num_rows > 0) 
            {
              // Create table with data from each row
              while($row = $result->fetch_assoc()) 
              {
                  $Editable = $row["SchoolUser_Id"].'*'.$row["User_Id"].'*'.$row["id"].'*'.$row["Status"];
                  echo "<tr>
                    <td>". $row["SchoolUser_Id"]."</td>
                    <td>". $row["name"]."</td>
                    <td>". $row["First_Name"]."</td> 
                    <td>". $row["Last_Name"]."</td> 
                    <td>". $row["Role"]."</td> 
                    <td>". $row["Email"]."</td> 
                    <td>". $row["Modified_Time"]."</td> 
                    <td>". $row["Created_Time"]."</td> 
                    <td>". $row["Status"]."</td> 
                    <td>
                    <form action='admin_assignschooluserrole.php' method='POST'>
                    <input type='hidden' name='id' value='". $row["SchoolUser_Id"] . "'>
                    <input type='submit' id='admin_buttons' name='edit' value='Edit'/>
                  </form>
                      <form action='admin_addassignschooluserrole.php' method='POST'>
                        <input type='hidden' name='SchoolUser_Id' value='". $row["SchoolUser_Id"] . "'>
                        <input type='submit' id='admin_buttons' name='delete' value='Delete'/>
                      </form>
                    </td>
                    </tr>";
                  // <a href='admin_edit_blog.php?query=".$row['SchoolUser_Id']."'><input type='button' style='width:200px; height:44px; background-color:blue; color:white; border:solid 0px; border-radius:5px'  value='Edit'/></a>

              }
            } else {
              echo "0 results";
            }
            $conn->close();
    		?>
        </tbody>
      </table>
</div>
<div style="padding-top: 10px; padding-bottom: 30px; width:90%; margin:auto; overflow:auto">
<center>
    <form action='admin_addassignschooluserrole.php' method='POST'>
    <table id="Blog_table" class="display compact" style="width:50%" cellpadding=5  border=1>
            <tr style="background-color:darkgray; color:black; font-weight:bold"><td colspan="2">Assign User as School Admin</td></tr>
          <tr>
            <td>Select User</td>
            <td style="width:80%">
              <select id="ddlUser" name="ddlUser">
                <option>Select</option>
                <?php
                  if ($sqlUser->num_rows > 0) 
                  {
                    // Create table with data from each row
                    while($row = $sqlUser->fetch_assoc()) 
                    {
                      $User_Info = $row["First_Name"].' '.$row["First_Name"].'('.$row["First_Name"].')'; 
                      echo " <option value='".$row["User_Id"]."'>".$User_Info."</option>";
                    }
                  }
                ?>
              </select>
            </td>
            </tr>
            <tr>
            <td>Select School</td>
            <td>
              <select id="ddlSchool" name="ddlSchool">
                <option>Select</option>
                <?php
                  if ($sqlSchool->num_rows > 0) 
                  {
                    // Create table with data from each row
                    while($row = $sqlSchool->fetch_assoc()) 
                    {
                      $School = $row["name"].' '.$row["type"].'('.$row["category"].')'; 
                      echo " <option value='".$row["id"]."'>".$School."</option>";
                    }
                  }
                ?>
              </select>
            </td>
            </tr>
            <tr>
            <td>Status</td>
            <td>
              <select id="ddlStatus" name="ddlStatus">
                <option>Select</option>
                <option value='1'>Active</option>
                <option value='0'>Deactive</option>
              </select>
            </td>
            </tr>
           <tr>
            <td></td>
            <td>
              <input type="hidden" value="" name="schooluser_id" id="schooluser_id">
              <input type="submit" value="Assign" name="Save" id="Save">
              <input type="submit" value="Change" name="Edit" id="Edit" style="display:none">
              
            </td>
            </tr>
          </table>
      </form>
 </center>
</div>
  </body>
  <script>
    function EditFun(obj)
    {
      console.log(obj);
      var Data =  obj.split('*');
      document.getElementById("ddlUser").value=Data[1];
      document.getElementById("ddlSchool").value=Data[2];
      document.getElementById("ddlStatus").value=Data[3];
      document.getElementById("Save").style.display="none";
      document.getElementById("Edit").style.display="block";
      document.getElementById("schooluser_id").value=Data[0];
    }
  </script>
</html>
