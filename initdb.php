<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
global $MY_DB;
	$mysqli = new mysqli($MY_DB['host'], $MY_DB['dblogin'],$MY_DB['dbpass'],$MY_DB['dbname']);
	if (!$mysqli) {
		die("Connection failed: " . $mysqli->connect_error);
	}
	$sql = "CREATE DATABASE `rush01`;";
	if ($mysqli->query($sql) === TRUE){
		echo "Database successfully created";
	}
	else {
		echo 'Error: '. $mysqli->error;
	}
	$mysqli->select_db("rush01");
	$sql = "CREATE TABLE game_users (";
	$sql .= " `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,";
	$sql .= " `login` VARCHAR(20) NOT NULL,";
	$sql .= " `passwd` VARCHAR(128) NOT NULL,";
	$sql .= " `faction` VARCHAR(20) NOT NULL,";
	$sql .= " `creation_date` DATETIME NOT NULL,";
	$sql .= " `gameinfo` VARCHAR(20000) NOT NULL);";
	if ($mysqli->query($sql) === TRUE){?>
		<p>Login table successfully created;</p>
	<?}
	else {?>
		<p> <?echo "Error: ". $mysqli->error; ?></p>
	<?}
	$sql = "CREATE TABLE  `rooms` (";
	$sql .= " `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,";
	$sql .= " `login1` VARCHAR(20),";
	$sql .= " `login2` VARCHAR(20),";
	$sql .= " `login3` VARCHAR(20));";
	if ($mysqli->query($sql) === TRUE){?>
		<p>Rooms table successfully created;</p>
	<?}
	else {?>
		<p> <?echo "Error: ". $mysqli->error; ?></p>
	<?}
	$sql = "CREATE TABLE  `chat` (";
	$sql .= " `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,";
	$sql .= " `login` VARCHAR(20) NOT NULL,";
	$sql .= " `message` VARCHAR( 1000 ) NOT NULL,";
	$sql .= " `color` VARCHAR(20) NOT NULL);";
	if ($mysqli->query($sql) === TRUE){?>
		<p>Chat table successfully created</p>
	<?}
	else {?>
		<p> <?echo "Error: ". $mysqli->error; ?></p>
	<?}
	$mysqli->close();
