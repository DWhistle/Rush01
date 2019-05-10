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
        $this->_size = $size;
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