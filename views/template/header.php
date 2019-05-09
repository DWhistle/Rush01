<?php
session_start();
$page = new Page();
$page->add_css('ships.css');
?>
<html>
<head>
    <title>Warhammer 40000 - Awesome Battleships Battles</title>
    <?= $page->getCss();?>
</head>
<body>