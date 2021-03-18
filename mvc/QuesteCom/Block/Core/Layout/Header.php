<?php

namespace Block\Core\Layout;

\Mage::loadFileByClassName("Block\Core\Template");

class Header extends \Block\Core\Template
{
	function __construct()
	{
		$this->setTemplate("./view/core/layout/header.php");
	}
}
