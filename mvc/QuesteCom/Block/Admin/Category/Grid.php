<?php

namespace Block\Admin\Category;

\Mage::loadFileByClassName("Block\Core\Grid");

class Grid extends \Block\Core\Grid
{
	protected $categoriesOptions  = [];

	public function prepareCollection()
	{
		$category = \Mage::getModel("Model\Category");
		if ($this->getFilterObject()->getFilters($category->getTableName())) {
			$collection = $category->fetchAll($this->buildFilterQuery($category->getTableName()))->getData();
		} else {
			$collection = $category->fetchAll()->getData();
		}
		$this->setCollection($collection);
		$this->getStatus();
		$this->getFeatured();
		$this->getName();
		return $this;
	}

	public function getTableName()
	{
		return \Mage::getModel('Model\Category')->getTableName();
	}

	public function prepareColumns()
	{
		$tableName = $this->getTableName();
		$this->addColumns('categoryId', [
			'field' => 'categoryId',
			'label' => '#',
			'type' => 'number',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'categoryId')['categoryId'],
		]);
		// $this->addColumns('parentId', [
		// 	'field' => 'parentId',
		// 	'label' => 'Parent Id',
		// 	'type' => 'number',
		// 	'filter' => $this->getFilterObject()->getFilters($tableName, 'parentId')['parentId'],
		// ]);
		$this->addColumns('name', [
			'field' => 'name',
			'label' => 'Name',
			'type' => 'text',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'name')['name'],
		]);
		// $this->addColumns('path', [
		// 	'field' => 'path',
		// 	'label' => 'Path',
		// 	'type' => 'text',
		// 	'filter' => $this->getFilterObject()->getFilters($tableName, 'path')['path'],
		// ]);
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

		$this->addColumns('featured', [
			'field' => 'featured',
			'label' => 'Featured',
			'type' => 'text',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'featured')['featured'],
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
		$this->getTitle = 'Manage Categories';
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
		return $this->getUrlObject()->getUrl('form', null, ['id' => $row->categoryId], true);
	}

	public function getDeleteUrl($row)
	{
		return $this->getUrlObject()->getUrl('delete', null, ['id' => $row->categoryId], true);
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

	public function getFeatured()
	{
		$collection = $this->getCollection();
		foreach ($collection as &$row) {
			if ($row->featured) {
				$row->featured = 'Yes';
			} else {
				$row->featured = 'No';
			}
		}
		return;
	}

	public function getName()
	{
		$collection = $this->getCollection();
		foreach ($collection as &$row) {
			$categoryModel =  \Mage::getModel("Model\Category");
			if (!$this->categoriesOptions) {
				$query = "SELECT `categoryId`,`name` FROM `{$categoryModel->getTableName()}`";
				$this->categoriesOptions = $categoryModel->getAdapter()->fetchPairs($query);
			}
			$paths = explode("=", $row->path);
			foreach ($paths as $key => &$id) {
				if (array_key_exists($id, $this->categoriesOptions)) {
					$id = $this->categoriesOptions[$id];
				}
			}
			$name = implode("/", $paths);
			$row->name = $name;
		}
		return;
	}
}
