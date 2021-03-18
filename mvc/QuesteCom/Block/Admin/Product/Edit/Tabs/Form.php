<?php

namespace Block\Admin\Product\Edit\Tabs;

\Mage::loadFileByClassName("Block\Core\Edit");

class Form extends \Block\Core\Edit
{
	protected $product = null;
	function __construct()
	{
		parent::__construct();
		$this->setTemplate("./view/admin/product/edit/tabs/form.php");
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
