<?php
include_once ('config/session.php');
include_once ('config/database.php');
include_once 'error_checking.php';


if (isset($_POST["send"])) {

    if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST["email"];

    }else{
        echo "email is not valid";
        exit;
    }

    $query = $db->prepare('SELECT email FROM users WHERE email = :email');
    $query->bindParam(':email', $email);
    $query->execute();
    $userExists = $query->fetch(PDO::FETCH_ASSOC);
    $db = null;



    if ($userExists["email"]){

        $salt = "498#2D83B631%3800EBD!801600D*7E3CC13";
        $password = hash('sha512', $salt.$userExists["email"]);
        $pwrurl = "http://localhost:8080/camagru/reset.php?q=".$password;
        $mailbody = "Dear user,\n\nIf this e-mail does not apply to you please ignore it. It appears that you have requested a password reset at our website www.camagru.com\n\nTo reset your password, please click the link below. If you cannot click it, please paste it into your web browser's address bar.\n\n" . $pwrurl . "\n\nThanks,\nAdmin";

        mail("$email", "www.noreply@camagru.com - Password Reset", $mailbody);
        $result = "<p style='color: green;'>Your password recovery key has been sent to your e-mail address.</p>";
    }
    else
        $result = "<p style='color: red;'>No user with that e-mail address exists.</p>";
}

?>


<!DOCTYPE html>
<html>
<header>

 <meta charset="utf-8">
  <title>Camaguru</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/styles.css">
<link href="https://fonts.googleapis.com/css?family=Muli%7CRoboto:400,300,500,700,900" rel="stylesheet">
  <body>

    <div class="main-nav">
        <ul class="nav">
          <li class="name">CAMAGURU</li>
          <li><a href="registration.php">Register</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <?php include_once('loga.php');?>
          <?php include_once('logb.php');?>
        </ul>
    </div>
<header>
<link rel="stylesheet" type="text/css" href="style/style.css" />
<title>Forgot Password Page</title>
</head>


        <nav>
            <div class="main-wrapper">

    </header>
    <center><div class="mainC">
        <h1>Enter your email to Reset password</h1>
<?php if(isset($result)) echo "<b>$result <b>" ?>
<?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
        <form class="Regform" action="" method="POST">
            Email<br>
            <input type="text" name="email" placehoder="email">
            <br><br>
            <button type="send" name="send" value="send">Send</button>
        </form>
    </div></center>
</body>
</html>