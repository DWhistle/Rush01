<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
	session_start();
	$id=$_SESSION['id'];
    $mysqli = new mysqli($MY_DB['host'], $MY_DB['dblogin'],$MY_DB['dbpass'],$MY_DB['dbname']);
	$_SESSION['room'] = $id;
	$mysqli->query("INSERT INTO `rooms` (player1) VALUES ('$id')");
