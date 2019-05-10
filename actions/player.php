<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/Player.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/FactoryObj.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/MapObject.class.php');
$action = $_POST['action'];
if (is_string($_SESSION['player']))
    $player = unserialize($_SESSION['player']);
if ($player->getState()) {
    switch ($action) {
        case "activate_ship":
            $factory = unserialize($_SESSION['map']);
            if ($factory instanceof FactoryObj)
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
$_SESSION['player'] = serialize($player);
$_SESSION['map'] = serialize($factory);
header("Location:{$_SERVER['HTTP_REFERER']}");