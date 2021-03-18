<?php

namespace Block\Core\Layout;

\Mage::loadFileByClassName("Block\Core\Template");

class Message extends \Block\Core\Template
{
	function __construct()
	{
		$this->setTemplate("./view/core/layout/message.php");
	}
}
