<?php

namespace Model\Core;

\Mage::loadFileByClassName("Model\Core\Adapter");

class Table
{

    protected $adapter = null;
    protected $primaryKey = null;
    protected $tableName = null;
    protected $originalData = [];
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

    public function setOriginalData(array $data)
    {
        $this->originalData = $data;
        return $this;
    }

    public function getOriginalData()
    {
        return $this->originalData;
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

    public function resetData()
    {
        $this->data = [];
        return null;
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function __get($key)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        if (array_key_exists($key, $this->originalData)) {
            return $this->originalData[$key];
        }
        return null;
    }


    public function save()
    {
        date_default_timezone_set("Asia/Calcutta");
        if (!array_key_exists($this->getPrimaryKey(), $this->getData())) {
            unset($this->data[$this->getPrimaryKey()]);
        }
        $id = $this->{$this->primaryKey};

        if (!$this->data) {
            return false;
        }
        // insert 
        if (!$id) {
            $query = "INSERT INTO `{$this->getTableName()}` (`" . implode("`, `", array_keys($this->getData())) . "`) 
                     VALUES ('" . implode("', '", $this->getData()) . "')";
            return $this->getAdapter()->insert($query);
        }
        //update
        for ($i = 0; $i < count($this->data); $i++) {
            unset($this->data[$i]);
        }
        foreach ($this->data as $key => $value) {
            if (is_null($value) || $value == '')
                unset($this->data[$key]);
        }
        $data = null;
        foreach ($this->getData() as $key => $value) {
            if ($key != $this->getPrimaryKey()) {
                $data .= "`{$key}` = '{$value}', ";
            }
        }
        $data = substr_replace($data, "", -2);
        $query = "UPDATE `{$this->getTableName()}` 
                 SET {$data} 
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
        $this->setOriginalData($row);
        $this->resetData();
        return $this;
    }

    public function fetchAll($query = null)
    {
        if (!$query) {
            $query = "SELECT * FROM `{$this->getTableName()}`";
        }

        $rows = $this->getAdapter()->fetchAll($query);
        $collectionClassName = get_class($this) . '\Collection';
        $collection = \Mage::getModel($collectionClassName);
        if ($rows) {
            foreach ($rows as $key => &$value) {
                $row = new $this;
                $value = $row->setOriginalData($value);
            }
            $collection->setData($rows);
        }
        return $collection;
    }

    public function delete()
    {
        if (!array_key_exists($this->getPrimaryKey(), $this->getOriginalData())) {
            return false;
        }
        $id = $this->getOriginalData()[$this->getPrimaryKey()];
        $query = "DELETE FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}`=$id";
        return $this->getAdapter()->delete($query);
    }

    public function alterTable($query)
    {
        if (!$query) {
            return \false;
        }
        $result = $this->getAdapter()->alterTable($query);

        if (!$result) {
            return false;
        }
        return true;
    }
}
