<?php


class Player implements IDrawable
{
    public $ships = array();
    public $state = false;
    public $active_ship = null;
    public $name = "";
    public $icon = "";


    public function __construct($array)
    {
        
        $this->name = $array['name'];
        $this->ships = $array['ships'];
        $this->icon = $array['icon'];
        if (array_key_exists('state', $array))
            $this->state = $array['state'];
    }
    public function addShip($ship)
    {
        if ($ship instanceof Ship)
            $this->ships.array_push($ship);
    }

    public function getHtml()
    {
        return <<<EOF
    <div class="player">
    <div>
        <img src="$this->icon">
    </div>
    <div>
        <p>$this->name</p>
        <p>$this->active_ship</p>
    </div>
    </div>
    
EOF;

    }
    public function draw()
    {
        echo "{$this->getHtml()}";
    }

    /**
     * @return array|mixed
     */
    public function getShips()
    {
        return $this->ships;
    }
    public function getState(){
        return $this->state;
    }

    /**
     * @return mixed|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $active_ship
     */
    public function setActiveShip($active_ship)
    {
        $this->active_ship = $active_ship;
    }

    /**
     * @return null
     */
    public function getActiveShip()
    {
        return $this->active_ship;
    }

    public function getCss()
    {
        // TODO: Implement getCss() method.
    }

    public function getJs()
    {
        // TODO: Implement getJs() method.
    }


    public function move($move_points, $attack_points, $repair_point)
    {
        if ($move_points + $attack_points + $repair_point == $this->active_ship->getPP()) {
            // TODO: написать вклячение систем
        }
    }
}


