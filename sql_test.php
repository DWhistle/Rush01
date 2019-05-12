<?php
//require_once ('./dbconfig.php');
$host = 'ox-e5';
$dbname = 'rush01';
$username = 'rush01';
$password = 'ft_pass_123';
try {
	$conn = new mysqli($host, $username, $password);
	echo "Connected to $dbname at $host successfully.";
} catch (PDOException $pe) {
	die("Could not connect to the database $dbname :" . $pe->getMessage());
}
$conn->select_db("rush01");
$sql = "SELECT * FROM game_users;";
$result = $conn->query($sql);
print_r($result);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
