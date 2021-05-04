<?php

namespace Block\Admin\Product\Edit\Tabs;

\Mage::loadFileByClassName("Block\Core\Edit");

class Form extends \Block\Core\Edit
{
	protected $product = null;
	protected $categoryOptions = [];

	function __construct()
	{
		parent::__construct();
		$this->setTemplate("./view/admin/product/edit/tabs/form.php");
	}

	public function getButton()
	{
		if ($this->getRequest()->getGet('id')) {
			echo 'Update';
		} else {
			echo 'Add';
		}
	}

	public function getCategoryOptions()
	{
		$category = \Mage::getModel('Model\Category');
		if (!$this->categoryOptions) {
			$categoryModel = $category;
			$query = "SELECT `categoryId`,`name` 
			FROM `{$category->getTableName()}` 
			ORDER BY `path`";
			$categoryOptions = $categoryModel->getAdapter()->fetchPairs($query);
			$categoryId = $categoryModel->getData('categoryId');

			$categoryModel->load($categoryId);
			$query = "SELECT `categoryId`,`path` 
			FROM `{$category->getTableName()}` 
			ORDER BY `path`";

			$this->categoryOptions = $categoryModel->getAdapter()->fetchPairs($query);
			if ($this->categoryOptions) {
				foreach ($this->categoryOptions as $categoryId => &$path) {
					$path = explode('=', $path);
					foreach ($path as $key => &$id) {
						if (array_key_exists($id, $categoryOptions)) {
							$id = $categoryOptions[$id];
						}
					}
					$path = implode(' / ', $path);
				}
			}

			return $this->categoryOptions;
		}
	}
}
