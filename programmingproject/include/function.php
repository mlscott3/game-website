<?php

/**
 * Class: csci303fa20
 * User: mlscott3
 * Date: 11/8/2020
 * Time: 7:04 PM
 */

function checkdup($pdo, $sql, $field) {
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $field);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function removehtml ($field) {
    return htmlspecialchars($field, ENT_QUOTES, "UTF-8");
}
function checkLogin()
{
    if (!isset($_SESSION['ID'])) {
        echo "<p class='error'>This page requires authentication.  Please log in to view details.</p>";
        require_once "foot.php";
        exit();
    }
}
function checkAdmin()
{
    if (isset($_SESSION['status'])!=1) {
        echo "<p class='error'>This page requires you to be an admin.</p>";
        require_once "foot.php";
        exit();
    }
}