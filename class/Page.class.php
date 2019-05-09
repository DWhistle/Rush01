<?php


class Page
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
}