<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/class/Player.class.php');

    $mysqli = new mysqli($MY_DB['host'], $MY_DB['dblogin'],$MY_DB['dbpass'],$MY_DB['dbname']);
	$id = $_POST["id"];

    $player_id = $_SESSION['id'];
    $id = $_POST["id"];
    $cell = $_POST["cell"];
	$mysqli->query("UPDATE `rooms` SET `$cell`= {$player_id} WHERE id = $id;");
    $_SESSION['room'] = $id;
	header("Location: /index.php");
	exit();