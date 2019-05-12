<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/class/Dice.class.php');
class Dice
{
	public $last_result;
	public function Dice()
	{ }

	public function rollDice()
	{
		$this->last_result = srand( time() ) % 6 + 1;
		return $this->last_result;
	}
}
