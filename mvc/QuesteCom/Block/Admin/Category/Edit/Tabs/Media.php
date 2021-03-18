<?php

namespace Block\Admin\Category\Edit\Tabs;

\Mage::loadFileByClassName("Block\Core\Template");
class Media extends \Block\Core\Template
{

	function __construct()
	{
		$this->setTemplate("./view/admin/category/edit/tabs/media.php");
	}
}
