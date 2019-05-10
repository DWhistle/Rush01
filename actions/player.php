<?php
session_start();
require_once ('class/Player.class.php');
$action = $_POST['action'];
$player = $_SESSION['player'];
if ($player->getState()) {
    switch ($action) {
        case "activate_ship":
            $player->setActiveShip($_POST['ship_id']);
            break;
        case "move":
            $ship = $player->getActiveShip();
            $ship->move($_POST['move_points'], $_POST['attack_points'], $_POST['repair_points']);
            break;
        case "finish":
            $player->finish();
            break;
    }
}