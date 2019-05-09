<?php

require_once('class/IDrawable.class.php');
abstract class MapObject implements IDrawable
{
    private $pos;
    private $size;
    private $name;

    /**
     * @param int $pos_x, $pos_y
     */
    public function setPos($pos_x, $pos_y)
    {
        $this->pos = [$pos_x, $pos_y];
    }

    /**
     * @return integer, integer
     */
    public function getPos()
    {
        return $this->pos;
    }

    /**
     * @param int $size_x, $size_y
     */
    public function setSize($size_x, $size_y)
    {
        $this->size = [$size_x, $size_y];
    }

    /**
     * @return integer, integer
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    abstract public function getHtml();
    abstract public function draw();

}