<?php
     include_once ('config/session.php');

       if(($_SESSION['username'])){
        echo "<li> <a href='camera.php'>Camera</a></li>
       <li class='logA'> <a href='account.php' style='color: green;'>Profile</a></li>
       <li class='logA'> <a href='logout.php' style='color: red;'>Logout</a></li></br>";
       }
?>