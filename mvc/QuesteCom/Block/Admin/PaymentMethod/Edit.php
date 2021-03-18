<?php

namespace Block\Admin\PaymentMethod;

\Mage::loadFileByClassName('Block\Core\Edit');

class Edit extends \Block\Core\Edit
{
	public function __construct()
	{
		parent::__construct();
		$this->setTabClass(\Mage::getBlock('Block\Admin\PaymentMethod\Edit\Tabs'));
	}

	public function getTitle()
	{
		if ($this->getTableRow()->methodId) {
			echo 'Update PaymentMethod';
		} else {
			echo 'Add PaymentMethod';
		}
	}

	public function getButton()
	{
		if ($this->getTableRow()->methodId) {
			echo 'Update';
		} else {
			echo 'Add';
		}
	}
}
