<?php

/**
 * Class: csci303fa20
 * User: mlscott3
 * Date: 11/10/2020
 * Time: 5:39 PM
 */

$pagename = "User Details";
require_once "include/head.php";

//echo $_GET['q'];
//query the data
$sql = "SELECT * FROM user_database WHERE ID = :ID";
//prepares a statement for execution
$stmt = $pdo->prepare($sql);
//binds the actual value of $_GET['q'] to placeholder for employee number
$stmt->bindValue(':ID', $_GET['q']);
//executes a prepared statement
$stmt->execute();
//fetches the next row from a result set / returns an array
//default:  array indexed by both column name and 0-indexed column number
$row = $stmt->fetch(PDO::FETCH_ASSOC);


echo 'First Name: '. $row['fname']  . "<br>" . 'Last Name: '. $row['lname'] . "<br>" .  'Email: ' . $row['email'] . "<br>" . 'Console Team: '. $row['console_team'];

require_once "include/foot.php";