<?php

namespace Model\Core;

class Adapter
{
    var $config = [
        'host' => 'localhost',
        'user' => 'admin',
        'password' => 'admin',
        'database' => 'questecom'
    ];
    private $connect = null;
    function connection()
    {
        $connect = mysqli_connect($this->config['host'], $this->config['user'], $this->config['password'], $this->config['database']);
        $this->setConnect($connect);
    }

    function getConnect()
    {
        if (!$this->connect) {
            $this->connection();
        }
        return $this->connect;
    }

    function setConnect(\mysqli $connect)
    {
        $this->connect = $connect;
        return $this;
    }

    function isConnected()
    {
        if (!$this->getConnect()) {
            return false;
        }
        return true;
    }

    function error($errno, $error, $query)
    {
        echo $errno . " " . $error . "<br>";
        echo $query;
        exit;
    }

    function select($query)
    {
        if (!$this->isConnected()) {
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        return $result;
    }

    function insert($query)
    {
        if (!$this->isConnected()) {
            $this->connection();
        }
        $result = $this->getConnect()->query($query);

        if ($result) {
            return $this->getConnect()->insert_id;
        }
        return $result;
    }

    function update($query)
    {

        if (!$this->isConnected()) {
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        return $result;
    }

    function delete($query)
    {
        if (!$this->isConnected()) {
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        return $result;
    }

    function fetchRow($query)
    {
        if (!$this->isConnected()) {
            $this->connection();
        }

        $result = $this->getConnect()->query($query);

        $row = $result->fetch_array();
        if (!$row) {
            return false;
        }
        return $row;
    }

    function fetchAll($query)
    {
        if (!$this->isConnected()) {
            $this->connection();
        }
        $result = $this->getConnect()->query($query) or $this->error($this->getConnect()->errno, $this->getConnect()->error, $query);
        $rows = $result->fetch_all($resulttype = MYSQLI_ASSOC);
        if (!$rows) {
            return false;
        }
        return $rows;
    }

    function fetchPairs($query)
    {
        if (!$this->isConnected()) {
            $this->connection();
        }

        $result = $this->getConnect()->query($query) or $this->error($this->getConnect()->errno, $this->getConnect()->error, $query);
        $rows = $result->fetch_all();
        if (!$rows) {
            return $rows;
        }
        $columns = array_column($rows, '0');
        $values = array_column($rows, '1');
        return array_combine($columns, $values);
    }
}
