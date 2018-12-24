<?php
	$DB_DSN = "mysql:host=localhost";
	$DB_USER = "root";
    $DB_PASSWORD = "123456";
    $DB_NAME = "camagru";

    try{
    	$db = new PDO($dsn, $username, $password);
    	//set pdo error mode to exception
    	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch (PDOException $ex){
    	echo "Connection failed".$ex->getMessage();
    }
?>
