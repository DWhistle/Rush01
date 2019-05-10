<?php

class BasicRailgun extends Weapon	//	название временное и подлежит изменению в будущем
{
	public function __construct()
	{
		$this->_base_charges = 0;
		$this->_orientation = 0;
		$this->_short_range = [1, 30];
		$this->_middle_range = [31, 60];
		$this->_long_range = [61, 90];
		$this->_effect_zone = "srtaight_line";
	}

	public function isInRange(array $ship)
	{
		foreach($ship as $s)
		{
			
		}
	}
}