<?php

namespace Block\Admin\Cart\Checkout\Invoice;

\Mage::loadFileByClassName('Block\Core\Template');

class Invoice extends \Block\Core\Template
{
    protected $products = [];

    public function __construct()
    {
        $this->setTemplate('View/Admin/Cart/Checkout/Invoice/invoice.php');
    }

    public function getCart()
    {
        $cart = \Mage::getModel('Model\Cart');
        $session = \Mage::getModel('Model\Admin\Session');
        $cart = $cart->getCart($session->activeCustomerId);
        if (!$cart) {
            return false;
        }
        return $cart;
    }

    public function getBillingAddress()
    {
        $cart = $this->getCart();
        $billing = $cart->getBillingAddress();
        return $billing;
    }

    public function getCustomer()
    {
        return $this->getCart()->getCustomer();
    }

    public function getProduct()
    {
        $cartItem = \Mage::getModel('Model\Cart')->getCart()->getItems();
        foreach ($cartItem->getData() as $key => $value) {
            $product = \Mage::getModel('Model\Product')->load($value->productId)->getOriginalData();
            $this->products[$key] = $product;
        }
        return $this->products;
    }

    public function getCartItem()
    {
        $cartItem = $this->getCart()->getItems();
        return $cartItem;
    }
}
