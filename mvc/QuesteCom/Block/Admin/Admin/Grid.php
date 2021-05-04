<?php

namespace Block\Admin\Admin;

\Mage::loadFileByClassName("Block\Core\Grid");

class Grid extends \Block\Core\Grid
{
	public function prepareCollection()
	{
		$admin = \Mage::getModel("Model\Admin");
		if ($this->getFilterObject()->getFilters($admin->getTableName())) {
			$collection = $admin->fetchAll($this->buildFilterQuery($admin->getTableName()))->getData();
		} else {
			$collection = $admin->fetchAll()->getData();
		}
		$this->setCollection($collection);
		$this->getStatus();
		return $this;
	}

	public function getTableName()
	{
		return \Mage::getModel('Model\Admin')->getTableName();
	}

	public function prepareColumns()
	{
		$tableName = $this->getTableName();
		$this->addColumns('adminId', [
			'field' => 'adminId',
			'label' => '#',
			'type' => 'number',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'adminId')['adminId'],
		]);
		$this->addColumns('username', [
			'field' => 'username',
			'label' => 'Username',
			'type' => 'text',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'username')['username'],
		]);
		$this->addColumns('emailId', [
			'field' => 'emailId',
			'label' => 'Email Id',
			'type' => 'text',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'emailId')['emailId'],
		]);
		$this->addColumns('password', [
			'field' => 'password',
			'label' => 'Password',
			'type' => 'text',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'password')['password'],
		]);
		$this->addColumns('status', [
			'field' => 'status',
			'label' => 'Status',
			'type' => 'text',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'status')['status'],
		]);
		$this->addColumns('createdDate', [
			'field' => 'createdDate',
			'label' => 'Created On',
			'type' => 'date',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'createdDate')['createdDate'],
		]);
		$this->addColumns('updatedDate', [
			'field' => 'updatedDate',
			'label' => 'Modified On',
			'type' => 'date',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'updatedDate')['updatedDate'],
		]);

		return $this;
	}

	public function getTitle()
	{
		$this->getTitle = 'Manage Admins';
		return $this->getTitle;
	}

	// -----> Manage button actions ------

	public function prepareActions()
	{
		$this->addActions('edit', [
			'label' => "<i class='fas fa-pen'></i>",
			'method' => 'getEditUrl',
			'ajax' => false
		]);
		$this->addActions('delete', [
			'label' => '<i class="fas fa-trash-alt" style="color:tomato"></i>',
			'method' => 'getDeleteUrl',
			'ajax' => false
		]);
		return $this;
	}

	public function getEditUrl($row)
	{
		return $this->getUrlObject()->getUrl('form', null, ['id' => $row->adminId], true);
	}

	public function getDeleteUrl($row)
	{
		return $this->getUrlObject()->getUrl('delete', null, ['id' => $row->adminId], true);
	}



	// -----> Manage buttons ------

	public function prepareButtons()
	{
		$this->addButtons('addnew', [
			'label' => '<i class="fas fa-plus"></i> Add New',
			'method' => 'AddNewUrl',
			'ajax' => false,
		]);
		$this->addButtons('applyFilter', [
			'label' => '<i class="fas fa-filter"></i> Apply Filter',
			'method' => 'getFilterAction',
			'ajax' => false,
		]);
		if ($this->getFilterObject()->getFilters($this->getTableName()) != null) {
			$this->addButtons('clearFilter', [
				'label' => '<i class="fas fa-times-circle"></i> Clear Filters',
				'method' => 'getClearFilterAction',
				'ajax' => false,
			]);
			return $this;
		}
	}

	public function getStatus()
	{
		$collection = $this->getCollection();
		foreach ($collection as &$row) {
			if ($row->status) {
				$row->status = 'Enable';
			} else {
				$row->status = 'Disable';
			}
		}
		return;
	}
}
