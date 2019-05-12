<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
	session_start();
	$id=$_SESSION['id'];
$mysqli = new mysqli($MY_DB['host'], $MY_DB['dblogin'],$MY_DB['dbpass'],$MY_DB['dbname']);
	unset($_SESSION['room']);
	$mysqli->query("DELETE FROM `rooms` WHERE  $id in (player1, player2, player3, player4);");
