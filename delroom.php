<?php
	session_start();
	$id=$_SESSION['id'];
	$mysqli = new mysqli("localhost:3306", "root", "133113", "rush01");
	unset($_SESSION['room']);
	$mysqli->query("DELETE FROM `rooms` WHERE `id`= $id;");
