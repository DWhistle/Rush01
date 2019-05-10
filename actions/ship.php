<?php
session_start();
$action = $_POST['action'];
$ship_id = $_POST['id'];
$player = $_SESSION['player'];
if ($player->getState()) {
    switch ($action) {
        case "fire":
            $ship = $player->getActiveShip();
            $ship->attack($_SESSION['map']);
            break;
        case "move":
            $ship = $player->getActiveShip();
            $ship->move();
            break;
        case "repair":
            $ship = $player->getActiveShip();
            $ship->repair();
            break;
    }
}