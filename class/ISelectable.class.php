<?php


interface ISelectable
{
    public static function getById($id);
    public static function getAll();
    public function addToDb();
    public static function removeFromDb($id);
}