<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/Player.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/FactoryObj.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/MapObject.class.php');
$action = $_POST['action'];
if(isset($_SESSION['player']))
    $player = new Player($_SESSION['player']);
echo '<pre>';
print_r($player);
echo '</pre>';
if ($player->getState()) {
    switch ($action) {
        case "activate_ship":
            $factory = $_SESSION['map'];
            $ship = $factory->getById($_POST['ship_id']);
            $player->setActiveShip($ship);
            break;
        case "move":
            $player->move($_POST['move_points'], $_POST['attack_points'], $_POST['repair_points']);
            break;
        case "finish":
            $player->finish();
            break;
    }
}