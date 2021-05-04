<?php

namespace Block\Customer\Layout;

\Mage::loadFileByClassName("Block\Core\Template");

class Left extends \Block\Core\Template
{

	function __construct()
	{
		$this->setTemplate("./view/customer/layout/left.php");
	}
}
