<?php
	$DB_DSN = "localhost";
	$DB_USER = "root";
    $DB_PASSWORD = "123456";
    $DB_NAME = "camagru";

    try{
    	$db = new PDO("mysql:host=$DB_DSN;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);
    	//set pdo error mode to exception
    	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch (PDOException $ex){
    	echo "Connection failed".$ex->getMessage();
    }
?>
