<?php

namespace Block\Admin\ShippingMethod\Edit\Tabs;

\Mage::loadFileByClassName("Block\Core\Edit");

class Form extends \Block\Core\Edit
{
	protected $shippingMethod = null;
	function __construct()
	{
		parent::__construct();
		$this->setTemplate("./view/admin/shippingMethod/edit/tabs/form.php");
	}

	public function setShippingMethod($shippingMethod = null)
	{
		try {
			if ($shippingMethod) {
				$this->shippingMethod = $shippingMethod;
				return $this;
			}
			$shippingMethod = \Mage::getModel("Model\ShippingMethod");
			if ($id = $this->getRequest()->getGet('id'))
				$shippingMethod = $shippingMethod->load($id);

			if (!$shippingMethod) {
				throw new \Exception("Id Not Found");
			}
			$this->shippingMethod = $shippingMethod;
			return $this;
		} catch (\Exception $e) {
			$message = \Mage::getModel("Model\Core\Message");
			$message->setFailure($e->getMessage());
			$this->redirect('grid');
		}
	}


	public function getShippingMethod()
	{
		if (!$this->shippingMethod) {
			$this->setShippingMethod();
		}
		return $this->shippingMethod;
	}

	public function getButton()
	{
		if ($this->getShippingMethod()->methodId) {
			echo 'Update';
		} else {
			echo 'Add';
		}
	}
}
