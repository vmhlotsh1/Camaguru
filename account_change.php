<?php
include_once ('config/database.php');
include_once 'error_checking.php';
include_once 'comment.php';
include_once ('config/session.php');


if (isset($_POST['save']) && isset($_SESSION['username'])){
        
        $form_errors = array();
        $required_fields = array('fname', 'lname', 'email', 'username', 'password');
        $form_errors = array_merge($form_errors, check_empty_fields($required_fields));
        $fields_to_check_length = array('username' => 4, 'password' => 6);
        $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));
        $form_errors = array_merge($form_errors, check_email($_POST));

        if (empty($form_errors)){
            
            $ID = $_SESSION['id'];
            $fname = htmlEntities($_POST['fname']);
            $lname = htmlEntities($_POST['lname']);
            $username = htmlEntities($_POST['username']);
            $email = htmlEntities($_POST['email']);
            $password = htmlEntities($_POST['password']);
            $email_pref = "false";
            if (isset($_POST['email_pref'])){
                $email_pref = "true";
            }
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            try{
        
                $stmt = $db->prepare('UPDATE users SET fname = :fname, lname = :lname, username = :username, email = :email, email_pref = :email_pref, password = :hashed_password WHERE ID = :ID');
                $stmt->bindParam(':fname',$fname);
                $stmt->bindParam(':lname',$lname);
			    $stmt->bindParam(':username',$username);
			    $stmt->bindParam(':email',$email);
                $stmt->bindParam(':email_pref', $email_pref);
			    $stmt->bindParam(':hashed_password',$hashed_password);
			    $stmt->bindParam(':ID',$ID);
                $stmt->execute();
                
                $mailbody = '
                Changes were Made to your account!
                
                Your account has been updated, you can login with the following new/old credentials depending on the changes you made to your account.
                ------------------------
                Username: '.$username.'
                Password: '.$password.'   
                ------------------------

                Thank you!';

                mail("$email", "www.noreply@camagru.com - Account updated", $mailbody);
   
                $result = "<p style='padding: 20px; color: green;'>Account was successfully updated!</p>";
            
            }catch (PDOException $er){
                $result = "<p style='padding: 20px; color: red'>An error occurred: ".$er->getMessage()." </p>";
            }
        }
        else{
            if(count($form_errors) == 1){
                $result = "<p style='color: red;'> There was 1 error in the form<br>";
            }else{
                $result = "<p style='color: red;'> There were " .count($form_errors). " error in the form <br>";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style/style.css" />
<title>Account Update</title>
</head>

<body >
    <header >
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
        <h1>Account Update</h1>
        <?php if(isset($result)) echo "<b>$result <b>" ?>
        <?php if(!empty($form_errors)) echo show_errors($form_errors); ?>
        <form class="Regform" method="POST">
            First name<br>
            <input type="text" name="fname" placeholder="First name" >
            <br>
            Last name<br>
            <input type="text" name="lname" placeholder="Last name">
            <br>
            Email<br>
            <input type="text" name="email" placehoder="E-mail">
            <br>
            Username<br>
            <input type="text" name="username" placeholder="Username">
            <br>
            Password<br>
            <input type="password" name="password" placehoder="Password">
            <br></br>
            <input type="checkbox" name="email_pref" value="Notify" style="height: 1.5vh; width: 1.5vw;">Do not send me emails</br></br>
            <button type="submit" name="save" value="save">Save</button>
        </form>    
    </div>

</body>
</html>