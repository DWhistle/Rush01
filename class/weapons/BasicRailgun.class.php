<?php


class BasicRailgun extends Weapon	//	название временное и подлежит изменению в будущем
{
	public function __construct()
	{
		$this->_charges = 0;
		$this->_coordinates = ["x" => 0, "y" => 0];
		$this->_orientation = "top";
		$this->_short_range = [1, 30];
		$this->_middle_range = [31, 60];
		$this->_long_range = [61, 90];
		$this->_effect_zone = "srtaight_line";
	}

	public function isInRange(Ship $enemy_ship)
	{
		$enemy_coordinates = getShipCoordinates($enemy_ship);	//	array( "top-left" => [x, y], "bottom-right" => [x, y] )
		if ($this->_orientation == "top")
		{
			if ($enemy_coordinates["x"])
		}
		else if ()
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
			$this->_coordinates = ["x" => $rectangle["top-left"]["x"] + $hostShip->getSizeX() / 2, "y" => $rectangle["top-left"]["y"]];
		else if ($this->_orientation == "bottom")
			$this->_coordinates = ["x" => $rectangle["bottom-right"]["x"] - $hostShip->getSizeX() / 2 , "y" => $rectangle["bottom-right"]["y"]];
		else if ($this->_orientation == "left")
			$this->_coordinates = ["x" => $rectangle["top-left"]["x"], "y" => $rectangle["bottom-right"]["y"] + $hostShip->getSizeY() / 2];
		else if ($this->_orientation == "right")
			$this->_coordinates = ["x" => $rectangle["bottom-right"]["x"], "y" => $rectangle["top-left"]["y"] - $hostShip->getSizeY() / 2];
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