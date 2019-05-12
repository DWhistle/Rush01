<?php
	session_start();
	$mysqli = new mysqli("localhost:3306", "root", "133113", "rush01");
	$id = $_POST["id"];
	$_SESSION['room'] = $id;
	$login = $_SESSION['login'];
	$cell = $_POST["cell"];
	$mysqli->query("UPDATE `rooms` SET `$cell` = '$login' WHERE `id`= $id; ");
	header("Location: /index.php");
