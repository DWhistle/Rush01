<?php


class BasicRailgun extends Weapon	//	название временное и подлежит изменению в будущем
{
	public function __construct()
	{
		$this->_charges = 0;
		$this->_coordinates = 0;
		$this->_orientation = "top";
		$this->_short_range = [1, 30];
		$this->_middle_range = [31, 60];
		$this->_long_range = [61, 90];
		$this->_effect_zone = "srtaight_line";
	}

	public function isInRange(Ship $host_ship, Ship $enemy_ship)
	{
		$area_of_fire = [$host_ship];
		$coordinates = getShipCoordinates($enemy_ship);	//	array( "top-left" => [x, y], "bottom-right" => [x, y] )
		if (1);
	}

	public function getCharges()
	{
		return ($this->_charges);
	}

	public function setCharges($charges)
	{
		$this->_charges = $charges;
	}

	public function getCoordinates()
	{
		return ($this->_coordinates);
	}

	public function setCoordinates(Ship $host_ship)
	{
		$rectangle = $host_ship->getShipCoordinates();
		if ($this->_orientation == "top")
			$this->_coordinates = [$rectangle["top-left"][0] + $hostShip->getSizeX() / 2, $rectangle["top-left"][1]];
		if ($this->_orientation == "bottom")
			$this->_coordinates = [$rectangle["bottom-right"][0] - $hostShip->getSizeX() / 2 , $rectangle["bottom-right"][1]];
		if ($this->_orientation == "left")
			$this->_coordinates = [$rectangle["top-left"][0], $rectangle["bottom-right"][1] + $hostShip->getSizeY() / 2];
		if ($this->_orientation == "right")
			$this->_coordinates = [$rectangle["bottom-right"][0], $rectangle["top-left"][1] - $hostShip->getSizeY() / 2];
	}

	public function getOrientation()
	{
		return ($this->_orientation);
	}

	public function setOrientation($orientation)
	{
		$this->_orientation = $orientation;
	}
}