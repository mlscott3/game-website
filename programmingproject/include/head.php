<?php

/**
 * Class: csci303fa20
 * User: mlscott3
 * Date: 11/8/2020
 * Time: 6:28 PM
 */
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

$currentfile = basename($_SERVER['PHP_SELF']);
//header include file
require_once "function.php";
require_once "connects.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Marque Scott</title>
    <link rel ="stylesheet" href="include/style.css">
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=5o7mj88vhvtv3r2c5v5qo4htc088gcb51913qx5wlrtjn81y"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body>
<header>
    <h2><?php echo $pagename;?></h2>
    <nav>
        <ul><?php
            echo ($currentfile== "index.php") ? "<li>Home Page</li>" : "<li><a href='index.php'>Home</a></li>";
            echo ($currentfile== "signup.php") ? "<li>Sign Up</li>" : "<li><a href='signup.php'>Sign Up</a></li>";
            echo($currentfile == "gamesystems.php") ? "<li>Game Systems</li>" : "<li><a href='gamesystems.php'>Game Systems</a></li>";
            if(isset($_SESSION['ID'])){
                echo ($currentfile == "logout.php") ? "<li>Log Out</li>" : "<li><a href='logout.php'>Log Out</a></li>";
            } else {
                echo ($currentfile == "login.php") ? "<li>Log In</li>" : "<li><a href='login.php'>Log In</a></li>";
            }
            if(isset($_SESSION['ID'])) {
                echo ($currentfile == "userselect.php") ? "<li>User List</li>" : "<li><a href='userselect.php'>User List</a></li>";
                echo ($currentfile == "rate.php") ? "<li>Rate Games</li>" : "<li><a href='rate.php'>Rate Games</a></li>";
                echo ($currentfile == "admin.php") ? "<li>Admin Page</li>" : "<li><a href='admin.php'>Admin Page</a></li>";
                }



            ?></ul></nav>
    <h1>GameTalk <img src = 'images/logo.jpg' alt='Controller Logo' width = 70 height = 50></h1>
</header>