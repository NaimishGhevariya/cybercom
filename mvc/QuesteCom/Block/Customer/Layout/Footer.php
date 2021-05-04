<?php

namespace Block\Customer\Layout;

\Mage::loadFileByClassName("Block\Core\Template");

class Footer extends \Block\Core\Template
{

	function __construct()
	{
		$this->setTemplate("./view/customer/layout/footer.php");
	}
}
