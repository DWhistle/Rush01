<?php
session_start();
require_once ('class/Page.class.php');
$page = new Page();
$page->add_css('/css/ship_style.css');
$page->add_css('/css/map_style.css');
$page->add_css('/css/player_style.css');
?>
<html>
<head>
    <title>Warhammer 40000 - Awesome Battleships Battles</title>
    <?= $page->getCss();?>
</head>
<body>