<?php

namespace Block\Admin\Customer;

\Mage::loadFileByClassName("Block\Core\Template");


class Grid extends \Block\Core\Template
{
	protected $customers = [];

	public function __construct()
	{
		$this->setTemplate('./view/admin/customer/grid.php');
	}

	public function setCustomers($customers = NULL)
	{
		if (!$customers) {
			$customer = \Mage::getModel("Model\Customer");
			$customers = $customer->fetchAll()->getData();
		}
		$this->customers = $customers;
		return $this;
	}

	public function getCustomers()
	{
		if (!$this->customers) {
			$this->setCustomers();
		}
		return $this->customers;
	}

	public function getTitle()
	{
		$this->getTitle = 'Manage Customers';
		return $this->getTitle;
	}
}
