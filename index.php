<?php
require_once ('class/FactoryObj.class.php');
require_once ('class/Ship.class.php');
require_once ('class/Player.class.php');
include ('views/template/header.php');
$map = new FactoryObj(0,0, 150,100);
$ship1 = new Ship('ship1', 0, 0, ['size' => [1, 1], 'speed' => 1]);
$ship2 = new Ship('ship2', 10, 10, [ 'size' => [1, 1], 'speed' => 1]);
$map->addObj($ship1);

//$map->addObj($ship2);
$map->drawAll();
include ('views/template/footer.php');