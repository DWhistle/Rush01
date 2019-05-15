<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
session_start();
$hoome_url = "/actions";
$mysqli = new mysqli($MY_DB['host'], $MY_DB['dblogin'],$MY_DB['dbpass'],$MY_DB['dbname']);
if ($res = $mysqli->query("SELECT * FROM `rooms` ORDER BY `id` ")) {
    $s = "<table class=\"rooms\">
		<tr>
			<th>Room id</th>
			<th>Player1</th>
			<th>Player2</th>
			<th>Player3</th>
			<th>Player4</th>
		</tr>";
    echo $_SESSION['id'];


	while ($d = $res->fetch_array())
	{
        $s .= "<tr>";
        $s .= "<td>{$d['id']}</td>";
		for ($i = 1; $i <= 4; ++$i)
        {
            if ($_SESSION['id'] == $d["player1"] && $i == 1){
                $s.= "<td><form onsubmit=\"javascript:delroom();\">
				<input type=\"submit\" value=\"Delete\">
			</form></td>";
            } else {
                if ($d["player{$i}"] == $_SESSION['id']){
                    $s.= "<td><form action=\"$hoome_url/leave_room.php\" method=\"POST\">
				<input type=\"hidden\" name=\"cell\" value=\"player{$i}\">
				<input type=\"hidden\" name=\"id\" value=\"{$d["id"]}\">
				<input type=\"submit\" name=\"submit\" value=\"Leave\">
			</form></td>";
                } else if ($d["player{$i}"]){
                    $s.="<td>{$d["player{$i}"]}</td>";
                } else if (!isset($_SESSION['room'])){
                    $s.= "<td><form action=\"$hoome_url/join_room.php\" method=\"POST\">
				<input type=\"hidden\" name=\"cell\" value=\"player{$i}\">
				<input type=\"hidden\" name=\"id\" value=\"{$d["id"]}\">
				<input type=\"submit\" name=\"submit\" value=\"Join\">
			</form></td>";
                } else {
                    $s.="<td>Empty</td>";
                }
            }
        }
		$s.= "</tr>";
        if ($_SESSION['id'] == $d["player4"]
            || $_SESSION['id'] == $d["player1"]
            || $_SESSION['id'] == $d["player2"]
            || $_SESSION['id'] == $d["player3"])
        {
            $s.="<tr>
				<td colspan =\"5\">
				<form onsubmit=\"javascript:delroom();\">
				<input type=\"submit\" value=\"New game\">
				</form></td>
			</tr>";
        }
	}

    $s.= "</table>";
    echo $s;
}
