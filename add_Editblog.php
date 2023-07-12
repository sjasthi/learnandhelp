<?php
    require 'db_configuration.php';
    $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);
    print_r($_FILES['Location']);
    $Blog_Id        = $_POST['Blog_Id'];
    $Title          = $_POST['Title'];
    $Author         = $_POST['Author'];
    $Description    = $_POST['Description'];
    $Video_Link     = $_POST['Video_Link'];
    $ModifiedDateTime = date('Y-m-d H:i:s');

    if($Blog_Id!="" && $Blog_Id!="0")
    {
        $sql = "UPDATE blogs SET
                     Title = '$Title',
                     Author = '$Author',
                     Description = '$Description',
                     Video_Link = '$Video_Link',
                     Modified_Time = '$ModifiedDateTime'
                     WHERE Blog_Id = '$Blog_Id'";
        //echo $sql;
         mysqli_query($connection, $sql);
         if(isset($_FILES['Location']))
         {
             $fileCount = count($_FILES['Location']['name']);
             for($i=0; $i < $fileCount; $i++)
             {
                 echo $i;
                 $fileTmpName   = $_FILES['Location']['tmp_name'][$i];
                 $fileType      = $_FILES['Location']['type'][$i];
                 $guid          = uniqid();
                 $extension     = pathinfo($_FILES['Location']['name'][$i], PATHINFO_EXTENSION);
                 $FileLocation  = $guid . '.' . $extension;
                 $destination   = 'images/blog_pictures/' . $FileLocation;
                 $sql           = "INSERT INTO blog_pictures VALUES (NULL, '$Blog_Id', '$destination')";
                 mysqli_query($connection, $sql);
                 move_uploaded_file($fileTmpName, $destination);
             }
         }
    }
    mysqli_close($connection);
    header("Location: admin_blogs.php");
?>
