<?php
require_once ("class/MapObject.class.php");

class FactoryObj
{
    private $objects;
    private $min_x;
    private $max_x;
    private $min_y;
    private $max_y;

    public function __construct($min_x, $max_x, $min_y, $max_y)
    {
        $this->min_x = $min_x;
        $this->max_x = $max_x;
        $this->min_y = $min_y;
        $this->max_y = $max_y;
    }

    /**
     * @param $obj
     * @throws Exception
     */
    public function addObj($obj)
    {
        if ($obj instanceof  MapObject)
            $this->objects[] = $obj;
        else
            throw new Exception("{$obj->getName()} is not an MapObject");
    }

    public function drawAll()
    {
        foreach ($this->objects as $object) {
            $object->draw();
        }
    }
}