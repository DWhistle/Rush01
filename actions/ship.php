<?php
session_start();
$action = $_POST['action'];
$ship_id = $_POST['id'];

switch ($action)
{
    case "fire":
        $player = $_SESSION['player'];
        if ($player->getState())
        {
            $ship = $player->getActiveShip();
            $ship->attack();
        }
        break;
    case "move":

        break;
    case "repair":

        break;
}