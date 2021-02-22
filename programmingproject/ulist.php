<?php

/**
 * Class: csci303fa20
 * User: mlscott3
 * Date: 11/10/2020
 * Time: 5:34 PM
 */


$showform = 1;
$pagename = "User List";
require_once "include/head.php";
if (isset($_GET['submit'])) {
    if (empty($_GET['term'])) {
        echo "<p class='error'>We'll need a term to search.</p>";
    } else {
        echo "<p> Searching for: <strong>" . htmlspecialchars($_GET['term']) . "</strong></p>";
        $term = trim($_GET['term']) . "%";

        $sql = "SELECT fname, lname FROM user_database WHERE fname LIKE :term";
        $stmt = $pdo->prepare($sql);
        $stmt->bindvalue(':term', $term);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($result)) {
            echo "<p class='error'>We couldn't find any results.</p>";
        } else {
            echo "<p class='success'>Your search results included the following:</p>";
            foreach ($result as $row) {
                echo $row['fname'] . " " . $row['lname'] . "<br>";
            }
            $showform = 0;
        }
    }
}

if($showform == 1) {
    ?>
    <p>Please enter in the beginning of the user's first or last name:</p>
    <form name="userlist" id="userlist" method="get" action="<?php echo $currentfile; ?>">
        <input type="text" name="term" id="term">
        <input type="submit" name="submit" id="submit" value="submit">
    </form>
    <?php
}
require_once "include/foot.php";
?>