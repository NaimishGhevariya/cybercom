<?php

namespace Block\Core;

\Mage::loadFileByClassName('Block\Core\Template');

class Edit extends Template
{
    protected $tab = null;
    protected $tableRow = null;
    protected $tabClass = null;

    function __construct()
    {
        parent::__construct();
        $this->setTemplate("./view/core/edit.php");
    }

    public function getTabContent()
    {
        $tabBlock = $this->getTab();
        $tabs = $tabBlock->getTabs();
        $tab = $this->getRequest()->getGet('tab', $tabBlock->getDefaultTab());
        if (!array_key_exists($tab, $tabs)) {
            return null;
        }
        $blockClassName = $tabs[$tab]['block'];
        $block = \Mage::getBlock($blockClassName);
        $block->setTableRow($this->getTableRow());
        return $block;
    }

    public function getTabHtml()
    {
        $tabBlock = $this->getTab();
        return $tabBlock->toHtml();
    }

    public function setTab($tab = null)
    {
        if (!$tab) {
            $tab = $this->getTabClass();
        }
        $tab->setTableRow($this->getTableRow());
        $this->tab = $tab;
        return $this;
    }

    public function getTab()
    {
        if (!$this->tab) {
            $this->setTab();
        }
        return $this->tab;
    }

    public function setTableRow(\Model\Core\Table $tableRow)
    {
        $this->tableRow = $tableRow;
        return $this;
    }

    public function getTableRow()
    {
        return $this->tableRow;
    }

    public function getFormUrl()
    {
        $id = $this->getRequest()->getGet('id');
        return $this->getUrl('save', null, ['id' => $id], null);
    }

    public function setTabClass($tabClass)
    {
        $this->tabClass = $tabClass;
        return $this;
    }

    public function getTabClass()
    {
        return $this->tabClass;
    }
}
