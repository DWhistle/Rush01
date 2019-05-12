<?php
session_start();
$mysqli = new mysqli("localhost:3306", "root", "133113", "rush01");
if ($res = $mysqli->query("SELECT * FROM `rooms` ORDER BY `id` ")){
	while ($d = $res->fetch_array())
	{
		$s = "<table class=\"rooms\">
		<tr>
			<th>Room id</th>
			<th>Player1</th>
			<th>Player2</th>
			<th>Player3</th>
		</tr>
		<tr>";
		if ($_SESSION['id'] == $d["id"]){
			$s.= "<td><form onsubmit=\"javascript:delroom();\">
				<input type=\"submit\" value=\"Delete\">
			</form></td>";
		} else {
			$s.= "<td>{$d["id"]}</td>";
		}
		if ($d["login1"] == $_SESSION['login']){
			$s.= "<td><form action=\"leave_room.php\" method=\"POST\">
				<input type=\"hidden\" name=\"cell\" value=\"login1\">
				<input type=\"hidden\" name=\"id\" value=\"{$d["id"]}\">
				<input type=\"submit\" name=\"submit\" value=\"Leave\">
			</form></td>";
		} else if ($d["login1"]){
			$s.="<td>{$d["login1"]}</td>";
		} else if (!isset($_SESSION['room'])){
			$s.= "<td><form action=\"join_room.php\" method=\"POST\">
				<input type=\"hidden\" name=\"cell\" value=\"login1\">
				<input type=\"hidden\" name=\"id\" value=\"{$d["id"]}\">
				<input type=\"submit\" name=\"submit\" value=\"Join\">
			</form></td>";
		} else {
			$s.="<td>Empty</td>";
		}
		if ($d["login2"] == $_SESSION['login']){
			$s.= "<td><form action=\"leave_room.php\" method=\"POST\">
				<input type=\"hidden\" name=\"cell\" value=\"login2\">
				<input type=\"hidden\" name=\"id\" value=\"{$d["id"]}\">
				<input type=\"submit\" name=\"submit\" value=\"Leave\">
			</form></td>";
		} else if ($d["login2"]){
			$s.="<td>{$d["login2"]}</td>";
		} else if (!isset($_SESSION['room'])){
			$s.= "<td><form action=\"join_room.php\" method=\"POST\">
				<input type=\"hidden\" name=\"cell\" value=\"login2\">
				<input type=\"hidden\" name=\"id\" value=\"{$d["id"]}\">
				<input type=\"submit\" name=\"submit\" value=\"Join\">
			</form></td>";
		} else {
			$s.="<td>Empty</td>";
		}
		if ($d["login3"] == $_SESSION['login']){
			$s.= "<td><form action=\"leave_room.php\" method=\"POST\">
				<input type=\"hidden\" name=\"cell\" value=\"login3\">
				<input type=\"hidden\" name=\"id\" value=\"{$d["id"]}\">
				<input type=\"submit\" name=\"submit\" value=\"Leave\">
			</form></td>";
		} else if ($d["login3"]){
			$s.="<td>{$d["login3"]}</td>";
		} else if (!isset($_SESSION['room'])){
			$s.= "<td><form action=\"join_room.php\" method=\"POST\">
				<input type=\"hidden\" name=\"cell\" value=\"login3\">
				<input type=\"hidden\" name=\"id\" value=\"{$d["id"]}\">
				<input type=\"submit\" name=\"submit\" value=\"Join\">
			</form></td>";
		} else {
			$s.="<td>Empty</td>";
		}
		$s.="</tr>";
		if ($_SESSION['id'] == $d["id"] || $_SESSION['login'] == $d["login1"] || $_SESSION['login'] == $d["login2"] || $_SESSION['login'] == $d["login3"]){
		$s.="<tr>
				<td colspan =\"4\"><form onsubmit=\"javascript:delroom();\">
				<input type=\"submit\" value=\"New game\">
				</form></td>
			</tr>";
		}
		$s.= "</table>";
		echo $s;
	}
}
