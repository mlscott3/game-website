<?php

/**
 * Class: csci303fa20
 * User: mlscott3
 * Date: 11/10/2020
 * Time: 6:16 PM
 */

$pagename = "User Query";
require_once "include/head.php";
//QUERY THE DATABASE
$sql = "SELECT ID, fname, lname FROM user_database ORDER BY lname";

//EXECUTE THE QUERY TO GET THE RESULTS
$result = $pdo->query($sql);

//LOOP THROUGH AND DISPLAY THE RESULTS
foreach($result as $row) {
    echo "<a href='udetails.php?q=" . $row['ID'] . "'>" . $row['fname'] . " " . $row['lname'] . "</a><br>";
}
require_once "include/foot.php";