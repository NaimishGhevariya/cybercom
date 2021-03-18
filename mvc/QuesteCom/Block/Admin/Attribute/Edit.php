<?php

namespace Block\Admin\Attribute;

\Mage::loadFileByClassName('Block\Core\Edit');

class Edit extends \Block\Core\Edit
{
    public function __construct()
    {
        parent::__construct();
        $this->setTabClass(\Mage::getBlock('Block\Admin\Attribute\Edit\Tabs'));
    }

    public function getTitle()
    {
        if ($this->getTableRow()->attributeId) {
            echo 'Update Attribute Details';
        } else {
            echo 'Add Attribute Details';
        }
    }

    public function getButton()
    {
        if ($this->getTableRow()->AttributeId) {
            echo 'Update';
        } else {
            echo 'Add';
        }
    }
}
