<?php


class Player implements IDrawable
{
    public $ships = array();
    public $state = false;
    public $active_ship = null;
    public $name = "";


    public function __construct($array)
    {
        $this->state = $array['turn'];
        $this->name = $array['name'];
        $this->ships = $array['ships'];
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
        <img src="player1.jpg">
        <p>$this->name</p>
        <p>$this->active_ship</p>
    </div>
EOF;

    }
    public function draw()
    {
        $this->getHtml();
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

    public function getCss()
    {
        // TODO: Implement getCss() method.
    }

    public function getJs()
    {
        // TODO: Implement getJs() method.
    }
}


