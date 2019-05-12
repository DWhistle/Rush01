<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/MapObject.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/Weapon.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/ISelectable.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/Db.class.php');

class Ship extends MapObject implements ISelectable
{
	private $hull_points;
	private $direction;
	private $PP;
	private $speed;
	private $handling;
	private $shield;
	private $weapons;
	private $state;
	private $max_hullpoint;


	public function getMaxHP()
	{
		return $this->max_hullpoint;
	}


	public function __construct($name, $top_left, $bottom_right, $args)
	{
		parent::__construct();
		$this->setName($name);
		$this->setRectangle($top_left,  $bottom_right);
		$this->state = 'active';
		//$this->setSize([$size['x'], $size['y']]);
		if (array_key_exists('hull_points', $args)) {
			$this->hull_points = $args['hull_points'];
			$this->max_hullpoint = $args['hull_points'];
		}
		if (array_key_exists('PP', $args))
			$this->PP = $args['PP'];
		if (array_key_exists('speed', $args))
			$this->speed = $args['speed'];
		if (array_key_exists('handling', $args))
			$this->handling = $args['handling'];
		if (array_key_exists('shield', $args))
			$this->shield = $args['shield'];
		if (array_key_exists('weapons', $args))
			$this->weapons = $args['weapons'];
		$size = $this->getSize();
		if ($size[0] > $size[1])
			$this->direction = ($this->getPos()[0] < 75) ? [1, 0] : [-1, 0];
		else
			$this->direction = ($this->getPos()[1] < 50) ? [0, 1] : [0, -1];
	}

	public function Draw()
	{
		echo $this->getHtml();
	}

	public function getPosCss()
    {
        $top = $this->getRectangle()["top-left"]['y'];
        $left = $this->getRectangle()["top-left"]['x'];
        $width = $this->getSize()[0];
        $height = $this->getSize()[1];
        $css = "style=\"";
        $css .= "top: {$top}0px; ";
        $css .= "left: {$left}0px; ";
        $css .= "width: {$width}0px; ";
        $css .= "height: {$height}0px; ";
        $css .= "border-{$this->getCssDirection()}:5px solid red;";
        $css .= "margin-{$this->getCssDirection()}:-5px;\"";
        return $css;
    }


	public function getHtml()
	{
		$top = $this->getRectangle()["top-left"]['y'];
		$left = $this->getRectangle()["top-left"]['x'];
		$width = $this->getSize()[0];
		$height = $this->getSize()[1];
		$html =  <<<EOF
<div class="map-object" id="obj-{$this->getName()}" {$this->getPosCss()} ></div>    
<div class="ship" id="descr-{$this->getName()}">
	<p>Ship Info:</p>
	<div class="left-ship">
		<img src="/images/ships/{$this->getName()}.png" alt="ship"/>
		<div class="controls">
			<button name="left" class="button">&larr;</button>
			<button name="forward" class="button">&uarr;</button>
			<button name="right" class="button">&rarr;</button>
			<button name="kill" class="button">K</button>
		</div>
	</div>
	<div class="right-ship">
		<ul class="ship-parameters">
			<li class="property">Name:  {$this->getName()}</li>
			<li class="property">Size:  {$this->getSize()[0]}, {$this->getSize()[1]}</li>
			<li class="property">Hull:  $this->hull_points</li>
			<li class="property">Power:  $this->PP</li>
			<li class="property">Speed:  $this->speed</li>
			<li class="property">Handling:  $this->handling</li>
			<li class="property">Shield:  $this->shield</li>
			<li class="property">Weapons:  {$this->printWeapons()}</li>
		</ul>
	</div>
EOF;
		if ($this->getState() == 'active') {
			$html .= <<<EOF
	<form class="start" method="post" action="/actions/player.php">
		Move:&nbsp <input type="text" name="move_points" value="1"> <br/>
		Attack: <input type="text" name="attack_points" value="1"> <br/>
		Repair: <input type="text" name="repair_points" value="1">
		<input type="hidden" name = "action" value = "move">
		<input type="hidden" name="ship_id" value="{$this->getId()}" />
		<input type="submit" value="Activate ship" name="Activate">
	</form>
EOF;
		}
		$html .= "</div>"; // .ship
		return ($html);
	}

	public function intersects($obj2){
		$top_left1 = $this->getRectangle()['top-left'];
		$top_left2 = $obj2->getRectangle()['top-left'];
		$bottom_right1 = $this->getRectangle()['bottom-right'];
		$bottom_right2 = $obj2->getRectangle()['bottom-right'];
		return ($top_left1['y'] < $bottom_right2['y'] ||
		$bottom_right1['y'] > $top_left1['y'] ||
		$bottom_right1['x'] < $top_left2['x'] ||
		$top_left1['x'] > $bottom_right2['x']);
	}

	/**
	 * @return integer
	 */
	public function getHullPoints()
	{
		return $this->hull_points;
	}

	/**
	 * @param integer $hull_points
	 */
	public function setHullPoints($hull_points)
	{
		$this->hull_points = $hull_points;
	}

	/**
	 * @return integer
	 */
	public function getPP()
	{
		return $this->PP;
	}

	/**
	 * @param integer $PP
	 */
	public function setPP($PP)
	{
		$this->PP = $PP;
	}

	/**
	 * @return integer
	 */
	public function getSpeed()
	{
		return $this->speed;
	}

	/**
	 * @param integer $speed
	 */
	public function setSpeed($speed)
	{
		$this->speed = $speed;
	}

	/**
	 * @return integer
	 */
	public function getHandling()
	{
		return $this->handling;
	}

	/**
	 * @param integer $handling
	 */
	public function setHandling($handling)
	{
		$this->handling = $handling;
	}

