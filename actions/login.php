<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
global $MY_DB;
	session_start();
	if ($_GET["submit"] == "Login") {
		$log = strtolower($_GET["login"]);
		$mysqli = new mysqli($MY_DB['host'], $MY_DB['dblogin'],$MY_DB['dbpass'],$MY_DB['dbname']);
		$sql = "select * from game_users where login=\"".$log."\";";
		if ($row = $mysqli->query($sql)){
			$userinfo = $row->fetch_assoc();
			if ($userinfo["passwd"] == hash('sha512', $_GET["passwd"])) {
				$_SESSION["login"] = $_GET["login"];
				$_SESSION["passwd"] = $userinfo["passwd"];
				$_SESSION["faction"] = $userinfo["faction"];
				unset($_GET["submit"]);
				unset($_GET["login"]);
				unset($_GET["passwd"]);
				$mysqli->close();
				$_SESSION['message'] = "Приветствуем, ". $_SESSION["login"] . "!)";
				header("Location: /index.php");
				exit ;
			}
		}
		$mysqli->close();
		$_SESSION['message'] = "Неправильное имя пользователя или пароль! :(";
		header("Location: /index.php");
		exit ;
	}
	else if ($_GET["submit"] == "Logout") {
		session_destroy();
		header("Location: /index.php");
		exit ;
	}
?>
