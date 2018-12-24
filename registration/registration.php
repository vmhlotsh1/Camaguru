<?php
include_once ('config/database.php');
include_once 'error_checking.php';

    if (isset($_POST['submit'])){

        $form_errors = array();
        $required_fields = array('fname', 'lname', 'email', 'username', 'password');
        $form_errors = array_merge($form_errors, check_empty_fields($required_fields));
        $fields_to_check_length = array('username' => 4, 'password' => 6);
        $form_errors = array_merge($form_errors, check_min_length($fields_to_check_length));
        $form_errors = array_merge($form_errors, check_email($_POST));
        if (empty($form_errors)){

            $fname = htmlEntities($_POST['fname']);
            $lname = htmlEntities($_POST['lname']);
            $username = htmlEntities($_POST['username']);
            $email = htmlEntities($_POST['email']);
            $pass = htmlEntities($_POST['password']);
            if ((preg_match('/.{6,100}/', $pass) == 0) || (preg_match('/[0-9]/', $pass) == 0) || (preg_match('/[a-zA-Z]/', $pass) == 0))
            {
                $result = "<p style='padding: 20px; color: red'>Password must contain atleast one digit: </p>";
            }
            else{
                $password = $pass;
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            try{

                $sqlInsert = "INSERT INTO users (fname, lname, username, email, password, join_date)
                    VALUES (:fname, :lname, :username, :email, :password, now())";

                $statement = $db->prepare($sqlInsert);
                $statement->execute(array(
                'fname' => $fname,
                'lname' => $lname,
                ':username' => $username,
                ':email' => $email,
                ':password' => $hashed_password
                ));

$salt = bin2hex(openssl_random_pseudo_bytes(16));
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$code = substr(str_shuffle($chars), 0, 35);
$link = "http://localhost:8080/camagru/verify.php?q=".$code;
$mailbody = '
Thanks for signing up to camagru!

Your account has been created, you can login with the following credentials after you have activated your account with the key code
provided below, use the link to connect you to the code fill in form.
------------------------
Username: '.$username.'
Password: '.$password.'
Key     : '.$code.'
------------------------

Please click/copy and paste this
link to submit the Key provided above:
key::'.$link.'';

mail("$email", "noreply@camagru - Account Activation", $mailbody);


$query = $db->prepare('UPDATE users SET link = :link WHERE username = :username');
$query->bindParam(':link', $code);
$query->bindParam(':username', $username);
$query->execute();

if ($statement->rowCount() == 1){
$result = "<p style='padding: 20px; color: green;'>Please check your Email to verify your account</p>";
}
}catch (PDOException $er){
$result = "<p style='padding: 20px; color: red'>An error occurred: ".$er->getMessage()." </p>";
}
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
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">
    <title>Register Form</title>


    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">


    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">


    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Registration Form</h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-row m-b-55">
                            <div class="name">Name</div>
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="first_name">
                                            <label class="label--desc">first name</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="last_name">
                                            <label class="label--desc">last name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Username</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="company">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" name="email">
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn--radius-2 btn--red" type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="vendor/jquery/jquery.min.js"></script>

    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>


    <script src="js/global.js"></script>

</body>

</html>
