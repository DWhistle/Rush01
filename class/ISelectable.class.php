<?php


interface ISelectable
{
    public function getById($id);
    public function getAll();
    public function addToDb();
    public function removeFromDb();
}