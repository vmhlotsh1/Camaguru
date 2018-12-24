<?php
include_once ('config/database.php');
include_once 'error_checking.php';
include_once ('config/session.php');
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/style.css" />
<title>My Account</title>
</head>

<body >
    <header>
    <div class="cat">
                        <ul>
                            <li class="name">CAMAGURU</li>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="gallery.php">Gallery</a></li>
                             <?php include_once('loga.php');?>
                        </ul>
                    </div>
    </header>
    <div class="mainC">
        <h1>My Account</h1>
        <?php if(isset($result)) echo "<b>$result <b>" ?>
        <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
        <?php
            $query = "
                SELECT fname, lname, username, email FROM users WHERE username = '".$_SESSION['username']."' ";

            try
            {
                $stmt = $db->prepare($query);
                $stmt->execute();
            }
            catch(PDOException $ex)
            {
                die("Failed to run query: " . $ex->getMessage());
            }
            $rows = $stmt->fetchAll();
        ?>
        </tr>
        <?php echo "$rows" ?>
        <?php echo "$row" ?>

    <?php foreach($rows as $row): ?>
        <tr>
            <td><?php echo "First Name:" ?></td></br>
            <td><?php echo htmlentities($row['fname'], ENT_QUOTES, 'UTF-8'); ?></td></br></br>
            <td><?php echo "Last Name:" ?></td></br>
            <td><?php echo htmlentities($row['lname'], ENT_QUOTES, 'UTF-8'); ?></td></br></br>
            <td><?php echo "Username:" ?></td></br>
            <td><?php echo htmlentities($row['username'], ENT_QUOTES, 'UTF-8'); ?></td></br></br>
            <td><?php echo "Email:" ?></td></br>
            <td><?php echo htmlentities($row['email'], ENT_QUOTES, 'UTF-8'); ?></td></br></br>
        </tr></br>
    <?php endforeach; ?>
    </div></br>

<button class="dropbtn" id="capture" id="botton-capture"><a href="acchg.php"><b>Edit Account</b></a></button>

</body>
</html>