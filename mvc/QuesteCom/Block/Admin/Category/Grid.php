<?php

namespace Block\Admin\Category;

\Mage::loadFileByClassName("Block\Core\Template");

class Grid extends \Block\Core\Template
{
	protected $categories = [];
	protected $categoriesOptions = [];


	public function __construct()
	{
		$this->setTemplate('./view/admin/category/grid.php');
	}

	public function setCategories($categories = NULL)
	{
		if (!$categories) {
			$category = \Mage::getModel("Model\Category");
			$categories = $category->fetchAll()->getData();
		}
		$this->categories = $categories;
		return $this;
	}

	public function getCategories()
	{
		if (!$this->categories) {
			$this->setCategories();
		}
		return $this->categories;
	}

	public function getTitle()
	{
		$this->getTitle = 'Manage categories';
		return $this->getTitle;
	}

	public function getName($category)
	{
		$categoryModel =  \Mage::getModel("Model\Category");
		if (!$this->categoriesOptions) {
			$query = "SELECT `categoryId`,`name` FROM `{$categoryModel->getTableName()}`";
			$this->categoriesOptions = $categoryModel->getAdapter()->fetchPairs($query);
		}
		$paths = explode("=", $category->path);
		foreach ($paths as $key => &$id) {
			if (array_key_exists($id, $this->categoriesOptions)) {
				$id = $this->categoriesOptions[$id];
			}
		}
		$name = implode("/", $paths);
		return $name;
	}
}
