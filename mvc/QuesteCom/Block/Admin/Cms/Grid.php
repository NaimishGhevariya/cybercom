<?php

namespace Block\Admin\Cms;

\Mage::loadFileByClassName("Block\Core\Grid");

class Grid extends \Block\Core\Grid
{
	public function prepareCollection()
	{
		$cms = \Mage::getModel("Model\Cms");
		if ($this->getFilterObject()->getFilters($cms->getTableName())) {
			$collection = $cms->fetchAll($this->buildFilterQuery($cms->getTableName()))->getData();
		} else {
			$collection = $cms->fetchAll()->getData();
		}
		$this->setCollection($collection);
		$this->getStatus();
		return $this;
	}

	public function getTableName()
	{
		return \Mage::getModel('Model\Cms')->getTableName();
	}

	public function prepareColumns()
	{
		$tableName = $this->getTableName();
		$this->addColumns('pageId', [
			'field' => 'pageId',
			'label' => '#',
			'type' => 'number',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'pageId')['pageId'],

		]);
		$this->addColumns('title', [
			'field' => 'title',
			'label' => 'Title',
			'type' => 'text',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'title')['title'],
		]);
		$this->addColumns('identifier', [
			'field' => 'identifier',
			'label' => 'Identifier',
			'type' => 'text',
			'filter' => $this->getFilterObject()->getFilters($tableName, 'identifier')['identifier'],
		]);
		// $this->addColumns('content', [
		// 	'field' => 'content',
		// 	'label' => 'Content',
		// 	'type' => 'text',
		// 	'filter' => $this->getFilterObject()->getFilters($tableName, 'content')['content'],
		// ]);
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
		$this->getTitle = 'Manage Content';
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
		return $this->getUrlObject()->getUrl('form', null, ['id' => $row->pageId], true);
	}

	public function getDeleteUrl($row)
	{
		return $this->getUrlObject()->getUrl('delete', null, ['id' => $row->pageId], true);
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
