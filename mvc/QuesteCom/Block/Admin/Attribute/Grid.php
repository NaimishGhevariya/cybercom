<?php

namespace Block\Admin\Attribute;

\Mage::loadFileByClassName('Block\Core\Template');

class Grid extends \Block\Core\Template
{
    protected $attributes = [];

    public function __construct()
    {
        $this->setTemplate('./view/admin/attribute/grid.php');
    }

    public function setAttributes($attributes = null)
    {
        if (!$attributes) {
            $attributes = \Mage::getModel('Model\Attribute')->fetchAll();
        }
        $this->attributes = $attributes;
        return $this;
    }

    public function getAttributes()
    {
        if (!$this->attributes) {
            $this->setAttributes();
        }
        return $this->attributes;
    }


    public function getTitle()
    {
        $this->getTitle = 'Manage Attributes';
        return $this->getTitle;
    }
}
