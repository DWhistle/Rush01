<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/config.php');

class Db
{
    private $mysql;

    public function __construct()
    {
        global $MY_DB;
        $this->mysql = new mysqli($MY_DB['host'], $MY_DB['user'], $MY_DB['pass'], $MY_DB['dbname']);
    }

    public  function __destruct()
    {
        $this->mysql->close();
    }

    public function getFromTable($tableName)
    {
        $sql = "SELECT * FROM $tableName";
        $this->mysql->query($sql);
        $ret = [];
        while ($row = $this->mysql->fetch_asoc())
        {
            $ret[] = $row;
        }
        return ($ret);
    }

    public function getFromTableById($tableName, $id)
    {

        $sql = "SELECT * FROM $tableName WHERE id = $id";
        $result = $this->mysql->query($sql);
        if ($row = $result->fetch_asoc()) {
            $ret = $row;
        }
        else
            $ret = false;
        $result->close();
        return $ret;
    }
}