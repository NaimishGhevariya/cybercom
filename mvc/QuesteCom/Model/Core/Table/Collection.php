<?php

namespace Model\Core\Table;

class Collection
{

    protected $data = [];

    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function getData($key = null)
    {
        if (!$key) {
            return $this->data;
        }
        return $this->data[$key];
    }

    public function count()
    {
        return count($this->data);
    }
}
