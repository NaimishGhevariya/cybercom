<?php

namespace Block\Admin\Cms;

\Mage::loadFileByClassName("Block\Core\Template");

class Grid extends \Block\Core\Template
{
	protected $cmsPages = [];

	public function __construct()
	{
		$this->setTemplate('./view/admin/cms/grid.php');
	}

	public function setCmsPages($cmsPages = NULL)
	{
		if (!$cmsPages) {
			$cmsPage = \Mage::getModel("Model\Cms");
			$cmsPages = $cmsPage->fetchAll()->getData();
		}
		$this->cmsPages = $cmsPages;
		return $this;
	}

	public function getCmsPages()
	{
		if (!$this->cmsPages) {
			$this->setCmsPages();
		}
		return $this->cmsPages;
	}

	public function getTitle()
	{
		$this->getTitle = 'Manage CMS Pages';
		return $this->getTitle;
	}
}
