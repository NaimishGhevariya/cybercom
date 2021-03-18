<?php

namespace Block\Core\Layout;

\Mage::loadFileByClassName("Block\Core\Template");

class Left extends \Block\Core\Template
{

	function __construct()
	{
		$this->setTemplate("./view/core/layout/left.php");
	}
}
