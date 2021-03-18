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
			$query = "SELECT `categoryId`,`name` FROM `{$this->getTableRow()->getTableName()}`";
			$this->categoryOptions = $this->getTableRow()->getAdapter()->fetchPairs($query);

			$this->categoryOptions = ["0" => "Root Category"] + $this->categoryOptions;
		}

		return $this->categoryOptions;
	}
}
