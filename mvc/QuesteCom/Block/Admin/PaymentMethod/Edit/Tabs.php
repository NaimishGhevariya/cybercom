<?php

namespace Block\Admin\PaymentMethod\Edit;

\Mage::loadFileByClassName("Block\Core\Edit\Tabs");

class Tabs extends \Block\Core\Edit\Tabs
{

	public function prepareTabs()
	{
		parent::prepareTabs();
		$this->addTabs('paymentMethod', ['label' => 'Payment Methods', 'block' => 'Block\Admin\PaymentMethod\Edit\Tabs\Form']);
		$this->setDefaultTab('paymentMethod');
	}
}
