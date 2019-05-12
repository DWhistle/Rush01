<?php
if(isset($_POST['mess']) && $_POST['mess']!="" && $_POST['mess']!=" ")
{
	session_start();
	$mess=$_POST['mess'];
	$login=$_SESSION['login'];
	$mysqli = new mysqli("localhost:3306", "root", "133113", "rush01");
	if ($_SESSION['faction'] == 'Sith'){
		$color = 'red';
	} else if ($_SESSION['faction'] == 'Jedi'){
		$color = 'blue';
	} else if ($_SESSION['faction'] == 'Empire') {
		$color = 'black';
	} else if ($_SESSION['faction'] == 'Rebel') {
		$color = 'orange';
	}
	$mysqli->query("INSERT INTO `chat` (`login`,`message`,`color`) VALUES ('$login','$mess','$color') ");
}
