<?php

namespace Block\Customer\Layout;

\Mage::loadFileByClassName("Block\Core\Template");

class Header extends \Block\Core\Template
{
	function __construct()
	{
		$this->setTemplate("./view/customer/layout/header.php");
	}
}
