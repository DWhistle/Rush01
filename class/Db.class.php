<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');

class Db
{
    private $mysql;

    public function __construct()
    {
        global $MY_DB;

        $this->mysql = new mysqli(
            $MY_DB['host'],
            $MY_DB['dblogin'],
            $MY_DB['dbpass'],
            $MY_DB['dbname']);
    }

    public function getFromSelect($sql)
    {
        $query = $this->mysql->query($sql);
        $ret = [];
        while ($row = $query->fetch_assoc())
        {
            $ret[] = $row;
        }
        $query->close();
        return $ret;
    }

    public function __destruct()
    {
        $this->mysql->close();
    }

    public function getTable($tablename)
    {
        $sql = "SELECT * FROM $tablename;";
        $query = $this->mysql->query($sql);
        $ret = [];
        while ($row = $query->fetch_assoc())
        {
            $ret[] = $row;
        }
        $query->close();
        return $ret;
    }


    public function getTableById($tablename, $id)
    {
        $sql = "SELECT * FROM $tablename WHERE id = $id";
        $query = $this->mysql->query($sql);
        $ret = [];
        if ($row = $query->fetch_assoc())
            $ret = $row;
        else $ret = false;
        $query->close();
        return $ret;
    }

    public function execute($sql)
    {
        $query  = $this->mysql->query($sql);
        $ret =  ($query === true)
            ? [
                'num' => $query->num_rows,
                'id' => $this->mysql->insert_id]
            : false;
        $query->close();
        return $ret;
    }

}