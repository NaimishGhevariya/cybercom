<?php

namespace Block\Admin\PaymentMethod\Edit\Tabs;

\Mage::loadFileByClassName("Block\Core\Edit");

class Form extends \Block\Core\Edit
{
	protected $paymentMethod = null;
	function __construct()
	{
		parent::__construct();
		$this->setTemplate("./view/admin/paymentMethod/edit/tabs/form.php");
	}

	public function setPaymentMethod($paymentMethod = null)
	{
		try {
			if ($paymentMethod) {
				$this->paymentMethod = $paymentMethod;
				return $this;
			}
			$paymentMethod = \Mage::getModel("Model\PaymentMethod");
			if ($id = $this->getRequest()->getGet('id'))
				$paymentMethod = $paymentMethod->load($id);

			if (!$paymentMethod) {
				throw new \Exception("Id Not Found");
			}
			$this->paymentMethod = $paymentMethod;
			return $this;
		} catch (\Exception $e) {
			$message = \Mage::getModel("Model\Admin\Message");
			$message->setFailure($e->getMessage());
			$this->redirect('grid');
		}
	}


	public function getPaymentMethod()
	{
		if (!$this->paymentMethod) {
			$this->setPaymentMethod();
		}
		return $this->paymentMethod;
	}

	public function getButton()
	{
		if ($this->getPaymentMethod()->methodId) {
			echo 'Update';
		} else {
			echo 'Add';
		}
	}
}
