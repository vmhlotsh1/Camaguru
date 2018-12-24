<?php

 include_once ('config/database.php');
 include_once 'comment.php';
 include_once ('config/session.php');
 include_once 'delete.php';
 date_default_timezone_set('Africa/Johannesburg');

 if (!isset($_SESSION['pageNum']))
    $_SESSION['pageNum'] = 0;

 if(isset($_GET["page"])){
     if ($_GET['page'] == "prev"){
         if ($_SESSION['pageNum'] != 0)
            $_SESSION['pageNum']= $_SESSION['pageNum'] -1;
     }else if ($_GET['page'] == "next"){
            $_SESSION['pageNum'] = $_SESSION['pageNum'] +1;

     }
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>camagru</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles.css">
	<link href="https://fonts.googleapis.com/css?family=Muli%7CRoboto:400,300,500,700,900" rel="stylesheet"></head>
<body>

<div class="main-nav">
	<ul class="nav">
		<li class="name">CAMAGRU</li>
		<li><a href="login.php">Login</a></li>
		<li><a href="registration/registration.php">Register</a></li>
		<li><a href="snap.php">Snap</a></li>
		<li><a href="#">Gallery</a></li>
	</ul>
</div>

 <header>
      <h1 class="tag name">Gallery Pictures.</h1>
  </header>
            /*<?php

                if ($_SESSION['pageNum'] == 0){
                    $stmt = $db->prepare("SELECT * FROM images LIMIT 5");
                    $stmt->execute();
                }
                else{
                    $stmt = $db->prepare("SELECT * FROM images LIMIT 5 OFFSET :offset");
                    $offset = ($_SESSION['pageNum'] * 5);
                    $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
                    $stmt->execute();
                }

                $images = $stmt->fetchAll(PDO::FETCH_ASSOC);


                foreach($images as $image)
                {

            ?>
                <?php
                    $stmt = ('SELECT * FROM likeimg WHERE POST = '.$image['ID'].';');
                    $stmt = $db->prepare($stmt);
                    $stmt->execute();
                    $likes = $stmt->rowCount();
                    ?>
                <?php
                    $sqlInsert = 'SELECT username FROM likeimg WHERE POST = :image';
                    $stmt = $db->prepare($sqlInsert);
                    $stmt->execute(array(
                        "image" => $image['ID']));
                    $row = $stmt->fetchAll();
                    $run_bool = 0;
                    foreach ($row as $users){
                        if (in_array($_SESSION['username'], $users))
                            $run_bool = 1;
                    }
                    ?>
                <div class=imageDiv>
                    <?php echo "Post by-".$image['username']?>
                <?php if ($_SESSION['username'] == $image['username']) {?>
                    <a class=del href="?delete_id=<?php echo $image['name']?>" action="delete.php" type='submit' name='delimg' style="float: right" onclick="return confirm('Are you sure you want to delete this image?')">Delete image</a>
                <?php } ?>
                    <a   href="<?php echo  $image['name']; ?>"><img class = "profilePic" src="<?php echo $image['name']; ?>"/>
                    </a>
              * <?php if ($_SESSION['username']) {?>
                    <?php
                        if ($run_bool == 0){
                    ?>

                    <a href="like.php?image=<?php echo $image['ID']?>"><img src="like.png"  height="30" width="30"/></a>
                    <?php }else{ ?>
                    <a href="like.php?image=<?php echo $image['ID']?>"><img src="like.png" height="30" width="30" class="grey"/></a>
                    <?php }?>
              * <?php }?>
                    <p class="lik"><?php echo $likes;?></p>
                    <?php if(isset($result)) echo $result; ?>
                    <?php
                    $sqlInsert = 'SELECT email FROM users WHERE username = :username';
                    $stmt = $db->prepare($sqlInsert);
                    $stmt->execute(array(
                        "username" => $image['username']));
                    $row = $stmt->fetchAll();
                    $email = isset($row[0]) ? $row[0]['email'] : '[deleted]';
                    ?>
                <?php if ($_SESSION['username']) {

                        echo "<form method='POST' action='comment.php'>
                                <textarea name='comment'></textarea>
                                <input type='hidden' name='POST' value='{$image["ID"]}'>
                                <input type='hidden' name='imgusr' value='{$image["username"]}'>
                                <input type='hidden' name='username' value='$username'>
                                <input type='hidden' name='email' value='$email'>
                                <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'><br>
                                <button type='submit' name='comSubmit' class = 'dropbtn'>Comment</button>
                              </form>"."<br>";

                               echo  "<div class='comDiv'>";
                                $stmt = ("SELECT * FROM comments WHERE POST = {$image['ID']};");
                                $stmt = $db->prepare($stmt);
                                $stmt->execute();

                                $com = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                foreach($com as $comment)
                                {
                                    echo "<div class='comBox'>";
                                        echo $comment['username']." ";
                                        //echo $image['ID']." ";
                                        echo $comment['date']."<br>";
                                        echo htmlspecialchars($comment['comment']);
                                    echo "</div>"."<br>";
                                }
                        echo "</div>";
                     }?>
                </div>
            <?php
                }
            ?>
            <div class="pages">
            <button class="dropbtn" id="prev" id="botton-capture"><a href="gallery.php?page=prev"><b><<</b></a></button>
            <button><?php echo $_SESSION['pageNum'];?></button>
            <button class="dropbtn" id="next" id="botton-capture"><a href="gallery.php?page=next"><b>>></b></a></button>
            </div>
    <script>
        function add1(element) {
            var xhtpp;
            var imgDiv = element.parentElement.parentElement;
            var output = imgDiv.querySelector("#output");

            output.value = parseInt(output.value,10) + 1;
            xhttp = new XMLHttpRequest();
            xhttp.open("POST", '/camagru/like.php');
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhttp.onreadystatechange = function() {
                if(xhttp.readyState == XMLHttpRequest.DONE && xhttp.status == 200) {

                }
            }
            xhttp.send("POST=0&likes=2");
        }

        function myFunction(x) {
            x.classList.toggle("like.png");
        }*/
    </script>
</div>
</body>
</html>