<?php
    require 'db_configuration.php';
    $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    if($_POST['Save'])
    {
        $U_Id         = $_POST['ddlUser'];
        $S_Id         = $_POST['ddlSchool'];
        $Status       = $_POST['ddlStatus'];
        $CreatedDateTime = date('Y-m-d H:i:s');
        $ModifiedDateTime = $CreatedDateTime;
        $sql = "INSERT INTO school_user VALUES (NULL, '$U_Id', '$S_Id','$CreatedDateTime', '$CreatedDateTime','$Status')";
    }
    else if($_POST['Edit'])
    {
        $school_user_id= $_POST['school_user_id'];
        $U_Id         = $_POST['ddlUser'];
        $S_Id         = $_POST['ddlSchool'];
        $Status       = $_POST['ddlStatus'];
        $ModifiedDateTime = date('Y-m-d H:i:s');
        $sql = "Update school_user SET User_Id='$U_Id',School_id='$S_Id',Modified_Time='$ModifiedDateTime',Status='$Status' where SchoolUser_Id='$school_user_id'";
    }
    else if($_POST['delete'])
    {
        $SU_Id  = $_POST['SchoolUser_Id'];
        $sql = "delete from school_user where SchoolUser_Id='$SU_Id'";
    }
    mysqli_query($connection, $sql);
    mysqli_close($connection);
    header("Location: admin_assignschooluserrole.php");

?>
