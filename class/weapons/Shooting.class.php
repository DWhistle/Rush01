<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/Ship.class.php');

trait Shooting{
    public function isInRange(Ship $enemy_ship)
    {
		$enemy_coordinates = $enemy_ship->getRectangle();	//	array( "top-left" => ["x" => ..., "y" => ...], "bottom-right" => ["x" => ..., "y" => ...] )
		
        if ($this->getOrientation()[0] == 0 &&  $this->getOrientation()[1] == 1
                &&  $enemy_coordinates["top-left"]["x"]     <= $this->getCoordinates()["x"]
                && $enemy_coordinates["bottom-right"]["x"] >= $this->getCoordinates()["x"]
                && $enemy_coordinates["bottom-right"]["y"] >  $this->getCoordinates()["y"]
				&& $enemy_coordinates["bottom-right"]["y"] -  $this->getCoordinates()["y"]  < $this->getLongRange()[1])
		{
			echo "ONE";
			return (TRUE);
		}
        else if ($this->getOrientation()[0] == 0 &&  $this->getOrientation()[1] == 1
				&& $enemy_coordinates["top-left"]["x"]     <= $this->getCoordinates()["x"]
                && $enemy_coordinates["bottom-right"]["x"] >= $this->getCoordinates()["x"]
                && $enemy_coordinates["top-left"]["y"]     <  $this->getCoordinates()["y"]
				&& abs($enemy_coordinates["left-top"]["y"] -  $this->getCoordinates()["y"]) < $this->getLongRange()[1])
		{
			echo "two";
			return (TRUE);
		}
        else if ($this->getOrientation()[0] == -1 &&  $this->getOrientation()[1] == 0
				&& $enemy_coordinates["top-left"]["y"]         >= $this->getCoordinates()["y"]
                && $enemy_coordinates["bottom-right"]["y"]     <= $this->getCoordinates()["y"]
                && $enemy_coordinates["bottom-right"]["x"]     <  $this->getCoordinates()["x"]
				&& abs($enemy_coordinates["bottom-right"]["x"] -  $this->getCoordinates()["x"]) < getLongRange()[1])
			{
				echo "three";
			return (TRUE);
			}
        else if ($this->getOrientation()[0] == 1 &&  $this->getOrientation()[1] == 0
              && $enemy_coordinates["top-left"]["y"]     >= $this->getCoordinates()["y"]
                && $enemy_coordinates["bottom-right"]["y"] <= $this->getCoordinates()["y"]
                && $enemy_coordinates["top-left"]["x"]     >  $this->getCoordinates()["x"]
				&& $enemy_coordinates["top-left"]["x"]     -  $this->getCoordinates()["x"] < $this->getLongRange()[1])
				{
					echo "four";
				return (TRUE);
				}
			echo "faaaalse";
		return (FALSE);
		//return (TRUE);
    }


}