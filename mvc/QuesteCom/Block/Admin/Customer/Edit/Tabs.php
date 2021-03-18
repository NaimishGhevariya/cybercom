<?php

namespace Block\Admin\Customer\Edit;

\Mage::loadFileByClassName("Block\Core\Edit\Tabs");

class Tabs extends \Block\Core\Edit\Tabs
{
	public function prepareTabs()
	{
		parent::prepareTabs();
		$this->addTabs('customer', ['label' => 'Customer Information', 'block' => 'Block\Admin\Customer\Edit\Tabs\Form']);
		$this->addTabs('address', ['label' => 'Address Information', 'block' => 'Block\Admin\Customer\Edit\Tabs\Address']);
		$this->setDefaultTab('customer');
	}
}
