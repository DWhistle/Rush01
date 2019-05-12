<?php
		date_default_timezone_set('europe/moscow');
		if ($_POST["submit"] == "Register")
		{
			$log = strtolower($_POST["login"]);
			$mysqli = new mysqli($MY_DB['host'], $MY_DB['user'], $MY_DB['pass'], $MY_DB['db_name']);
			$sql = "select id from game_users where login=\"".$log."\";";
			if ($mysqli->query($sql)->num_rows != 0){
				$mysqli->close();
				$_SESSION['message'] = "Пользователь с таким именем уже существует! :(";
				header("Location: /index.php");
				exit();
			}
			$sql = "INSERT INTO game_users (`login`, `passwd`, `faction`, `creation_date`) VALUES (\"";
			$sql .= $log . "\", \"";
			$sql .= hash('sha512', $_POST["passwd"]) . "\", \"";
			$sql .= $_POST["faction"] . "\", \"";
			$sql .= date("Y-m-d H:i:s");
			$sql .= "\");";
			if ($mysqli->query($sql) === TRUE){
				$mysqli->close();
				$_SESSION['message'] = "Акаунт успешно создан!";
				header("Location: /index.php");
			}
			else {
				echo "Error: ". $mysqli->error;
				$mysqli->close();
			}
			exit();
		}
		else {
			$_SESSION['message'] = "Неправильное имя пользователя или пароль! :(";
			header("Location: /index.php");
			exit();
		}