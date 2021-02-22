<?php

/**
 * Class: csci303fa20
 * User: mlscott3
 * Date: 12/6/2020
 * Time: 12:11 AM
 */
$pagename = "User Query";
require_once "include/head.php";
$errmsg = 0;
$errselteam = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $selteam = $_POST['selteam'];

    if(empty($selteam)) {
        $errselteam = "<span class ='error'>The select box is required.</span>";
        $errmsg = 1;
    }
    if ($errmsg == 1) {
        echo "<p class= 'error'>Oops! There are errors. Please make changes to your form and resubmit.</p>";
    }
    else {
        echo "<p class= 'success'>Thanks for choosing a team!</p>";
        $showform = 0;
    }
}


//QUERY THE DATABASE
$sql = "SELECT consoleID, team FROM console ORDER BY team";

//EXECUTE THE QUERY TO GET THE RESULTS
$result = $pdo->query($sql);
?>
<formname="filltest" id="filltest" method="post" action="<?php echo $currentfile; ?>">
<?php
if (isset($errselteam)) {
    echo $errselteam . "<br>";
}
?>
    <select name="selteam" id="selteam">
        <option value="" <?php if (isset($selteam) && $selteam == "") {
            echo "selected";
        }
        ?>>Pick a Team</option>
        <?php foreach($result as $row) : ?>
            <option value="<?= $row['consoleID'];?>"><?= $row['team']; ?></option>
        <?php endforeach; ?>

    </select>
    <input type="submit" name="submit" id="submit" value="submit">
</form>
<?php
require_once "include/foot.php";
 