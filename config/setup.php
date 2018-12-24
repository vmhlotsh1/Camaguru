/*<?php

include_once ('database.php');
$user = 'root';
$password = '123456';
$dsn = 'mysql:host=localhost';
try{
	$concreate = new PDO($dsn, $user, $password);

	$concreate->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e){
	echo '<h3>Connection Failed '.$e->getMessage().'</h3>';
}

$create = "CREATE DATABASE IF NOT EXISTS `camagru`";
$create_stmt = $concreate->prepare($create);

$create_stmt->execute();
$table = "CREATE TABLE IF NOT EXISTS `comments` (
	`ID` int(11) NOT NULL AUTO_INCREMENT,
	`POST` int(11) NOT NULL,
    `comment` text NOT NULL,
    `username` varchar(255) NOT NULL,
	`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";
$table_stmt = $db->prepare($table);
//$table_stmt->execute();

$table = "CREATE TABLE IF NOT EXISTS `image` (
	`ID` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`username` varchar(255) NOT NULL,
    `edit_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

$table_stmt = $db->prepare($table);
//$table_stmt->execute();

$table = "CREATE TABLE IF NOT EXISTS `likeimg` (
	`ID` int(11) NOT NULL AUTO_INCREMENT,
	`username` varchar(100) NOT NULL,
    `POST` int(11) NOT NULL,
	`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";

$table_stmt = $db->prepare($table);
//$table_stmt->execute();

$table = "CREATE TABLE IF NOT EXISTS `users` (
    `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    `fname` varchar(50) NOT NULL,
    `lname` varchar(50) NOT NULL,
    `username` varchar(50) NOT NULL,
    `email` varchar(60) NOT NULL,
    `password` varchar(255) NOT NULL,
    `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `active` int(1) DEFAULT '0',
    `link` varchar(255)  NULL,
    `email_pref` varchar(6) DEFAULT 'true',
	PRIMARY KEY (`ID`),
	UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
";
$table_stmt = $db->prepare($table);
//$table_stmt->execute();
?>*/

<?php
include_once ('database.php');
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "camagru";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $create = "CREATE DATABASE IF NOT EXISTS camagru";
    $create_stmt = $concreate->prepare($create);

    // sql to create table for users
    $sql_users = "CREATE TABLE IF NOT EXISTS Users (
    ID int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
    fname varchar(50) NOT NULL,
    lname varchar(50) NOT NULL,
    username varchar(50) NOT NULL,
    email varchar(60) NOT NULL,
    password varchar(255) NOT NULL,
    join_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    active int(1) DEFAULT '0',
    link varchar(255)  NULL,
    email_pref varchar(6) DEFAULT 'true',
    PRIMARY KEY (`ID`),
    UNIQUE KEY username (`username`)
    )";

    // sql to create table for comments
    $sql_comments = "CREATE TABLE IF NOT EXISTS Comments (
    ID int(11) NOT NULL AUTO_INCREMENT,
    POST int(11) NOT NULL,
    comment text NOT NULL,
    username varchar(255) NOT NULL,
    date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`ID`)
    )";

    //sql to create table for liking images
    $sql_images = "CREATE TABLE IF NOT EXISTS Likes (
    ID int(11) NOT NULL AUTO_INCREMENT,
    username varchar(100) NOT NULL,
    POST int(11) NOT NULL,
    date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`ID`)
    )";

    //sql to create table for super liking images
    $sql_super = "CREATE TABLE IF NOT EXISTS Super_Likes (
    ID int(11) NOT NULL AUTO_INCREMENT,
    username varchar(100) NOT NULL,
    POST int(11) NOT NULL,
    date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`ID`)
    )";

    //sql to create table for super images
    $sql_images = "CREATE TABLE IF NOT EXISTS Images (
    ID int(11) NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    username varchar(255) NOT NULL,
    edit_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`ID`)
    )";

    // use exec() because no results are returned
    $conn->exec($sql_users);
    $conn->exec($sql_comments);
    $conn->exec($sql_images);
    $conn->exec($sql_super);
    $conn->exec($sql_images);

    echo "Table for Users created successfully";
    }
catch(PDOException $e)
    {
    echo $sql_users . "<br>" . $e->getMessage();
    }

$conn = null;
?>