	/**
	 * @return integer
	 */
	public function getShield()
	{
		return $this->shield;
	}

	/**
	 * @param integer $bouclier
	 */
	public function setShield($shield)
	{
		$this->shield = $shield;
	}

	/**
	 * @return array
	 */
	public function getWeapons()
	{
		return $this->weapons;
	}

	/**
	 * @param array $weapons
	 */
	public function setWeapons(array $weapons)
	{
		$this->weapons = $weapons;
	}

	public function getCss()
	{
		return "<meta rel='stylesheet' href='ship-{$this->getName()}.css'>";
	}

	public function getJs()
	{
		$obj_idname  = "#obj-{$this->getName()}";
		$descr_idname = ".ship#descr-{$this->getName()}";

		$js =  "<script>";
		$js .= "$(function() {";
		$js .= "$('$obj_idname').click( function () { $('$descr_idname').toggle(); });";
//        $js .= "$('$obj_idname').mouseleave( function () { $('$descr_idname').hide() });";
		$js .= "});";
		$js .= "</script>";
		return ($js);
	}

	/**
	 * @return mixed
	 */
	public function getState()
	{
		return $this->state;
	}

	/**
	 * @param mixed $state
	 */
	public function setState($state)
	{
		$this->state = $state;
	}

	/**
	 * @return mixed
	 */
	public function getDirection()
	{
		return $this->direction;
	}

	public function getCssDirection()
    {
        if ($this->direction[0] == 1)
            return 'right';
        else if ($this->direction[0] == -1)
            return 'left';
        else if ($this->direction[1] == 1)
            return 'bottom';
        else if ($this->direction[1] == -1)
            return 'top';
        else
            return '';
    }

	public function printWeapons()
	{
		if (!empty($this->weapons)) {
			foreach ($this->weapons as $weapon) {
				$name = get_class($weapon);
				return "<br /><span>{$name}:{$weapon->getCharges()}</span>";
			}
		}
		else
			return "<span>none</span>";
	}

	/**
	 * @param mixed $direction
	 */
	public function setDirection($direction)
	{
		$this->direction = $direction;
	}

	private function attack_ship($ship, $pp)
	{
		if ($ship instanceof Ship) {
			$hp = $ship->getHullPoints();
			$attack = $pp * rand(1, 6) - $ship->getShield();
			$ship->setHullPoints($hp - ($attack > 0 ? $attack : 0));
		}
	}

	public function attack($factory, $pp)
	{
		foreach ($this->weapons as $weapon) {
			if ($weapon instanceof Weapon) {
				$charges = $weapon->getCharge();
				if ($charges > 0)
					foreach ($factory->findInRange($weapon) as $enemy) {
						$weapon->setCharges($charges - 1);
						$this->attack_ship($enemy, $pp);
					}
			}
		}
	}

	public function move($num)
	{
		$pos = $this->getPos();
		$pos[0] += intval($num * $this->direction[0]);
		$pos[1] += intval($num * $this->direction[1]);
		$this->setPos($pos);
	}

	public function rotateLeft()
	{
		$vec = [$this->direction[0], $this->direction[1]];
		$this->direction = [$vec[1], -$vec[0]];
		$size = $this->getSize();
		$this->setSize([$size[1], $size[0]]);
	}

	public function rotateRight()
	{
		$vec = [$this->direction[0], $this->direction[1]];
		$this->direction = [-$vec[1], $vec[0]];
		$size = $this->getSize();
		$this->setSize([$size[1], $size[0]]);
	}

	public function repair($num)
	{
		if ($num > 0)
		{
			$this->hull_points = ($this->hull_points + $num <= $this->max_hullpoint)
				? $this->hull_points + $num
				: $this->max_hullpoint;
		}
	}

    public static function getById($id)
    {
        $db = new Db();
        $db_ship = $db->getTableById('ships', $id)[0];
        $ship = new Ship($db_ship['name'], ['x' => 0,'y' => 0], ['x' => $db_ship['size_x'], 'y' => $db_ship['size_y']],
            [
                'hull_points' => $db_ship['hp'],
                'PP' => $db_ship['max_pp'],
                'speed' => $db_ship['speed'],
                'handling' => $db_ship['handling'],
                'shield' => $db_ship['shield'],
                'weapons' => [],
                'state' => 0
        ]);
        return $ship;
    }

    public static function getAll()
    {
        $db = new Db();
        $db_ship = $db->getTable('ships');
    }

    public function addToDb()
    {
        if (empty($ret = self::getById($this->getId()))) {
            $sql =
"INSERT INTO ships(name, size_x, size_y, hp, speed, handling, shield, max_pp)
 VALUES (
    {$this->getName()},
    {$this->getSize()[0]},
    {$this->getSize()[1]},
    {$this->getHullPoints()},
    {$this->getSpeed()},
    {$this->getHandling()},
    {$this->getShield()},
    {$this->getPP()} 
 )";
            $db = new Db();
            $this->setId($db->execute($sql)['id']);
        }
        else
        {
            $sql = "UPDATE ships SET 
                        name = '{$this->getName()}', 
                        size_x = {$this->getSize()[0]}, 
                        size_y = {$this->getSize()[1]}, 
                        hp = {$this->getHullPoints()}, 
                        speed = {$this->getSpeed()}, 
                        handling = {$this->getHandling()},
                        shield = {$this->getShield()},
                        max_pp = {$this->getPP()} 
                    WHERE id = {$this->getId()}";
            $db = new Db();
            $db->execute($sql);
        }
    }

    public static function removeFromDb($id)
    {
        $sql = "DELETE FROM ships WHERE id = $id";
        $db = new Db();
        $db->execute($sql);
    }
}
