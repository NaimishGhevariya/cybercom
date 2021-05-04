<?php

namespace Block\Customer\Layout;

\Mage::loadFileByClassName("Block\Core\Template");

class Message extends \Block\Core\Template
{
	function __construct()
	{
		$this->setTemplate("./view/customer/layout/message.php");
	}
}
