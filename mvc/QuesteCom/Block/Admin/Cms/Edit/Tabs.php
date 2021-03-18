<?php

namespace Block\Admin\Cms\Edit;

\Mage::loadFileByClassName("Block\Core\Edit\Tabs");

class Tabs extends \Block\Core\Edit\Tabs
{
	public function prepareTabs()
	{
		parent::prepareTabs();
		$this->addTabs('cms', ['label' => 'CMS Page', 'block' => 'Block\Admin\Cms\Edit\Tabs\Form']);
		$this->setDefaultTab('cms');
	}
}
