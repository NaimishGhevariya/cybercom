<?php

namespace Block\Admin\Product;

\Mage::loadFileByClassName('Block\Core\Edit');

class Edit extends \Block\Core\Edit
{
	public function __construct()
	{
		parent::__construct();
		$this->setTabClass(\Mage::getBlock('Block\Admin\Product\Edit\Tabs'));
	}

	public function getTitle()
	{
		if ($this->getTableRow()->productId) {
			echo 'Update Product Details';
		} else {
			echo 'Add Product Details';
		}
	}

	public function getButton()
	{
		if ($this->getTableRow()->productId) {
			echo 'Update';
		} else {
			echo 'Add';
		}
	}
}
