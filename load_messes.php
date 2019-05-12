<?php
session_start();
$mysqli = new mysqli("localhost:3306", "root", "133113", "rush01");
if ($res = $mysqli->query("SELECT * FROM `chat` ORDER BY `id` ")){
	while ($d = $res->fetch_array())
	{
		echo "<b><font color='".$d['color']."'>".$d['login'].": </font></b>".$d['message']."<br>";
	}
}
