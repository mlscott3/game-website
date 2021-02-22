<?php

/**
 * Class: csci303fa20
 * User: mlscott3
 * Date: 11/9/2020
 * Time: 1:55 PM
 */
$pagename = "Confirmation";
include "include/head.php";

if ($_GET['state']== 1 ) {
    echo "You are logged out.";
}elseif ($_GET['state']==2) {
    echo "Welcome " . $_SESSION['fname'] . " !";
}
include "include/foot.php";
?>