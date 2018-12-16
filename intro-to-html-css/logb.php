<?php
 include_once ('config/session.php');

    if(!($_SESSION['username'])){
        echo "<li class='logA'> <a href='login.php' style='color: green;'>Login</a></li>";
    }
?>