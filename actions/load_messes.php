<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
session_start();
$mysqli = new mysqli($MY_DB['host'], $MY_DB['dblogin'],$MY_DB['dbpass'],$MY_DB['dbname']);
if ($res = $mysqli->query("SELECT * FROM `chat` ORDER BY `id` ")){
	while ($d = $res->fetch_array())
	{
		echo "<b><font color='".$d['color']."'>".$d['login'].": </font></b>".$d['message']."<br>";
	}
}
