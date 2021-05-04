<?php

namespace Block\Admin\Product;

\Mage::loadFileByClassName("Block\Core\Grid");

class Grid extends \Block\Core\Grid
{
	public function prepareCollection()
	{
		$product = \Mage::getModel("Model\Product");
		if ($this->getFilterObject()->getFilters($this->getTableName())) {
			$collection = $product->fetchAll($this->buildFilterQuery($product->getTableName()))->getData();
		} else {
			$collection = $product->fetchAll()->getData();
		}
		$this->setCollection($collection);
		$this->getStatus();
		return $this;
	}

	public function getTableName()
	{
		return \Mage::getModel('Model\Product')->getTableName();
	}

	public function prepareColumns()
	{
		$tableName = $this->getTableName();
		$this->addColumns('productId', [
			'field' => 'productId',
			'label' => '#',
			'type' => 'number',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'productId')['productId'],

		]);
		$this->addColumns('sku', [
			'field' => 'sku',
			'label' => 'Sku',
			'type' => 'text',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'sku')['sku'],

		]);
		$this->addColumns('name', [
			'field' => 'name',
			'label' => 'Name',
			'type' => 'text',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'name')['name'],

		]);
		$this->addColumns('price', [
			'field' => 'price',
			'label' => 'Price',
			'type' => 'number',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'price')['price'],

		]);
		$this->addColumns('discount', [
			'field' => 'discount',
			'label' => 'Discount',
			'type' => 'number',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'discount')['discount'],

		]);
		$this->addColumns('quantity', [
			'field' => 'quantity',
			'label' => 'Quantity',
			'type' => 'number',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'quantity')['quantity'],

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
		$this->getTitle = 'Manage Products';
		return $this->getTitle;
	}

	// -----> Manage button actions ------

	public function prepareActions()
	{
		$this->addActions('addToCart', [
			'label' => "<i class='fas fa-cart-plus'></i>",
			'method' => 'getAddToCartUrl',
			'ajax' => false
		]);
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

	public function getAddToCartUrl($row)
	{
		return $this->getUrlObject()->getUrl('addToCart', 'cart', ['id' => $row->productId], true);
	}

	public function getEditUrl($row)
	{
		return $this->getUrlObject()->getUrl('form', null, ['id' => $row->productId], true);
	}

	public function getDeleteUrl($row)
	{
		return $this->getUrlObject()->getUrl('delete', null, ['id' => $row->productId], true);
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
