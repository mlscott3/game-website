<?php

/**
 * Class: csci303fa20
 * User: mlscott3
 * Date: 12/1/2020
 * Time: 2:47 PM
 */
$pagename ="Admin Page";
require_once "include/head.php";

if (isset($_SESSION['status'])) {
        echo "<p class='error'>This page requires you to be an admin.</p>";
        require_once "include/foot.php";
        exit();
    }
?>
<p class = 'text'>Welcome to the Admin Page! Here you can modify other users' status and update their content.</p>
    <p>Click here to start modifying <a href = "select.php">Select User</a></p>
<a href="coninsert.php">Add new Teams</a>
<?php
require_once "include/foot.php";
