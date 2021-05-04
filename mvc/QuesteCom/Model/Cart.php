<?php

namespace Model;

\Mage::loadFileByClassName('Model\Core\Table');

class Cart extends Core\Table
{
    protected $cart = null;
    protected $customer = null;
    protected $items = null;
    protected $billingAddress = null;
    protected $shippingAddress = null;


    public function __construct()
    {
        $this->setTableName('cart');
        $this->setPrimaryKey('cartId');
    }

    public function getCustomer()
    {
        if ($this->customer) {
            return $this->customer;
        }
        if (!$this->customerId) {
            return false;
        }
        $customer = \Mage::getModel('Model\Customer')->load($this->customerId);
        $this->setCustomer($customer);
        return $this->customer;
    }

    public function setCustomer(\Model\Customer $customer)
    {
        $this->customer = $customer;
        return $this;
    }

    public function getItems()
    {
        if (!$this->cartId) {
            return false;
        }
        $query = "SELECT * FROM `cart_item` WHERE `cartId` = '{$this->cartId}'";
        $items = \Mage::getModel('Model\Cart\Item')->fetchAll($query);
        $this->setItems($items);
        return $this->items;
    }

    public function setItems($items = null)
    {
        $this->items = $items;
        return $this;
    }

    public function getBillingAddress()
    {
        if (!$this->cartId) {
            return false;
        }
        $query = "SELECT * FROM `cart_address` WHERE `cartId` = '{$this->cartId}' AND `addressType` = 'billing'";
        $billingAddress = \Mage::getModel('Model\Cart\Address')->fetchRow($query);
        if ($billingAddress) {
            $this->setBillingAddress($billingAddress);
            return $this->billingAddress;
        }
        return $this->billingAddress;
    }

    public function setBillingAddress(\Model\Cart\Address $billingAddress)
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    public function getShippingAddress()
    {
        if (!$this->cartId) {
            return false;
        }
        $query = "SELECT * FROM `cart_address` WHERE `cartId` = '{$this->cartId}' AND `addressType` = 'shipping'";
        $shippingAddress = \Mage::getModel('Model\Cart\Address')->fetchRow($query);
        if ($shippingAddress) {
            $this->setShippingAddress($shippingAddress);
        }
        return $this->shippingAddress;
    }

    public function setShippingAddress(\Model\Cart\Address $shippingAddress)
    {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }

    public function addItem($product, $quantity = 1)
    {
        $query = "SELECT * 
            FROM `cart_item` 
            WHERE `cartId` = '{$this->cartId}' 
                AND `productId` = '{$product->productId}'";
        $cartItem = \Mage::getModel('Model\Cart\Item')->fetchRow($query);
        if ($cartItem) {
            $cartItem->quantity += $quantity;
        } else {
            unset($cartItem);
            $cartItem = \Mage::getModel('Model\Cart\Item');
            $cartItem->quantity = $quantity;
        }
        $cartItem->cartId = $this->cartId;
        $cartItem->productId = $product->productId;
        $cartItem->price = $product->price;
        $cartItem->discount = $product->discount;

        if (!$cartItem->save()) {
            echo 'error h';
        }
        return $this;
    }

    public function getCart($customerId = null)
    {
        $session = \Mage::getModel('Model\Admin\Session');
        $cart = \Mage::getModel('Model\Cart');
        $customerId = $session->activeCustomerId;
        if ($customerId) {
            $session->activeCustomerId = $customerId;
            $query = "SELECT * 
                FROM cart
                WHERE `customerId` = '{$session->activeCustomerId}'";
            $cart = $cart->fetchRow($query);
            if ($cart) {
                return $cart;
            }
        }
        $cart = \Mage::getModel('Model\Cart');
        $cart->customerId = $session->activeCustomerId;
        $cart->save();
        return $cart;
    }

    public function getActiveCustomerId()
    {
        $session = \Mage::getModel('Model\Admin\Session');
        $activeCustomerId = $session->activeCustomerId;
        if ($activeCustomerId) {
            return $activeCustomerId;
        }
        return null;
    }
}
