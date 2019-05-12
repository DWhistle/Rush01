<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/FactoryObj.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/Ship.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/Player.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/weapons/BasicRailgun.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/Obstacle.class.php');

include ('views/template/header.php');
if (isset($_SESSION["login"])){
	include ('lobby.php');
}
include ('views/template/footer.php');
