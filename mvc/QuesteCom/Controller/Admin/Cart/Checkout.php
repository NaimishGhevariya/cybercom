<?php

namespace Controller\Admin\Cart;

\Mage::loadFileByClassName("Controller\Core\Admin");

class checkout extends \Controller\Core\Admin
{
    public function checkoutAction()
    {
        $layout = $this->getLayout();
        $checkoutBlock = \Mage::getBlock("Block\Admin\Cart\Checkout\Checkout");
        $content = $layout->getChild('content');
        $content->addChild($checkoutBlock, 'grid');
        $this->getTotal();
        $this->toHtmlLayout();
    }

    public function testAction()
    {
        echo "inside test action";
        $billing = $this->getRequest()->getPost('billing');
        $shipping = $this->getRequest()->getPost('shipping');
        $saveBillingFlag = $this->getRequest()->getPost('saveBillingFlag');
        $saveShippingFlag = $this->getRequest()->getPost('saveShippingFlag');
        $paymentMethodId = $this->getRequest()->getPost('paymentMethod');
        $shippingMethodId = $this->getRequest()->getPost('shippingMethod');

        if ($shipping['sameFlag']) {
            $shipping = $billing;
            $billing['sameAsBilling'] = 1;
            $this->saveCartBillingAddress($billing);
            unset($billing['sameAsBilling']);
        } else {
            $this->saveCartBillingAddress($billing);
            $this->saveCartShippingAddress($shipping);
        }

        if ($saveBillingFlag) {
            $this->saveCustomerBillingAddress($billing);
        }

        if ($saveShippingFlag) {
            $this->saveCustomerShippingAddress($shipping);
        }
        $shippingMethod = \Mage::getModel('Model\ShippingMethod')->load($shippingMethodId);
        $cart = \Mage::getModel('Model\Cart');
        $cart = $cart->getCart();
        $cart->paymentMethodId = $paymentMethodId;
        $cart->shippingMethodId = $shippingMethodId;
        $cart->shippingAmount = $shippingMethod->amount;
        $cart->total = $cart->total + $shippingMethod->amount;

        if ($cart->save()) {
            $this->getMessage()->setSuccess("Cart Updated !");
            $this->redirect('grid', 'cart\Invoice\Invoice', null, true);
        } else {
            $this->getMessage()->setSuccess("Unable to Update Cart");
        }
        $this->redirect('checkout', 'cart\checkout', null, true);
        return;
    }

    public function saveCartBillingAddress($postData)
    {
        $cart = \Mage::getModel('Model\Cart');
        $cart = $cart->getCart();
        $address = $cart->getBillingAddress();
        if (!$address) {
            $address = \Mage::getModel('Model\Cart\Address');
        }
        $address->setData($postData);
        $address->cartId = $cart->cartId;
        $address->addressType = 'billing';

        if ($address->save()) {
            return true;
        }
        return false;
    }

    public function saveCartShippingAddress($postData)
    {
        $cart = \Mage::getModel('Model\Cart');
        $cart = $cart->getCart();
        $address = $cart->getShippingAddress();
        if (!$address) {
            $address = \Mage::getModel('Model\Cart\Address');
        }
        $address->setData($postData);
        $address->cartId = $cart->cartId;
        $address->addressType = 'shipping';
        if ($address->save()) {
            return true;
        }
        return false;
    }

    public function saveCustomerBillingAddress($postData)
    {
        $cart = \Mage::getModel('Model\Cart');
        $customer = $cart->getCart()->getCustomer();
        $address = $customer->getBillingAddress();
        if (!$address) {
            $address = \Mage::getModel('Model\CustomerAddress');
        }
        $address->setData($postData);
        $address->customerId = $customer->customerId;
        $address->addressType = 'billing';
        if ($address->save()) {
            return true;
        }
        return false;
    }

    public function saveCustomerShippingAddress($postData)
    {
        $cart = \Mage::getModel('Model\Cart');
        $customer = $cart->getCart()->getCustomer();
        $address = $customer->getShippingAddress();
        if (!$address) {
            $address = \Mage::getModel('Model\CustomerAddress');
        }
        $address->setData($postData);
        $address->customerId = $customer->customerId;
        $address->addressType = 'shipping';
        if ($address->save()) {
            return true;
        }
        return false;
    }


    public function getTotal()
    {
        $newPrice = $this->getRequest()->getPost('newPrice');
        $cart = \Mage::getModel('Model\Cart');
        $cart = $cart->getCart();
        $cartItem = \Mage::getModel('Model\Cart\Item');
        $query = "SELECT * FROM `cart_item` WHERE `cartId` = '{$cart->cartId}'";
        $items = $cartItem->fetchAll($query);
        $total = 0;
        $discount = 0;

        foreach ($items->getData() as $key => $item) {
            $total = $total +  ($item->changedPrice * $item->quantity) - $item->discount;
            $discount = $discount + $item->discount;
        }
        $cart->total = $total;
        $cart->discount = $discount;
        $cart->save();
    }
}
