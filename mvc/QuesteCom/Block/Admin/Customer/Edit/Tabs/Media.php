<?php

namespace Block\Admin\Customer\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');

class Media extends \Block\Core\Edit
{

	function __construct()
	{
		$this->setTemplate("./view/admin/customer/edit/tabs/media.php");
	}
}
