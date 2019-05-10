<?php
require_once ('class/FactoryObj.class.php');
require_once ('class/Ship.class.php');
require_once ('class/Player.class.php');
include ('views/template/header.php');
if ($_POST['game'] == 'new' || (!$_SESSION['game'])) {
    $map = new FactoryObj(0, 0, 150, 100);
    $ship1 = new Ship('ship1', ['x' => 0, 'y' => 0], ['x' => 2, 'y' => 1], ['speed' => 1]);
    $ship2 = new Ship('ship2', ['x' => 10, 'y' => 10], ['x' => 13, 'y' => 15], ['speed' => 1]);
    $player1 = new Player(array('state' => 'true', 'name' => 'player1', 'icon' => '/images/Players/p1.png'));
    $map->addObj($ship1);
    $map->addObj($ship2);
    $player1->addShip($ship1);
    $_SESSION['map'] = serialize($map);
    $_SESSION['player'] = serialize($player1);
    $_SESSION['game'] = true;

}
else
{
    if (is_string($_SESSION['map']))
        $map = unserialize($_SESSION['map']);
    if (is_string($_SESSION['player']))
        $player1 = unserialize($_SESSION['player']);
}
if (isset($map))
    $map->drawAll();
echo "<form method='post' action='index.php'>
<input type='submit' name='game' value='new'/>
</form>
";
$player1->draw();
include ('views/template/footer.php');