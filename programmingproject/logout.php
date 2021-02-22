<?php

/**
 * Class: csci303fa20
 * User: mlscott3
 * Date: 11/9/2020
 * Time: 1:35 PM
 */

session_start();
session_unset();
session_destroy();
header("Location: confirmation.php?state=1");