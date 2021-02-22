<?php

/**
 * Class: csci303fa20
 * User: mlscott3
 * Date: 11/18/2020
 * Time: 3:13 PM
 */

$pagename ="Rate Games";
$showform = 1;
$errmsg = 0;
$errtxtarea = "";
require_once "include/head.php";
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
$txtarea = trim($_POST['txtarea']);

if(empty($txtarea)) {
    $errtxtarea = "<span class ='error'>You have to fill out the textarea.</span>";
    $errmsg = 1;
}
    if ($errmsg == 1) {
        echo "<p class= 'error'>Oops! There are errors. Please make changes to your form and resubmit.</p>";
    }
    else {
        echo "<p class= 'success'>Thanks for rating!</p>";
        echo $txtarea;
        $showform = 0;
    }
}
if ($showform == 1) {

    ?>
    <form name="rategame" id="rategame" action="<?php echo $currentfile; ?>" method="post">
        <?php
        if (isset($errtxtarea)) {
            echo $errtxtarea . "<br>";
        }
        ?>
        <div class = first>
        <label for="txtarea">Make your ratings here:</label>
        </div>
        <textarea name="txtarea" id="txtarea">
        </textarea>
        <input type="submit" name="submit" id="submit" value="submit">
    </form>

    <?php
}
require_once "include/foot.php";
?>