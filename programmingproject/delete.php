<?php

/**
 * Class: csci303fa20
 * User: mlscott3
 * Date: 12/2/2020
 * Time: 5:13 AM
 */
$pagename = "Delete";
require_once "include/head.php";
//SET INITIAL VARIABLES
$showform = 1;  // show form is true

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //query
    $sql = "DELETE FROM user_database WHERE ID = :ID";
//prepares a statement for execution
    $stmt = $pdo->prepare($sql);
//binds the actual values needed in the query
    $stmt->bindValue(':ID', $_POST['ID']);
//execute
    $stmt->execute();
//confirm for user.
    echo "<p>This user has been deleted.  Return to <a href='select.php'>Select</a>.</p>";
//hide form
    $showform = 0;
}
if ($showform == 1) {
    ?>
    <p>Are you sure you want to delete this user?</p>
    <form name="deleteuser" id="deleteuser" method="post" action="<?php echo $currentfile; ?>">
        <input type="hidden" id="ID" name="ID" value="<?php echo $_GET['q']; ?>">
        <input type="hidden" id="lname" name="lname" value="<?php echo $_GET['l']; ?>">
        <input type="submit" id="delete" name="delete" value="YES">
        <input type="button" id="nodelete" name="nodelete" value="NO" onClick="window.location='select.php'">
    </form>

    <?php
}//showform
require_once "include/foot.php";
 