<?php

namespace Block\Admin\Cms\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');

class Form extends \Block\Core\Edit
{
	protected $cmsPage = null;
	function __construct()
	{
		parent::__construct();
		$this->setTemplate("./view/admin/cms/edit/tabs/form.php");
	}

	public function setCmsPage($cmsPage = null)
	{
		try {
			if ($cmsPage) {
				$this->cmsPage = $cmsPage;
				return $this;
			}
			$cmsPage = \Mage::getModel("Model\Cms");
			if ($id = $this->getRequest()->getGet('id'))
				$cmsPage = $cmsPage->load($id);

			if (!$cmsPage) {
				throw new \Exception("Id Not Found");
			}
			$this->cmsPage = $cmsPage;
			return $this;
		} catch (\Exception $e) {
			$message = \Mage::getModel("Model\Admin\Message");
			$message->setFailure($e->getMessage());
			$this->redirect('grid');
		}
	}


	public function getCmsPage()
	{
		if (!$this->cmsPage) {
			$this->setCmsPage();
		}
		return $this->cmsPage;
	}

	public function getButton()
	{
		if ($this->getCmsPage()->pageId) {
			echo 'Update';
		} else {
			echo 'Add';
		}
	}
}
