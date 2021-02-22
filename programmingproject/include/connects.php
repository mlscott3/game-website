<?php

/**
 * Class: csci303fa20
 * User: mlscott3
 * Date: 11/8/2020
 * Time: 7:37 PM
 */

$connString ="mysql:host=localhost;dbname=303mlscott3";
$user ="303mlscott3";
$pass ="csci0322";
$pdo =new PDO($connString, $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
