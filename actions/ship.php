<?php
session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/Ship.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/FactoryObj.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/Player.class.php');
$action = $_POST['action'];
$ship_id = $_POST['id'];
if (is_string($_SESSION['player']))
    $player = unserialize($_SESSION['player']);
if (is_string($_SESSION['map'])) {
    $factory = unserialize($_SESSION['map']);
    if (!($factory instanceof FactoryObj))
        return ;
    $ship = $factory->getById($ship_id);
    if (!($ship instanceof Ship))
        return ;
}
if ($player->getState()) {
	switch ($action) {
		case "fire":
		    $ship->attack($factory, intval($_POST['num']));
			break;
		case "move":
		    $ship->move(intval($_POST['num']));
			break;
        case "rotate":
            $side = $_POST['side'];
            if ($side == 'right')
            {
                $ship->rotateRight();
            }
            else if ($side == 'left')
            {
                $ship->rotateLeft();
            }
            break;
		case "repair":
		    $ship->repair(intval($_POST['num']));
			break;
	}
}
if (isset($player) && $player instanceof Player) {
    $player->setShips([$ship]);
    $_SESSION['player'] = serialize($player);
    if (isset ($ship))
        $factory->setShip($ship->getId(), $ship);
}
if (isset($factory))
    $_SESSION['map'] = serialize($factory);
//header("Location:{$_SERVER['HTTP_REFERER']}");
