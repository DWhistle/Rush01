<?php

require_once('class/IDrawable.class.php');
abstract class MapObject implements IDrawable
{
    private $_id;
    private $_rectangle;    //	= array(  "top-left" => ["x" => ..., "y" => ...],
                            //            "bottom-right" => ["x" => ..., "y" => ...] )

    private $_size;         //  = array(  "x" => ...,
                            //            "y" => ... )

    private $_name;
    private static $_obj_count = 0;

    /**
     * @var array
     */
    private $_pos;

    /**
     * @return int
     */
    public function getId()
    {
        return ($this->_id);
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return array
     */
    public function getRectangle()
    {
        return $this->_rectangle;
    }

    /**
     * @param array $top_left, $bottom_right
     */
    public function setRectangle($top_left, $bottom_right)
    {
        $this->_size = [$bottom_right["x"] - $top_left["x"], $bottom_right["y"] - $top_left["y"]];
        $this->_pos = [$top_left["x"] + $this->_size[0] / 2, $top_left["y"] + $this->_size[1] / 2];
        $this->_rectangle = [$top_left, $bottom_right];
    }

    /**
     * @return array
     */
    public function getSize()
    {
        return $this->_size;
    }

    /**
     * @param array $size
     */
    public function setSize($size)
    {
        $this->_rectangle = [$this->_pos[0] - $size[0] / 2, $this->_pos[1] - $size[1] / 2];
        $this->_size = $size;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    abstract public function getHtml();
    abstract public function draw();

    /**
     * @return array
     */
    public function getPos()
    {
        return $this->_pos;
    }

    /**
     * @param array $pos
     */
    public function setPos($pos)
    {
        $this->_rectangle = [$pos[0] - $this->_size[0] / 2, $pos[1] - $this->_size[1] / 2];
        $this->_pos = $pos;
    }

}