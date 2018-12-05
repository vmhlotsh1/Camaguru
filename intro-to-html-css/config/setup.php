<?php

   include 'database.php';
            //execute
            try
            {
                $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
                //Change this to a warning to PDO::ERRMODE_EXCEPTION
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
                $my_sql = "CREATE DATABASE IF NOT EXISTS $DB_NAME";
                $conn->exec($my_sql);
                echo "Successully created!!! (^^,)";
                $conn = null;
                $conn = new PDO("$DB_DSN;dbname=$DB_NAME" $DB_USER, $DB_PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

                //Creation of table
                $my_sql = "CREATE TABLE IF NOT EXISTS USERS (
                USER_ID INT(255) AUTO_INCREMENT PRIMARY KEY NOT NULL,
                USER_NAME VARCHAR(255) UNIQUE NOT NULL,
                 VARCHAR(30) NOT NULL,
                email VARCHAR(50),
                reg_date TIMESTAMP
                )";
            }

            //For errors
            catch
            {

            }
?>