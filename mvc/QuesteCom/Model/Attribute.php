<?php

namespace Model;

\Mage::loadFileByClassName("Model\Core\Table");

class Attribute extends Core\Table
{
    public function __construct()
    {
        $this->setTableName("attribute");
        $this->setPrimaryKey("attributeId");
    }
}
