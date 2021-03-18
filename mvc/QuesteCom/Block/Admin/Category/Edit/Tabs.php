<?php

namespace Block\Admin\Category\Edit;

\Mage::loadFileByClassName("Block\Core\Edit\Tabs");

class Tabs extends \Block\Core\Edit\Tabs
{
	public function prepareTabs()
	{
		parent::prepareTabs();
		$this->addTabs('category', ['label' => 'Category Information', 'block' => 'Block\Admin\Category\Edit\Tabs\Form']);
		//$this->addTabs('media', ['label' => 'Media Information', 'block' => 'Block\Admin\Category\Edit\Tabs\Media']);
		$this->setDefaultTab('category');
	}
}
