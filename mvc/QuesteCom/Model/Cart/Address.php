<?php

namespace Model\Cart;

\Mage::loadFileByClassName('Model\Core\Table');

class Address extends \Model\Core\Table
{
    protected $cart = null;
    protected $customerAddress = null;

    const ADDRESS_TYPE_BILLING = '1';
    const ADDRESS_TYPE_SHIPPING = '0';

    public function __construct()
    {
        $this->setTableName('cart_address');
        $this->setPrimaryKey('cartAddressId');
    }

    public function getAddress()
    {
        if (!$this->addressId) {
            return false;
        }
        \Mage::getModel('Model\CustomerAddress');
        return $this->customerAddress;
    }

    public function setAddress(\Model\Cart\Address $customerAddress)
    {
        $this->customerAddress = $customerAddress;
        return $this;
    }

    public function getCart()
    {
        if (!$this->cartId) {
            return false;
        }
        $cart = \Mage::getModel('Model\Cart')->load($this->cartId);
        $this->setCart($cart);
        return $this->cart;
    }

    public function setCart(\Model\Cart $cart)
    {
        $this->cart = $cart;
        return $this;
    }
}
