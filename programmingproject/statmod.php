<?php

/**
 * Class: csci303fa20
 * User: mlscott3
 * Date: 12/2/2020
 * Time: 2:01 PM
 */
$pagename ="Modify Status";
require_once "include/head.php";
//SET INITIAL VARIABLES
$showform = 1;  // show form is true

if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['q'])){
    $ID = $_GET['q'];
}elseif ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['ID'])){
    $ID = $_POST['ID'];
}else {
    echo "<p class ='error'>Something Happened! Cannot obtain the correct entry.</p>";
    $errmsg = 1;
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $status = $_GET['status'];
    //query
    $sql = "UPDATE user_database SET STATUS = :status WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':status', $status);
    $stmt->bindValue(':ID', $ID);
    $stmt->execute();
//confirm for user.
    echo "<p>User status has been changed.  Return to <a href='select.php'>Select</a>.</p>";
//hide form
    $showform = 0;
}
if ($showform == 1) {
        $sql = "SELECT * FROM user_database WHERE ID = :ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":ID", $ID);
        $stmt->execute();
        $row = $stmt->fetch();
    ?>
    <p>Change this user's status by entering a 0 for user or 1 for admin.</p>
    <form name="statusmod" id="statusmod" method="post" action="<?php echo $currentfile; ?>">
       <input type = "number" id = "number" max="1" min="0" placeholder = "0" value ="<?php if (isset($status)) {echo $status;}?>">
        <input type="submit" id="modstat" name="modstat" value="submit">
    </form>

    <?php
}//showform
require_once "include/foot.php";
 