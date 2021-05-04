<?php

namespace Block\Admin\Category\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');

class Form extends \Block\Core\Edit
{
	protected $category = null;
	protected $categoryOptions = [];

	function __construct()
	{
		parent::__construct();
		$this->setTemplate("./view/admin/category/edit/tabs/form.php");
	}


	public function getButton()
	{
		if ($this->getTableRow()->categoryId) {
			echo 'Update';
		} else {
			echo 'Add';
		}
	}

	public function getCategoryOptions()
	{
		if (!$this->categoryOptions) {
			$categoryModel = $this->getTableRow();
			$query = "SELECT `categoryId`,`name` 
			FROM `{$this->getTableRow()->getTableName()}` 
			ORDER BY `path`";
			$categoryOptions = $categoryModel->getAdapter()->fetchPairs($query);
			$categoryId = $categoryModel->getData('categoryId');

			$categoryModel->load($categoryId);
			$query = "SELECT `categoryId`,`path` 
			FROM `{$this->getTableRow()->getTableName()}` 
			WHERE `categoryId` != '{$categoryModel->categoryId}' AND `path` NOT LIKE '{$categoryModel->path}=%' 
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

			$this->categoryOptions = ["0" => "Root Category"] + $this->categoryOptions;
			return $this->categoryOptions;
		}
	}
}
