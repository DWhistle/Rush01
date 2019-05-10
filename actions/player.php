<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/Player.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/FactoryObj.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/MapObject.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/Ship.class.php');
$action = $_POST['action'];
if (is_string($_SESSION['player']))
    $player = unserialize($_SESSION['player']);
if ($player->getState()) {
    switch ($action) {
        case "activate_ship":
            $factory = unserialize($_SESSION['map']);
            if ($factory instanceof FactoryObj)
                $ship = $factory->getById($_POST['ship_id']);
            if ($ship instanceof Ship);
            $player->setActiveShip($ship);
            $player->setState('moving');
            break;
        case "moving":
            if ($player instanceof Player) {
                $player->move($_POST['ship_id'], $_POST['move_points'], $_POST['attack_points'], $_POST['repair_points']);
                $player->setState('finish');
            }
            break;
        case "finish":
            if ($player instanceof Player) {
                $player->finish();
                $player->setState('active');
            }
            break;
    }
}
$_SESSION['player'] = serialize($player);
$_SESSION['map'] = serialize($factory);
header("Location:{$_SERVER['HTTP_REFERER']}");