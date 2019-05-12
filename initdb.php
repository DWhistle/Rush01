<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/class/config.php');
if (isset($_POST['create']))
{
    $config  = '<?php' . PHP_EOL;
    $config .= "\$MY_DB = [ 
        'host' => '{$_SERVER['SERVER_NAME']}',
        'user' => '{$_POST['dblogin']}',
        'pass' => '{$_POST['dbpass']}',
        'db_name' => '{$_POST['dbname']}' 
    ];";
    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/class/config.php', $config);
    $mysqli = new mysqli($MY_DB['host'], $MY_DB['user'], $MY_DB['pass'], $MY_DB['db_name']);
	if (!$mysqli) {
		die("Connection failed: " . $mysqli->connect_error);
	}
	$sql = "CREATE DATABASE IF NOT EXISTS `{$_POST['dbname']}`;";
	if ($mysqli->query($sql) === TRUE){
		echo "Database successfully created";
	}
	else {
		echo 'Error: '. $mysqli->error;
	}
	$mysqli->select_db("rush01");
	$sql = "create table if not exists game_users (
	`id` int auto_increment primary key,
	`login` varchar(20)  not null,
	`passwd`        varchar(128) not null,
	`faction`       varchar(20)  not null,
    `creation_date` datetime     not null
);";
	if ($mysqli->query($sql) === TRUE){?>
		<p>"Login table successfully created";</p>
	<?}
	else {?>
		<p> <?echo "Error: ". $mysqli->error; ?></p>
	<?}
	$sql = "create table if not exists rooms
(
    id     int auto_increment primary key,
    login1 varchar(20) not null,
    login2 varchar(20) not null,
    login3 varchar(20) not null,
    login4 varchar(20) not null
);";
	if ($mysqli->query($sql) === TRUE){?>
		<p>"Rooms table successfully created";</p>
	<?}
	else {?>
		<p> <?echo "Error: ". $mysqli->error; ?></p>
	<?}
	$sql = "create table if not exists chat
(
    id      int auto_increment
        primary key,
    login   varchar(20)   not null,
    message varchar(1000) not null
);";
	if ($mysqli->query($sql) === TRUE){?>
		<p>  "Chat table successfully created";?></p>
	<?}
	else {?>
		<p> <?echo "Error: ". $mysqli->error; ?></p>
	<?}
	$mysqli->close();

}
else
{
    ?>
    <form action="/initdb.php" method="post">
        <input type="text" name="dblogin" value="root" placeholder="login DB"/>
        <input type="text" name="dbpass" value="password" placeholder="password DB" />
        <input type="text" name="dbname" value="rush01" placeholder="DB name"/>
        <input type="submit" name="create" value="create db" />
    </form>
    <?php
}
