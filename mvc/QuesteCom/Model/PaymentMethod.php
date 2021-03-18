<?php

namespace Model;

\Mage::loadFileByClassName("Model\Core\Table");

class PaymentMethod extends Core\Table
{

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    public function __construct()
    {
        $this->setTableName("paymentmethod");
        $this->setPrimaryKey("methodId");
    }

    public function getStatusOptions()
    {
        return [
            self::STATUS_DISABLED => "Disable",
            self::STATUS_ENABLED => "Enable"
        ];
    }
}
