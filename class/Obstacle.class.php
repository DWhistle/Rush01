<?php
require_once ('class/MapObject.class.php');

class Obstacle extends MapObject
{

    public function getHtml()
    {
        return <<<EOF
<div class="obstacle">
    <div class="left-obstacle">
        <img src="/images/obstacle/{$this->getName()}.png" alt="{$this->getName()}">
    </div>
    <div class="right-obstacle">
        <ul class="properties">
            <li>{$this->getName()}</li>
            <li>{$this->getPos()[0]}, {$this->getPos()[1]}</li>
            <li>{$this->getPos()[0]}, {$this->getPos()[1]}</li>
        </ul>
    </div>
</div>
EOF;

    }

    public function draw()
    {
        echo $this->getHtml();
    }
}