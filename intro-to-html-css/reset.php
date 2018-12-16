<?php

include_once ('config/session.php');
include_once ('config/database.php');
include_once 'error_checking.php';

if (isset($_POST["Reset"]) && !empty($_POST["password"]) && !empty($_POST["cpassword"]))
{

    $email = htmlEntities($_POST["email"]);
    $password = htmlEntities($_POST["password"]);
    $cpassword = htmlEntities($_POST["cpassword"]);
    $hash = $_GET["q"];
    $salt = "498#2D83B631%3800EBD!801600D*7E3CC13";

    $resetkey = hash('sha512', $salt.$email);
    if ($resetkey == $hash)
    {
        if ($password == $cpassword)
        {
            $password = password_hash($password, PASSWORD_BCRYPT);

                $query = $db->prepare('UPDATE users SET password = :password WHERE email = :email');
                $query->bindParam(':password', $password);
                $query->bindParam(':email', $email);
                $query->execute();
                $db = null;
            $result = "<p style='color: green;'>Your password has been successfully reset.</p>";
        }
        else
            $result =  "<p style='color: red;'>Your password's do not match.</p>";
    }
    else
        $result =  "<p style='color: red;'>Your password reset key is invalid.<\p>";
}

?>



<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/style.css" />
<title>Reset Page</title>
</head>

<body >
    <header class="Pix">
        <nav>
        <div class="cat">
                        <ul>
                            <li class="name">CAMAGURU</li>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="gallery.php">Gallery</a></li>
                            <?php include_once('logb.php');?>
                            <?php include_once('loga.php');?>
                        </ul>
                    </div>
        <h1>Reset Password</h1>
<?php if(isset($result)) echo "<b>$result <b>" ?>
<?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
        <?php echo '
        <form class="Regform" action="" method="POST">
            Email<br>
            <input type="text" name="email" placehoder="E-mail">
            <br>
            New Password<br>
            <input type="password" name="password" placeholder="Password">
            <br>
            Confirm Password<br>
            <input type="password" name="cpassword" placehoder="Password">
            <br><br>
            <input type="hidden" name="q" value="';
            if (isset($_GET["q"])) {
                echo $_GET["q"];
            }
                echo '" /><input type="submit" name="Reset" value=" Reset Password " />
        </form>';
        ?>
    </div></center>
<p>
</body>
</html>