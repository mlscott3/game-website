<?php

/**
 * Class: csci303fa20
 * User: mlscott3
 * Date: 11/8/2020
 * Time: 6:58 PM
 */
$showform = 1;
$errmsg = 0;
$errfname = "";
$errlname = "";
$erremail = "";
$errpword = "";
$errcword = "";
$errteam = "";
$pagename ="Sign up";
require_once "include/head.php";
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
   // var_dump($_POST);
   // echo "<hr>";
   // print_r($_POST);
   // echo "<hr>";

    $fname = trim(strtolower($_POST['fname']));
    $lname = trim(strtolower($_POST['lname']));
    $email = trim(strtolower($_POST['email']));
    $pword = $_POST['pword'];
    $cword = $_POST['cword'];
    $team = $_POST['selteam'];

    $sql = "SELECT * FROM user_database WHERE email = ?";
    $emailexists = checkdup($pdo, $sql, $email);
    if ($emailexists) {
        $errmsg = 1; //update the general error flag
        $erremail .= " The email is taken.";
    }

    if (empty($fname)) {
        $errmsg = 1;
        $errfname = "Missing first name.";
    }
    if (empty($lname)) {
        $errmsg = 1;
        $errlname = "Missing last name.";
    }
    if (empty($email)) {
        $errmsg = 1;
        $erremail = "Missing email.";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) ){
            $errmsg = 1;
            $erremail = "Email is not valid.";
        }
    }
    if (empty($pword)) {
        $errmsg = 1;
        $errpword = "Missing password.";
    } else {
        if ($pword != $cword) {
            $errmsg = 1;
            $errpword = "Password does not match confirmed password.";
        }
    }
    if (empty($cword)) {
        $errmsg = 1;
        $errcword = "Missing confirmation password.";
    }
    if (empty($team)) {
        $errmsg = 1;
        $errteam = "Missing team selection.";
    }

    if ($errmsg == 1) {
        echo "<p class= 'error'>Oops! There are errors. Please make changes to your form and resubmit.</p>";
    }
    else {
        echo "<p class= 'success'>Now you're all signed up!</p>";
        $hpword = password_hash($pword, PASSWORD_DEFAULT);
        $cword = $hpword;
        $sql = "INSERT INTO user_database (fname, lname, email, password, team, date_accessed)
                VALUES (:fname, :lname, :email, :password, :team, :date_accessed)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':fname', $fname);
        $stmt->bindValue(':lname', $lname);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $hpword);
        $stmt->bindValue(':team', $team);
        $stmt->bindValue(':date_accessed', time());
        $stmt->execute();



        //Include Required Files - Need Autoloader
        require '../PHPMailer/PHPMailerAutoload.php';

//Create a new PHPMailer instance
        $mail = new PHPMailer();

//Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';

//Whether to use SMTP authentication
        $mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = 'ccucsciweb@gmail.com';

//Password to use for SMTP authentication
        $mail->Password = 'csci303&409';

//Set the encryption
        $mail->SMTPSecure = 'ssl';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 465;

//Set the subject line
        $mail->Subject = 'GameTalk Welcome message';

//Using HTML Email Body
        $mail->isHTML(true);

//Set the Message Body
        $mail->Body = '<p style="color: black">Welcome to GameTalk!</p>';

//Set who the message is to be sent from
        $mail->setFrom('ccucsciweb@gmail.com', 'CSCI 303 Class Email');

//Set who the message is to be sent to
        /*
         * CHANGE THE CODE BELOW TO YOUR EMAIL IN YOUR INITIAL TESTING!!!
         */
        $mail->addAddress($email, $fname);

//send the message, check for errors
        if ($mail->send()) {
            echo '<p class ="success">Email sent!</p>';
        } else {
            echo '<p class="error">Problems with sending the email.</p>';
        }

        $showform = 0;
    }
}

if ($showform == 1) {
    //QUERY THE DATABASE
    $sql = "SELECT consoleID, team FROM console ORDER BY team";

//EXECUTE THE QUERY TO GET THE RESULTS
    $result = $pdo->query($sql);

    ?>
    <p class ='text'> You new here? Well fill out the form below so you can get started today!</p>
    <div class = 'container'>
    <form name="usernew" id="usernew" method="post" action="<?php echo $currentfile; ?>">
        <div class ='first'>
        <label for="fname">First Name:</label>
        </div>
        <input type="text" name="fname" id="fname" size="40" maxlength="255" placeholder="First Name"
               value="<?php if (isset($fname)) {echo $fname;}?>">
        <?php if (!empty($errfname)) {echo "<span class= 'error'>$errfname</span>";} ?>
        <br>
        <div class="first">
        <label for="lname">Last Name:</label>
        </div>
        <input type="text" name="lname" id="lname" size="40" maxlength="255" placeholder="Last Name"
               value="<?php if (isset($lname)) {echo $lname;}?>">
        <?php if (!empty($errlname)) {echo "<span class= 'error'>$errlname</span>";} ?>
        <br>
        <div class="first">
        <label for="email">Email:</label>
        </div>
        <input type="email" name="email" id="email" size="40" maxlength="100" placeholder="Email"
               value="<?php if (isset($email)) {echo $email;}?>">
        <?php if (!empty($erremail)) {echo "<span class= 'error'>$erremail</span>";} ?>
        <br>
        <div class = "first">
        <label for="pword">Password:</label>
        </div>
        <input type="password" name="pword" id="pword" size="40" minlength="8"  maxlength="255" placeholder="Password"
               value="<?php if (isset($pword)) {echo $pword;}?>">
        <?php if (!empty($errpword)) {echo "<span class= 'error'>$errpword</span>";} ?>
        <br>
        <div class = "first">
        <label for="cword">Confirm Password:</label>
        </div>
        <input type="password" name="cword" id="cword" size="40" minlength="8" maxlength="255" placeholder="Confirm Password"
               value="<?php if (isset($cword)) {echo $cword;}?>">
        <?php if (!empty($errcword)) {echo "<span class= 'error'>$errcword</span>";} ?>
        <br>
        <label for="selteam">Select Team: </label>
        <select name="selteam">
            <option value="">Pick a team</option>
            <?php foreach($result as $row) : ?>
                <option value="<?= $row['consoleID'];?>"><?= $row['team']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <input type="submit" name="submit" id="submit" value="submit">
    </form>
    </div>
    <?php
}
require_once "include/foot.php";
?>