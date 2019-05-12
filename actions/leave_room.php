<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
	session_start();
    $mysqli = new mysqli($MY_DB['host'], $MY_DB['dblogin'],$MY_DB['dbpass'],$MY_DB['dbname']);
	$id = $_POST["id"];
	$cell = $_POST["cell"];
	$mysqli->query("UPDATE `rooms` SET `$cell` = NULL WHERE `id`= $id; ");
	unset($_SESSION['room']);
	header("Location: /index.php");
