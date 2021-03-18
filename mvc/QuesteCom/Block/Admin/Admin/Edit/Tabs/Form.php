<?php

namespace Block\Admin\Admin\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');

class Form extends \Block\Core\Edit
{
	protected $admin = null;
	function __construct()
	{
		parent::__construct();
		$this->setTemplate("./view/admin/admin/edit/tabs/form.php");
	}

	public function getButton()
	{
		if ($this->getTableRow()->adminId) {
			echo 'Update';
		} else {
			echo 'Add';
		}
	}
}
