<?php

namespace Model;

\Mage::loadFileByClassName("Model\Core\Table");

class CustomerAddress extends Core\Table
{

    const TYPE_BILLING = 1;
    const TYPE_SHIPPING = 0;

    public function __construct()
    {
        $this->setTableName("customer_address");
        $this->setPrimaryKey("id");
    }

    public function getStatusOptions()
    {
        return [
            self::TYPE_BILLING => "Billing",
            self::TYPE_SHIPPING => "Shipping"
        ];
    }
}
