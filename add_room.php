<?php
	session_start();
	$id=$_SESSION['id'];
	$mysqli = new mysqli("localhost:3306", "root", "133113", "rush01");
	$_SESSION['room'] = $id;
	$mysqli->query("INSERT INTO `rooms` (`id`) VALUES ('$id')");
