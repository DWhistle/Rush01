<?php
require_once('class/MapObject.class.php');

class Ship extends MapObject
{
    private $hull_points;
    private $PP;
    private $speed;
    private $handling;
    private $shield;
    private $weapons;


    public function __construct($name, $x, $y, $args)
    {
        $this->setName($name);
        $this->setPos($x, $y);
        if (array_key_exists('size', $args))
            $this->setSize($args['size'][0], $args['size'][1]);
        if (array_key_exists('hull_points', $args))
            $this->hull_points = $args['hull_points'];
        if (array_key_exists('PP', $args))
            $this->PP = $args['PP'];
        if (array_key_exists('speed', $args))
            $this->speed = $args['speed'];
        if (array_key_exists('handling', $args))
            $this->handling = $args['handling'];
        if (array_key_exists('shield', $args))
            $this->shield = $args['shield'];
        if (array_key_exists('weapons', $args))
            $this->weapons = $args['weapons'];
    }

    public function Draw()
    {
        echo $this->getHtml();
    }

    public function getHtml()
    {
        return <<<EOF
<div class="ship">
<p>Ship Info:</p>
    <div class="left-ship">
        <img src="/images/ships/$this->_name.png" alt="ship"/>
    </div>
    <div class="right-ship">
        <ul class="ship-parameters">
            <li class="property">Name:  $this->_name</li>
            <li class="property">Size:  {$this->getSize()[0]}, {$this->getSize()[1]}</li>
            <li class="property">Hull:  $this->hull_points</li>
            <li class="property">Power:  $this->PP</li>
            <li class="property">Speed:  $this->speed</li>
            <li class="property">Handling:  $this->handling</li>
            <li class="property">Shield:  $this->shield</li>
            <li class="property">Weapons:  $this->weapons</li>
        </ul>
    </div>
</div>
<div class="controls"> 

<button name="left" class="button">&larr;</button> 
<button name="forward" class="button">&uarr;</button> 
<button name="right" class="button">&rarr;</button>

</div>
EOF;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return integer
     */
    public function getHullPoints()
    {
        return $this->hull_points;
    }

    /**
     * @param integer $hull_points
     */
    public function setHullPoints($hull_points)
    {
        $this->hull_points = $hull_points;
    }

    /**
     * @return integer
     */
    public function getPP()
    {
        return $this->PP;
    }

    /**
     * @param integer $PP
     */
    public function setPP($PP)
    {
        $this->PP = $PP;
    }

    /**
     * @return integer
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param integer $speed
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
    }

    /**
     * @return integer
     */
    public function getHandling()
    {
        return $this->handling;
    }

    /**
     * @param integer $handling
     */
    public function setHandling($handling)
    {
        $this->handling = $handling;
    }

    /**
     * @return integer
     */
    public function getBouclier()
    {
        return $this->bouclier;
    }

    /**
     * @param integer $bouclier
     */
    public function setBouclier($bouclier)
    {
        $this->bouclier = $bouclier;
    }

    /**
     * @return array
     */
    public function getWeapons()
    {
        return $this->weapons;
    }

    /**
     * @param array $weapons
     */
    public function setWeapons(array $weapons)
    {
        $this->weapons = $weapons;
    }

    public function getCss()
    {
        return "<meta rel='stylesheet' href='ship-{$this->getName()}.css'>";
    }

    public function getJs()
    {
        // TODO: Implement getJs() method.
    }
}