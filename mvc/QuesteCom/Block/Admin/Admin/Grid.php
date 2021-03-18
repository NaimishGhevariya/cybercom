<?php

namespace Block\Admin\Admin;

\Mage::loadFileByClassName("Block\Core\Template");

class Grid extends \Block\Core\Template
{
	protected $admins = [];

	public function __construct()
	{
		$this->setTemplate('./view/admin/admin/grid.php');
	}

	public function setAdmins($admins = NULL)
	{
		if (!$admins) {
			$admin = \Mage::getModel("Model\Admin");
			$admins = $admin->fetchAll()->getData();
		}
		$this->admins = $admins;
		return $this;
	}

	public function getAdmins()
	{
		if (!$this->admins) {
			$this->setAdmins();
		}
		return $this->admins;
	}

	public function getTitle()
	{
		$this->getTitle = 'Manage Admins';
		return $this->getTitle;
	}
}
