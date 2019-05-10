<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/IDrawable.class.php');

class Ship extends MapObject
{
    private $hull_points;
    private $PP;
    private $speed;
    private $handling;
    private $shield;
    private $weapons;


    public function __construct($name, $top_left, $bottom_right, $args)
    {
        parent::__construct();
        $this->setName($name);
        $this->setRectangle($top_left,  $bottom_right);
        //$this->setSize([$size['x'], $size['y']]);
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
        $top = $this->getRectangle()["top-left"]['y'];
        $left = $this->getRectangle()["top-left"]['x'];
        $width = $this->getSize()[0];
        $height = $this->getSize()[1];
        return $this->getJs() . <<<EOF
<div class="map-object" id="obj-{$this->getName()}" style="top: {$left}0px; left: {$top}0px; width: {$width}0px; height: {$height}0px;" ></div>
<div class="ship" id="descr-{$this->getName()}">
<p>Ship Info:</p>
    <div class="left-ship">
        <img src="/images/ships/{$this->getName()}.png" alt="ship"/>
        <div class="controls">
            <button name="left" class="button">&larr;</button> 
            <button name="forward" class="button">&uarr;</button> 
            <button name="right" class="button">&rarr;</button>
        </div>
    </div>
    <div class="right-ship">
        <ul class="ship-parameters">
            <li class="property">Name:  {$this->getName()}</li>
            <li class="property">Size:  {$this->getSize()[0]}, {$this->getSize()[1]}</li>
            <li class="property">Hull:  $this->hull_points</li>
            <li class="property">Power:  $this->PP</li>
            <li class="property">Speed:  $this->speed</li>
            <li class="property">Handling:  $this->handling</li>
            <li class="property">Shield:  $this->shield</li>
            <li class="property">Weapons:  $this->weapons</li>
        </ul>
    </div>
    <form class="start" method="post">
    Move:&nbsp <input type="text" name="move_points" value=""> <br/>
    Attack: <input type="text" name="attack_points" value=""> <br/>
    Repair: <input type="text" name="repair_points" value="">
    <input type="hidden" name = "action" value = "activate_ship">
    <input type="submit" value="Activate ship" name="Activate">
    </form>
</div>
EOF;
    }

    public function intersects($obj2){
        $top_left1 = $this->pos['top-left'];
        $top_left2 = $obj2->pos['top-left'];
        $bottom_right1 = $this->pos['bottom-right'];
        $bottom_right2 = $obj2->pos['bottom-right'];
        return ($top_left1['y'] <$bottom_right2['y'] ||
        $bottom_right1['y'] > $top_left1['y'] ||
        $bottom_right1['x'] < $top_left2['x'] ||
        $top_left1['x'] > $bottom_right2['x']);
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
        $obj_idname  = "#obj-{$this->getName()}";
        $descr_idname = ".ship#descr-{$this->getName()}";

        $js =  "<script>";
        $js .= "$(function() {";
        $js .= "$('$obj_idname').click( function () { $('$descr_idname').toggle(); });";
//        $js .= "$('$obj_idname').mouseleave( function () { $('$descr_idname').hide() });";
        $js .= "});";
        $js .= "</script>";
        return ($js);
    }
}