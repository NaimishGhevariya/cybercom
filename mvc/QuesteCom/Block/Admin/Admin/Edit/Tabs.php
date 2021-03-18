<?php

namespace Block\Admin\Admin\Edit;


\Mage::loadFileByClassName("Block\Core\Edit\Tabs");

class Tabs extends \Block\Core\Edit\Tabs
{
	public function prepareTabs()
	{
		parent::prepareTabs();
		$this->addTabs('admin', ['label' => 'Admin Information', 'block' => 'Block\Admin\Admin\Edit\Tabs\Form']);
		$this->setDefaultTab('admin');
	}
}
