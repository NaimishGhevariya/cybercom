<?php

namespace Block\Customer;

\Mage::loadFIleByClassName('Block\Core\Template');

class Layout extends \Block\Core\Template
{
    protected $children = [];
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./view/customer/layout.php');
        $this->prepareChildren();
    }
    public function prepareChildren()
    {
        $this->addChild(\Mage::getBlock('Block\Customer\Layout\Header'), 'header');
        $this->addChild(\Mage::getBlock('Block\Customer\Layout\Left'), 'left');
        $this->addChild(\Mage::getBlock('Block\Customer\Layout\Content'), 'content');
        // $this->addChild(\Mage::getBlock('Block\Customer\Layout\Right'), 'right');
        $this->addChild(\Mage::getBlock('Block\Customer\Layout\Footer'), 'footer');
    }
}
