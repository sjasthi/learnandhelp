<?php
    function show_causes(){
        require 'db_configuration.php';
        $connection = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_DATABASE);

        if ($connection === false)
        {
  	        die("Failed to connect to database: " . mysqli_connect_error());
        }
        echo '';
        $sql = "Select C.Class_Name, C.Description, C.Teacher_ID from classes as C";
//        $sql = "SELECT C.Class_Name, U.First_Name, U.Last_Name
//                FROM classes as C
//                LEFT JOIN users as U on C.Teacher_Id = U.User_Id";
        $result = mysqli_query($connection, $sql);
        $i = 0;
        $admin = 1;
        if (!$admin) echo '<table id="classes">';
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            if ($admin)
            {
                echo '
                    <form action="update_classes.php" method="post">
                        <input type="hidden" name="rowId" value="'.$row['C.Class_Id'].'">
                            <table id="classes">';
                        if ($i == 0)
                        {
                        echo   '<tr>
                                    <th>Class</th>
                                    <th>Teacher</th>
                                </tr>';
                        }
                        echo   ' <tr>
                                    <td>
                                        <input type="text" name="name" value="'.$row['C.Class_Name'].'">
                                    </td>
                                    <td>
                                        <input type="text" name="description" value="'.$row['C.Description'].'">
                                    </td>
                                    <td>
                                        <input type="text" name="teacher_id" value="'.$row['C.Teacher_Id'].'">
                                    </td>
                                    <td>
                                        <input type="hidden" name="action" value="update">
                                        <input type="submit" value="Update">
                                    </td>

                                    <td>
                                        <select name="action" style="width: 100%">
                                            <option value="update">Edit</option>
                                            <option value="delete">Delete</option>

                                    </td>
                            </tr>
                            </table>

                    ';
            } else
            {
                if ($i == 0)
                {
                    echo '';
                }
            }
            $i++;
        }
        echo '</table>';
        if ($admin) echo '</form>
        <br><br>
        <h1><b><u>Add New</u></b></h1>
        <form action="update_classes.php" method="post" id="add">
            <table id="classes">
                <tr>
                    <td>
                        <input type="text" name="name" placeholder="Class name" required>
                    </td>
                    <td>
                        <input type="text" name="description" placeholder="Description" required>
                    </td>
                    <td>
                        <input type="text" id="teacher_id" name="teacher_id" placeholder="Silva" required>
                    </td>
                    <td>
                        <input type="hidden" name="action" value="add" >
                    </td>
                </tr>
                <tr>
                    <td colspan=3>
                        <input type="submit" value="Add" style="width: 33%">
                    </td>
                </tr>
            </table>
        </form>';
    }
?>
