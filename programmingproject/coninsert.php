<?php

/**
 * Class: csci303fa20
 * User: mlscott3
 * Date: 12/5/2020
 * Time: 9:39 PM
 */

$showform = 1;
$errmsg = 0;
$pagename ="Add teams";
require_once "include/head.php";
?>
<?php
$_SESSION['ID'];
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $team = trim($_POST['team']);

    if (empty($team)) {
        $errmsg = 1;
        $errteam = "Missing team name.";
    }

    if ($errmsg == 1) {
        echo "<p class= 'error'>Oops! There are errors. Please make changes to your form and resubmit.</p>";
    }
    else {
        echo "<p class= 'success'>The new team has been added.</p>";

        $sql = "INSERT INTO console (userID, team)
                VALUES (:userID, :team)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':userID', $_SESSION['ID']);
        $stmt->bindValue(':team', $team);
        $stmt->execute();
        $showform = 0;
    }
}


if ($showform == 1) {

    ?>
    <form name="addteam" id="addteam" method="post" action="<?php echo $currentfile; ?>">
        <label for="team">Enter new Team:</label>
        <input type="text" name="team" id="team" size="40" maxlength="255" placeholder="Team Name"
               value="<?php if (isset($team)) {echo $team;}?>">
        <?php if (!empty($errteam)) {echo "<span class= 'error'>$errteam</span>";} ?>
        <br>
        <label for="submit">Submit</label>
        <input type="submit" name="submit" id="submit" value="submit">
    </form>

    <?php
}
require_once "include/foot.php";
?>