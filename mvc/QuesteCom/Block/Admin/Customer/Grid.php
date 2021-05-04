<?php

namespace Block\Admin\Customer;

\Mage::loadFileByClassName("Block\Core\Grid");

class Grid extends \Block\Core\Grid
{
	public function prepareCollection()
	{
		$customer = \Mage::getModel("Model\Customer");
		if ($this->getFilterObject()->getFilters($customer->getTableName())) {
			$collection = $customer->fetchAll($this->buildFilterQuery($customer->getTableName()))->getData();
		} else {
			$collection = $customer->fetchAll()->getData();
		}
		$this->setCollection($collection);
		$this->getStatus();
		return $this;
	}

	public function getTableName()
	{
		return \Mage::getModel('Model\Customer')->getTableName();
	}

	public function prepareColumns()
	{
		$tableName = $this->getTableName();
		$this->addColumns('customerId', [
			'field' => 'customerId',
			'label' => '#',
			'type' => 'number',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'customerId')['customerId'],

		]);
		$this->addColumns('firstName', [
			'field' => 'firstName',
			'label' => 'First Name',
			'type' => 'text',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'firstName')['firstName'],

		]);
		$this->addColumns('lastName', [
			'field' => 'lastName',
			'label' => 'Last Name',
			'type' => 'text',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'lastName')['lastName'],

		]);
		$this->addColumns('email', [
			'field' => 'email',
			'label' => 'Email',
			'type' => 'email',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'email')['email'],
		]);
		$this->addColumns('password', [
			'field' => 'password',
			'label' => 'Password',
			'type' => 'text',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'password')['password'],
		]);
		$this->addColumns('mobile', [
			'field' => 'mobile',
			'label' => 'MobileNo.',
			'type' => 'text',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'mobile')['mobile'],
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
		$this->getTitle = 'Manage Customers';
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
		return $this->getUrlObject()->getUrl('form', null, ['id' => $row->customerId], true);
	}

	public function getDeleteUrl($row)
	{
		return $this->getUrlObject()->getUrl('delete', null, ['id' => $row->customerId], true);
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
