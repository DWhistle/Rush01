<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/IDrawable.class.php');

class Player implements IDrawable
{
    public $ships = array();
    public $state = false;
    public $active_ship = null;
    public $name = "";
    public $icon = "";


    public function __construct($array)
    {
        if (is_array($array)) {
            $this->name = $array['name'];
            $this->ships = $array['ships'];
            $this->icon = $array['icon'];
            if (array_key_exists('state', $array))
                $this->state = $array['state'];
        }
        else
        {
            $player = $array;
            $this->ships = $player->ships;
            $this->state = $player->state;
            $this->active_ship = $player->active_ship;
            $this->name = $player->name;
            $this->icon = $player->icon;
        }
    }

    public function addShip($ship)
    {
        if ($ship instanceof Ship)
            $this->ships[] = $ship;
    }

    public function getHtml()
    {
        $html = <<<EOF
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
        if (!empty($this->ships)) {
            foreach ($this->ships as $ship) {
                $html .= $ship->getJs();
            }
        }
        return $html;

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
        $active_ship->setState('move');
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
            return (0);
        }
    }
}


