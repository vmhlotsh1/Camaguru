<?php
include_once ('config/session.php');
include_once ('config/database.php');
include_once 'error_checking.php';

if (isset($_POST["verify"]) && !empty($_POST["link"]))
{
    $link = htmlEntities($_POST["link"]);
    $username = htmlEntities($_POST["username"]);
    $hash = htmlEntities($_GET["q"]);
    $query = $db->prepare('SELECT link FROM users WHERE username = :username');
    $query->execute(array(':username' => $username));
    $linkExists = $query->fetch(PDO::FETCH_ASSOC);
    $link_check = $linkExists['link'];

    if ($link_check != $link)
    {
        $result =  "<p style='color: red;'>Your password reset key is invalid.<\p>";
    }
    else {
        $query = $db->prepare("UPDATE users SET active = '1' WHERE link = :link");
        $query->execute(array(':link' => $link));
        $result = "<p style='color: green;'>Account is now active</p>";
    }
}
?>

<html>

<header>
    <link rel="stylesheet" type="text/css" href="style/style.css" />
    <title>Account Activation Page</title>
  <meta charset="utf-8">
  <title>Camaguru</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/styles.css">
<link href="https://fonts.googleapis.com/css?family=Muli%7CRoboto:400,300,500,700,900" rel="stylesheet"></head>
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

        <nav>
            <div class="main-wrapper">
            </div>
    </nav>
    </header>
    <link rel="stylesheet" type="text/css" href="style/style.css" />
    <title>Account Activation Page</title>
</head>

        <nav>
            <div class="main-wrapper">
            </div>
    </header>
        <center><div class="mainC">
        <h1>Account Activation</h1>
<?php if(isset($result)) echo "<b>$result <b>" ?>
<?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
        <?php echo '
        <form class="Regform" action="" method="POST">
            Username<br>
            <input type="text" name="username" placehoder="username">
            <br>
            Enter key sent to your in email<br>
            <input type="text" name="link" placehoder="E-mail">
            <br><br>
            <input type="hidden" name="q" value="';
            if (isset($_GET["q"])) {
                echo $_GET["q"];
            }
                echo '" /><input style="margin: 10px;" type="submit" name="verify" value=" Verify Activation " /></form>';
        ?>
    </div></center>
</body>
</html>