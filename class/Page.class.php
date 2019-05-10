<?php

require_once ('class/IDrawable.class.php');

class Page implements IDrawable
{
    private $css_files;
    private $js_files;

    public function add_js($filename)
    {
        $this->js_files[] = $filename;
    }

    public function add_css($filename)
    {
        $this->css_files[] = $filename;
    }


    public function draw()
    {
        echo $this->getHtml();
    }

    public function getHtml()
    {
        return '';
    }

    public function getCss()
    {
        $css = '';
        foreach ($this->css_files as $css_file) {
            $css .= "<link rel='stylesheet' href='$css_file' />\n";
        }
        return $css;
    }

    public function getJs()
    {
        // TODO: Implement getJs() method.
    }
}