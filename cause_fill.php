<?php
    function show_causes(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "learn_and_help_db";
        $connection = new mysqli($servername, $username, $password, $dbname);

        if ($connection === false) {
  	    die("Failed to connect to database: " . mysqli_connect_error());
        }
        echo '';
        $sql = "SELECT * FROM causes";
        $result = mysqli_query($connection, $sql);
        $i = 0;
        $admin = 0;
        if (!$admin) echo '<table id="causes">';
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
        {
            if ($admin){
                echo '
                    
                    <form action="update_causes.php" method="post">
                        <input type="hidden" name="rowId" value="'.$row['Cause_Id'].'">
                            <table id="causes">';
                if ($i == 0){

                        echo '<tr>
                                    <th>Cause</th>
                                    <th>Description</th>
                                    <th>URL</th>
                                    <th>Contact Name</th>
                                    <th>Contact Email</th>
                                    <th>Contact Phone</th>
                                </tr>';
                }
                echo              ' <tr>
                                    <td>
                                        <input type="text" name="name" value="'.$row['Cause_name'].'">
                                    </td>
                                    <td>
                                        <textarea rows="2" cols="20" name="description">'.$row['description'].'</textarea>
                                    </td>
                                    <td>
                                        <input type="text" name="URL" value="'.$row['URL'].'">
                                    </td>
                                    <td>
                                        <input type="text" name="contact_name" value="'.$row['Contact_name'].'">
                                    </td>
                                    <td>
                                        <input type="text" name="contact_email" value="'.$row['Contact_email'].'">
                                    </td>
                                    <td>
                                        <input type="text" name="contact_phone" value="'.$row['Contact_phone'].'">
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

               
            } else {

                   if ($i == 0){

                    echo '<tr>
                                <th>Cause</th>
                                <th>Description</th>
                                <th>URL</th>
                                <th>Contact Name</th>
                                <th>Contact Email</th>
                                <th>Contact Phone</th>
                            </tr>';
            }
                    echo '<tr>
                        <td>'.$row['Cause_name'].'</td>
                        <td><p style="text-align: left; word-wrap: break-word;">'.$row['description'].'</p></td>
                        <td>'.$row['URL'].'</td>
                        <td>'.$row['Contact_name'].'</td>
                        <td>'.$row['Contact_phone'].'</td>
                        <td>'.$row['Contact_email'].'</td>
                    </tr>';
                
            }
            $i++;
        }
        echo '</table>';
        if ($admin) echo '</form>
        <br><br>
        <h1><b><u>Add New</u></b></h1>
        <form action="update_causes.php" method="post" id="add">
            <table id="causes">
                <tr><td>
                <input type="text" name="name" placeholder="Cause name" required>
                </td><td>
                <input type="text" name="description" placeholder="Cause Description" required>
                </td><td>
                <input type="text" name="URL" placeholder="URL" required>
                </td></tr>
                <tr><td>
                <input type="text" name="contact_name" placeholder="Contact name" required>
                </td><td>
                <input type="email" id="contact-email" name="contact_email" class="form" required placeholder="Contact email">
                </td><td>
                <input type="tel" id="contact-phone" name="contact_phone" placeholder="123-456-7899" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
                </td><td>
                <input type="hidden" name="action" value="add" >
                </td></tr><tr><td colspan=3>
                <input type="submit" value="Add" style="width: 33%">
                </td></tr>
            </table>
        </form>';
    }

?>