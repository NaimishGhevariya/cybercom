<?php

namespace Model\Core;

\Mage::loadFileByClassName("Model\Core\Adapter");

class Table
{

    protected $adapter = null;
    protected $primaryKey = null;
    protected $tableName = null;
    public $data = [];

    public function setAdapter()
    {
        $this->adapter = \Mage::getModel('Model\Core\Adapter');
        return $this->adapter;
    }

    public function getAdapter()
    {
        if (!$this->adapter) {
            $this->setAdapter();
        }
        return $this->adapter;
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function setData(array $data)
    {
        $this->data = array_merge($this->data, $data);
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function __get($key)
    {
        if (!array_key_exists($key, $this->data)) {
            return null;
        }
        return $this->data[$key];
    }


    public function save()
    {

        date_default_timezone_set("Asia/Calcutta");
        if (!array_key_exists($this->getPrimaryKey(), $this->getData())) {

            $query = "INSERT INTO `{$this->getTableName()}`
                     (`" . implode("`, `", array_keys($this->getData())) . "`) 
                     VALUES ('" . implode("', '", $this->getData()) . "')";
            $id =  $this->getAdapter()->insert($query);

            $this->load($id);
            return true;
        }
        for ($i = 0; $i < count($this->data); $i++) {
            unset($this->data[$i]);
        }
        foreach ($this->data as $key => $value) {
            if (is_null($value) || $value == '')
                unset($this->data[$key]);
        }
        $strData = null;
        foreach ($this->getData() as $key => $value) {
            if ($key != $this->getPrimaryKey()) {
                $strData .= "`{$key}` = '{$value}', ";
            }
        }
        $strData = substr_replace($strData, "", -2);
        $id = $this->getData()[$this->getPrimaryKey()];
        $query = "UPDATE `{$this->getTableName()}` 
                 SET {$strData} 
                 WHERE `{$this->getPrimaryKey()}` = '{$id}'";
        return $this->getAdapter()->update($query);
    }

    public function load($id)
    {
        $id = (int)$id;
        $query = "SELECT * FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}` = $id ";
        return $this->fetchRow($query);
    }

    public function fetchRow($query)
    {
        $row = $this->getAdapter()->fetchRow($query);
        if (!$row) {
            return false;
        }
        $this->data = $row;
        return $this;
    }

    public function fetchAll($query = null)
    {
        if (!$query) {
            $query = "SELECT * FROM `{$this->getTableName()}`";
        }
        $rows = $this->getAdapter()->fetchAll($query);

        if (!$rows) {
            return $this;
        }
        foreach ($rows as $key => &$value) {
            $key = new $this;
            $value = $key->setData($value);
        }
        $collectionClassName = get_class($this) . '\Collection';
        $collection = \Mage::getModel($collectionClassName);

        $collection->setData($rows);
        unset($rows);
        return $collection;
    }

    public function delete()
    {

        if (!array_key_exists($this->getPrimaryKey(), $this->getData())) {
            return false;
        }
        $id = $this->getData()[$this->getPrimaryKey()];
        $query = "DELETE FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}`=$id";
        return $this->getAdapter()->delete($query);
    }
}
