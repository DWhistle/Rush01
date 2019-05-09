<?php


class Weapon
{
	// use WeaponType;

	private $Charge;
	private $ShortRange;
	private $MiddleRange;
	private $LongRange;
	private $EffectZone;

	/**
	 * @return mixed
	 */
	public function getCharge()
	{
		return $this->Charge;
	}

	/**
	 * @param mixed $Charge
	 */
	public function setCharge($Charge)
	{
		$this->Charge = $Charge;
	}

	/**
	 * @return mixed
	 */
	public function getShortRange()
	{
		return $this->ShortRange;
	}

	/**
	 * @param mixed $ShortRange
	 */
	public function setShortRange($ShortRange)
	{
		$this->ShortRange = $ShortRange;
	}

	/**
	 * @return mixed
	 */
	public function getMiddleRange()
	{
		return $this->MiddleRange;
	}

	/**
	 * @param mixed $MiddleRange
	 */
	public function setMiddleRange($MiddleRange)
	{
		$this->MiddleRange = $MiddleRange;
	}

	/**
	 * @return mixed
	 */
	public function getLongRange()
	{
		return $this->LongRange;
	}

	/**
	 * @param mixed $LongRange
	 */
	public function setLongRange($LongRange)
	{
		$this->LongRange = $LongRange;
	}

	/**
	 * @return mixed
	 */
	public function getEffectZone()
	{
		return $this->EffectZone;
	}

	/**
	 * @param mixed $EffectZone
	 */
	public function setEffectZone($EffectZone)
	{
		$this->EffectZone = $EffectZone;
	}
}