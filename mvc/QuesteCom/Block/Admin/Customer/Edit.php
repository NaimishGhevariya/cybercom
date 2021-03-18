<?php

namespace Block\Admin\Customer;


\Mage::loadFileByClassName('Block\Core\Edit');

class Edit extends \Block\Core\Edit
{
	public function __construct()
	{
		parent::__construct();
		$this->setTabClass(\Mage::getBlock('Block\Admin\Customer\Edit\Tabs'));
	}

	public function getTitle()
	{
		if ($this->getTableRow()->customerId) {
			echo 'Update customer Details';
		} else {
			echo 'Add customer Details';
		}
	}

	public function getButton()
	{
		if ($this->getTableRow()->customerId) {
			echo 'Update';
		} else {
			echo 'Add';
		}
	}
}
