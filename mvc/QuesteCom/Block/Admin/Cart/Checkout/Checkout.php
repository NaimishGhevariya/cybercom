<?php

namespace Block\Admin\Cart\Checkout;

\Mage::loadFileByClassName("Block\Core\Template");

class Checkout extends \Block\Core\Template
{
    protected $address = null;
    protected $billing = null;
    protected $shipping = null;
    protected $cart = null;

    function __construct()
    {
        $this->setTemplate("./view/admin/cart/checkout/checkout.php");
    }

    public function getCart()
    {
        $cart = \Mage::getModel('Model\Cart');
        $session = \Mage::getModel('Model\Admin\Session');
        $cart = $cart->getCart($session->activeCustomerId);
        if (!$cart) {
            return false;
        }
        $this->cart = $cart;
        return $this->cart;
    }

    public function getCustomer()
    {
        return $this->getCart()->getCustomer();
    }

    public function getBillingAddress()
    {
        $cart = $this->getCart();
        $billing = $cart->getBillingAddress();
        if ($billing) {
            $this->billing = $billing;
            return $this->billing;
        }

        $billing = $this->getCustomer()->getBillingAddress();
        if (!$billing) {
            return null;
        }
        $cartAddress = \Mage::getModel('Model\Cart\Address');
        $cartAddress->addressId = $billing->id;
        $cartAddress->cartId = $cart->cartId;
        $cartAddress->addressType = $billing->addressType;
        $cartAddress->address = $billing->address;
        $cartAddress->city = $billing->city;
        $cartAddress->state = $billing->state;
        $cartAddress->country = $billing->country;
        $cartAddress->zipcode = $billing->zipcode;

        if (!$cartAddress->save()) {
            $this->getMessage()->setFailure('Enable to fetch address data.');
            return null;
        }
        $this->billing = $cartAddress;

        return $this->billing;
    }

    public function getShippingAddress()
    {
        $cart = $this->getCart();
        $cartAddress = \Mage::getModel('Model\Cart\Address');
        $shipping = $cart->getShippingAddress();
        if ($shipping) {
            $this->shipping = $shipping;
            return $this->shipping;
        }
        $shipping = $this->getCustomer()->getShippingAddress();
        if (!$shipping) {
            return null;
        }
        $cartAddress->addressId = $shipping->id;
        $cartAddress->cartId = $cart->cartId;
        $cartAddress->addressType = $shipping->addressType;
        $cartAddress->address = $shipping->address;
        $cartAddress->city = $shipping->city;
        $cartAddress->state = $shipping->state;
        $cartAddress->country = $shipping->country;
        $cartAddress->zipcode = $shipping->zipcode;

        if (!$cartAddress->save()) {
            $this->getMessage()->setFailure('Enable to fetch address data.');
            return null;
        }
        $this->shipping = $cartAddress;

        return $this->shipping;
    }

    public function getPaymentMethod()
    {
        return \Mage::getModel('Model\PaymentMethod')->fetchAll();
    }

    public function getShippingMethod()
    {
        return \Mage::getModel('Model\ShippingMethod')->fetchAll();
    }

    public function getOrderDetails()
    {
        $cart = $this->getCart();
        $shipping = \Mage::getModel('Model\ShippingMethod')->load($cart->shippingMethodId);
        return $shipping;
    }
}
