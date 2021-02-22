<?php

/**
 * Class: csci303fa20
 * User: mlscott3
 * Date: 11/10/2020
 * Time: 9:02 PM
 */

$showform = 1;
$errmsg = 0;
$erremail = "";

$pagename = "Update Users";
require_once "include/head.php";

if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['q'])){
    $ID = $_GET['q'];
}elseif ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['ID'])){
    $ID = $_POST['ID'];
}
else {
    echo "<p class ='error'>Something Happened! Cannot obtain the correct entry.</p>";
    $errmsg = 1;
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = trim(strtolower($_POST['email']));
    $team = trim($_POST['console_choice']);
    if (empty($email)) {
        $errmsg = 1;
        $erremail = "Missing email";
    }else{
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errmsg = 1;
            $erremail = "The email is not valid.";
        }elseif ($email != $_POST['origemail']) {
            $sql = "SELECT * FROM user_database WHERE email = ?";
            $emailexsists = checkdup ($pdo, $sql, $email);
            if($emailexsists) {
                $errmsg = 1;
                $erremail = "The email is taken";
            }
        }
    }
    if($errmsg == 1) {
        echo "<p class='error'>There are errors. Please make changes to your form and resubmit.</p>";
    }
    else {
        echo "<p class='success'>Thanks for updating your information</p>";

        $sql = "UPDATE user_database SET EMAIL = :email WHERE ID = :ID";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':ID', $ID);
        $stmt->execute();

        $showform = 0;
    }
}
if ($showform == 1){
    //QUERY THE DATABASE
    $sql = "SELECT consoleID, team FROM console ORDER BY team";

//EXECUTE THE QUERY TO GET THE RESULTS
    $result = $pdo->query($sql);


    $sql = "SELECT * FROM user_database WHERE ID = :ID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":ID", $ID);
    $stmt->execute();
    $row = $stmt->fetch();
    ?>
<p class = 'text'>All fields are required.</p>
<form name ="updateuser" id="updateuser" action ="<?php echo $currentfile;?>" method="post">
    <label for="email">Email: </label>
    <input type="email" id="email" name="email" placeholder="Enter email" value ="<?php if(isset($email)) {echo removehtml($email);} else{echo removehtml($row['email']);}?>">

    <?php if(!empty($erremail)) {echo "<span class = 'error'>$erremail</span>";} ?>
    <br>
    <input type="hidden" name="ID" value="<?php echo $row['ID'];?>">
    <input type="hidden" name="origemail" value="<?php echo $row['email'];?>">
    <label for="selteam">Select Team: </label>
    <select>
        <option value="">Pick a team</option>
        <?php foreach($result as $row) : ?>
            <option value="<?= $row['consoleID'];?>"><?= $row['team']; ?></option>
        <?php endforeach;if(isset($team)) {echo removehtml($team);} else{echo removehtml($row['console_choice']); ?>
    </select>
    <label for="submit">Submit: </label>
    <input type ="submit" id="submit" name="submit" value="submit">
</form>
<?php
}
require_once "include/foot.php";
?>
