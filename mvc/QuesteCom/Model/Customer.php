<?php

namespace Model;

\Mage::loadFileByClassName("Model\Core\Table");
class Customer extends Core\Table
{

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    public function __construct()
    {
        $this->setTableName("customers");
        $this->setPrimaryKey("customerId");
    }

    public function getStatusOptions()
    {
        return [
            self::STATUS_DISABLED => "Disable",
            self::STATUS_ENABLED => "Enable"
        ];
    }
}
