<?php

namespace Block\Admin\Product\Edit;

\Mage::loadFileByClassName("Block\Core\Edit\Tabs");

class Tabs extends \Block\Core\Edit\Tabs
{
	public function prepareTabs()
	{
		parent::prepareTabs();
		$this->addTabs('product', ['label' => 'Product Information', 'block' => 'Block\Admin\Product\Edit\Tabs\Form']);
		if ($this->getRequest()->getGet('id')) {
			$this->addTabs('media', ['label' => 'Media Information', 'block' => 'Block\Admin\Product\Edit\Tabs\Media']);
			$this->addTabs('groupPrice', ['label' => 'Customer Group Price', 'block' => 'Block\Admin\Product\Edit\Tabs\GroupPrice']);
			// $this->addTabs('category', ['label' => 'Category Information', 'block' => 'Block\Admin\Product\Edit\Tabs\Category']);
			$this->addTabs('attribute', ['label' => 'Manage Attributes', 'block' => 'Block\Admin\Product\Edit\Tabs\Attribute']);
		}
		$this->setDefaultTab('product');

		return $this;
	}
}
