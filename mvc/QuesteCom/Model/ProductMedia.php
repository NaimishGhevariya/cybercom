<?php

namespace Model;

\Mage::loadFileByClassName("Model\Core\Table");

class ProductMedia extends Core\Table
{

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    public function __construct()
    {
        $this->setTableName("productmedia");
        $this->setPrimaryKey("id");
    }

    public function getStatusOptions()
    {
        return [
            self::STATUS_DISABLED => "Disable",
            self::STATUS_ENABLED => "Enable"
        ];
    }

    public function getImagePath()
    {
        return \Mage::getBaseDir('Uploads\Admin\Product\\');
    }
}
