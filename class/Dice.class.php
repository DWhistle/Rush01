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
		$this->last_result = mt_rand(1, 6); //rand( time() );
		return $this->last_result;
	}
}
