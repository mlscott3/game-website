<?php

/**
 * Class: csci303fa20
 * User: mlscott3
 * Date: 11/9/2020
 * Time: 1:35 PM
 */

$pagename = "Login";
$showform = 1;
$errormsg ="";
$erremail= "";
$errpword= "";
$hpword = "";
require_once "include/head.php";

if(isset($_SESSION['ID'])){
    echo "<p class = 'error'> You are already logged in.</p>";
    include_once "include/foot.php";
    exit();
}
if(isset($_POST['submit'])){
    $formfield['email'] = strtolower(trim($_POST['email']));
    $formfield['pword'] = trim($_POST['pword']);

    if (empty($formfield['email'])){$errormsg .= "<p>Email is missing.</p>";}
    if (empty($formfield['pword'])){$errormsg .= "<p>Password is missing.</p>";}

    if($errormsg !="") {
        echo "<div class = 'error'><p>There are errors: <br> " . $errormsg . "</p></div>";
    }
    else {
        try {
            $sqllogin = "SELECT * FROM user_database WHERE email = :email";
            $slogin = $pdo->prepare($sqllogin);
            $slogin->bindValue(':email', $formfield['email']);
            $slogin->execute();
            $rowlogin = $slogin->fetch();
            $countlogin = $slogin->rowCount();

            if($countlogin < 1){
                echo "<p class='error'>This user cannot be found.</p>";
            }
            else {
                if(password_verify($formfield['pword'], $rowlogin['password'])) {
                    $_SESSION['ID']= $rowlogin['ID'];
                    $_SESSION['email']= $rowlogin['email'];
                    $_SESSION['fname']= $rowlogin['fname'];
                    $showform = 0;
                    header("Location: confirmation.php?state=2");
                }
                else{
                    echo "<p class='error'>The email and password combination you entered isn't right.</p>";
                }
            }
        }
        catch (PDOException $e) {
            echo 'Error fetching users: ' . $e->getMessage();
            exit();
        }
    }
}



if ($showform == 1) {
    ?>
        <p class = "text"> Login to see more content!</p>
    <div class = 'container'>
<form name="usernew" id="usernew" method="post" action="<?php echo $currentfile; ?>">
    <div class ='first'>
    <label for="email">Email:</label>
    </div>
    <input type="email" name="email" id="email" size="40" maxlength="100" placeholder="Email"
           value="<?php if (isset($email)) {echo $email;}?>">
    <?php if (!empty($erremail)) {echo "<span class= 'error'>$erremail</span>";} ?>
    <br>
    <div class ='first'>
    <label for="pword">Password:</label>
    </div>
    <input type="password" name="pword" id="pword" size="40" minlength="8"  maxlength="255" placeholder="Password"
           value="<?php if (isset($pword)) {echo $pword;}?>">
    <?php if (!empty($errpword)) {echo "<span class= 'error'>$errpword</span>";} ?>
    <br>
    <input type="submit" name="submit" id="submit" value="submit">
</form>
    </div>
    <?php
}
require_once "include/foot.php";
?>