<?php

namespace Block\Admin\Product;

\Mage::loadFileByClassName("Block\Core\Template");

class Grid extends \Block\Core\Template
{
	protected $products = [];

	public function __construct()
	{
		$this->setTemplate('./view/admin/product/grid.php');
	}

	public function setProducts($products = NULL)
	{
		if (!$products) {
			$product = \Mage::getModel("Model\Product");
			$products = $product->fetchAll()->getData();
		}
		$this->products = $products;
		return $this;
	}

	public function getProducts()
	{
		if (!$this->products) {
			$this->setProducts();
		}
		return $this->products;
	}

	public function getTitle()
	{
		$this->getTitle = 'Manage products';
		return $this->getTitle;
	}
}
