<?php

namespace Block\Admin\ShippingMethod\Edit;

\Mage::loadFileByClassName("Block\Core\Edit\Tabs");


class Tabs extends \Block\Core\Edit\Tabs
{

	public function prepareTabs()
	{
		parent::prepareTabs();
		$this->addTabs('shippingMethod', ['label' => 'Shipping Methods', 'block' => 'Block\Admin\ShippingMethod\Edit\Tabs\Form']);
		$this->setDefaultTab('shippingMethod');
	}
}
