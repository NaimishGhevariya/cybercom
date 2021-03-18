<?php

namespace Block\Admin\ShippingMethod;

\Mage::loadFileByClassName('Block\Core\Edit');

class Edit extends \Block\Core\Edit
{
	protected $shippingMethod = NULL;

	public function __construct()
	{
		parent::__construct();
		$this->setTabClass(\Mage::getBlock('Block\Admin\ShippingMethod\Edit\Tabs'));
	}

	public function getTitle()
	{
		if ($this->getTableRow()->methodId) {
			echo 'Update ShippingMethod';
		} else {
			echo 'Add ShippingMethod';
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
