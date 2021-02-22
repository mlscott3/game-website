<?php

/**
 * Class: csci303fa20
 * User: mlscott3
 * Date: 12/1/2020
 * Time: 5:32 PM
 */

$pagename = "Select";
require_once "include/head.php";

//query the data
$sql = "SELECT ID, lname, fname FROM user_database ORDER BY lname";
//prepares a statement for execution
$stmt = $pdo->prepare($sql);
//executes a prepared statement
$stmt->execute();
//Returns an array containing all of the result set rows
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

//display contents of array:
//print_r($result);

echo "<hr>";

//loop through the results and display to the screen
    foreach ($result as $row){
        ?>
        <tr><td><a href="udetails.php?q=<?php echo $row['ID'];?>">View Details</a> |
                <a href="update.php?q=<?php echo $row['ID'];?>">Update</a> |
                <a href="statmod.php?q=<?php echo $row['ID'];?>">Modify Status</a> |
                <a href="delete.php?q=<?php echo $row['ID'];?>&l=<?php echo $row['lname'];?>">Delete</a> </td><?php echo "\n";?>
            <td><?php echo $row['fname'];?></td><?php echo "\n";?>
            <td><?php echo $row['lname'];?></td><?php echo "\n";?>
            <br>
        </tr>
        <?php echo "\n";
    }//foreach

require_once "include/foot.php";
