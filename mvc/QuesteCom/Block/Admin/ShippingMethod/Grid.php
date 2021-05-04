<?php

namespace Block\Admin\ShippingMethod;

\Mage::loadFileByClassName("Block\Core\Grid");

class Grid extends \Block\Core\Grid
{
	public function prepareCollection()
	{
		$shippingMethod = \Mage::getModel("Model\ShippingMethod");
		if ($this->getFilterObject()->getFilters($shippingMethod->getTableName())) {
			$collection = $shippingMethod->fetchAll($this->buildFilterQuery($shippingMethod->getTableName()))->getData();
		} else {
			$collection = $shippingMethod->fetchAll()->getData();
		}
		$this->setCollection($collection);
		$this->getStatus();
		return $this;
	}
	public function getTableName()
	{
		return \Mage::getModel('Model\ShippingMethod')->getTableName();
	}
	public function prepareColumns()
	{
		$tableName = $this->getTableName();
		$this->addColumns('methodId', [
			'field' => 'methodId',
			'label' => '#',
			'type' => 'number',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'methodId')['methodId'],
		]);
		$this->addColumns('name', [
			'field' => 'name',
			'label' => 'Name',
			'type' => 'text',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'name')['name'],
		]);
		$this->addColumns('code', [
			'field' => 'code',
			'label' => 'Shipping Code',
			'type' => 'text',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'code')['code'],
		]);
		$this->addColumns('amount', [
			'field' => 'amount',
			'label' => 'Amount',
			'type' => 'number',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'amount')['amount'],
		]);
		$this->addColumns('description', [
			'field' => 'description',
			'label' => 'Description',
			'type' => 'text',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'description')['description'],
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

		return $this;
	}

	public function getTitle()
	{
		$this->getTitle = 'Manage Shipping Methods';
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
		return $this->getUrlObject()->getUrl('form', null, ['id' => $row->methodId], true);
	}

	public function getDeleteUrl($row)
	{
		return $this->getUrlObject()->getUrl('delete', null, ['id' => $row->methodId], true);
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
