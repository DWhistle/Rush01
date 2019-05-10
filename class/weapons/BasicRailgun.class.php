<?php


class BasicRailgun extends Weapon	//	название временное и подлежит изменению в будущем
{
    public function __construct($charges, $host_ship)
    {
        $this->_charges = $charges;
        $this->_coordinates = $this->setCoordinates($host_ship);
        $this->_orientation = $host_ship->getOrientation();
        $this->_short_range = [1, 30];
        $this->_middle_range = [31, 60];
        $this->_long_range = [61, 90];
        $this->_effect_zone = "srtaight_line";
    }

    public function isInRange(Ship $enemy_ship)
    {
        $enemy_coordinates = $enemy_ship->getRectangle();	//	array( "top-left" => ["x" => ..., "y" => ...], "bottom-right" => ["x" => ..., "y" => ...] )
        if ($this->_orientation == "top"
                && $enemy_coordinates["top-left"]["x"]     <= $this->_coordinates["x"]
                && $enemy_coordinates["bottom-right"]["x"] >= $this->_coordinates["x"]
                && $enemy_coordinates["bottom-right"]["y"] >  $this->_coordinates["y"]
                && $enemy_coordinates["bottom-right"]["y"] -  $this->_coordinates["y"]  < $this->_long_range[1])
            return (TRUE);
        else if ($this->_orientation == "bottom"
                && $enemy_coordinates["top-left"]["x"]     <= $this->_coordinates["x"]
                && $enemy_coordinates["bottom-right"]["x"] >= $this->_coordinates["x"]
                && $enemy_coordinates["top-left"]["y"]     <  $this->_coordinates["y"]
                && abs($enemy_coordinates["left-top"]["y"] -  $this->_coordinates["y"]) < $this->_long_range[1])
            return (TRUE);
        else if ($this->_orientation == "left"
                && $enemy_coordinates["top-left"]["y"]         >= $this->_coordinates["y"]
                && $enemy_coordinates["bottom-right"]["y"]     <= $this->_coordinates["y"]
                && $enemy_coordinates["bottom-right"]["x"]     <  $this->_coordinates["x"]
                && abs($enemy_coordinates["bottom-right"]["x"] -  $this->_coordinates["x"]) < $this->_long_range[1])
            return (TRUE);
        else if ($this->_orientation == "right"
                && $enemy_coordinates["top-left"]["y"]     >= $this->_coordinates["y"]
                && $enemy_coordinates["bottom-right"]["y"] <= $this->_coordinates["y"]
                && $enemy_coordinates["top-left"]["x"]     >  $this->_coordinates["x"]
                && $enemy_coordinates["top-left"]["x"]     -  $this->_coordinates["x"] < $this->_long_range[1])
            return (TRUE);
        return (FALSE);
    }

    public function getCoordinates()
    {
        return ($this->_coordinates);
    }

    public function setCoordinates(Ship $host_ship)
    {
        $rectangle = $host_ship->getRectangle();
        $size = $host_ship->getSize();
        if ($this->_orientation == "top")
            $this->_coordinates = ["x" => $rectangle["top-left"]["x"] + $size["x"] / 2,
                                   "y" => $rectangle["top-left"]["y"]];
        else if ($this->_orientation == "bottom")
            $this->_coordinates = ["x" => $rectangle["bottom-right"]["x"] - $size["x"] / 2 ,
                                   "y" => $rectangle["bottom-right"]["y"]];
        else if ($this->_orientation == "left")
            $this->_coordinates = ["x" => $rectangle["top-left"]["x"],
                                   "y" => $rectangle["bottom-right"]["y"] + $size["y"] / 2];
        else if ($this->_orientation == "right")
            $this->_coordinates = ["x" => $rectangle["bottom-right"]["x"],
                                   "y" => $rectangle["top-left"]["y"] - $size["y"] / 2];
    }
}