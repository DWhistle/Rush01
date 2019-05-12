<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
if(isset($_POST['mess']) && $_POST['mess']!="" && $_POST['mess']!=" ")
{
	session_start();
	$mess=$_POST['mess'];
	$login=$_SESSION['login'];
    $mysqli = new mysqli($MY_DB['host'], $MY_DB['dblogin'],$MY_DB['dbpass'],$MY_DB['dbname']);
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
