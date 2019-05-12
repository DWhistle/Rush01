<?php
	session_start();
	$mysqli = new mysqli("localhost:3306", "root", "133113", "rush01");
	$id = $_POST["id"];
	$cell = $_POST["cell"];
	$mysqli->query("UPDATE `rooms` SET `$cell` = NULL WHERE `id`= $id; ");
	unset($_SESSION['room']);
	header("Location: /index.php");
