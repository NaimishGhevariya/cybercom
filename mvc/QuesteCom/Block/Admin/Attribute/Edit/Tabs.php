<?php

namespace Block\Admin\Attribute\Edit;


\Mage::loadFileByClassName("Block\Core\Edit\Tabs");

class Tabs extends \Block\Core\Edit\Tabs
{
    public function prepareTabs()
    {
        parent::prepareTabs();
        $this->addTabs('attribute', ['label' => 'Attribute', 'block' => 'Block\Admin\Attribute\Edit\Tabs\Form']);
        if ($this->getRequest()->getGet('id')) {
            $this->addTabs('option', ['label' => 'Options', 'block' => 'Block\Admin\Attribute\Edit\Tabs\OptionGrid']);
        }
        $this->setDefaultTab('attribute');
    }
}
