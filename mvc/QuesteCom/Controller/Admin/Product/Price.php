<?php

namespace Controller\Admin\Product;

\Mage::loadFileByClassName("Controller\Core\Admin");

class Price extends \Controller\Core\Admin
{
	public function indexAction()
	{
		try {
			$productId = $this->getRequest()->getGet('id');
			echo $productId;
			$product = \Mage::getModel("Model\Product")->load($productId);
			if (!$product) {
				throw new \Exception("No Record Found", 1);
			}
			$layout = $this->getLayout();
			$grid = \Mage::getBlock("Block\Admin\Product\Edit\Tabs\GroupPrice")->setProduct($product);
			$content = $layout->getChild('content')->addChild($grid);
			echo $this->toHtmlLayout();
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}

	public function saveAction()
	{
		$groupData = $this->getRequest()->getPost('groupPrice');
		$productId = $this->getRequest()->getGet('id');

		foreach ($groupData['exist'] as $groupId => $price) {

			$query = "SELECT * FROM `product_group_price`
				 WHERE `productId` = '{$productId}' AND `customerGroupId` = '{$groupId}' ";
			$groupPrice = \Mage::getModel("Model\Product\Price");
			$groupPrice->fetchRow($query);
			$groupPrice->price = $price;
			$groupPrice->save();
		}

		foreach ($groupData['new'] as $groupId => $price) {
			$groupPrice = \Mage::getModel("Model\Product\Price");
			$groupPrice->customerGroupId = $groupId;
			$groupPrice->productId = $productId;
			$groupPrice->price = $price;
			$groupPrice->save();
		}
		$this->redirect('form', 'product', ['id' => $productId], true);
	}
}
