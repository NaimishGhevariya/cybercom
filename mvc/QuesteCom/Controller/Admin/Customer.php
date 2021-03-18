<?php

namespace Controller\Admin;

\Mage::loadFileByClassName("Controller\Core\Admin");

class Customer extends \Controller\Core\Admin
{

    public function gridAction()
    {

        $layout = $this->getLayout();

        $gridBlock = \Mage::getBlock("Block\Admin\Customer\Grid");
        $gridBlock->setController($this);

        $content = $layout->getChild('content');
        $content->addChild($gridBlock, 'grid');

        $this->toHtmlLayout();
    }

    public function formAction()
    {
        $id = $this->getRequest()->getGet('id');
        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $customer = \Mage::getModel("Model\Customer");

        $edit = \Mage::getBlock("Block\Admin\Customer\Edit");
        $edit->setController($this);
        if ($id) {
            $customer = $customer->load($id);
            if (!$customer) {
                throw new \Exception("error found !");
            }
        }
        $edit->setTableRow($customer);
        $content->addChild($edit, 'edit');

        $left = $layout->getChild('left');
        $left->setController(\Mage::getController('Controller\Core\Admin'));
        $tabs = \Mage::getBlock("Block\Admin\Customer\Edit\Tabs");
        $tabs->setController($this);
        $left->addChild($tabs, 'tabs');
        $this->toHtmlLayout();
    }

    public function editAction()
    {
        try {
            $edit = \Mage::getBlock("Block\Admin\Customer\Edit");
            $edit->setController($this);
            $layout = $this->getLayout();
            $content = $layout->getChild('content')->addChild($edit, 'edit');
            echo $layout->toHtml();
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    // public function saveAction()
    // {
    //     if (!$this->getRequest()->isPost()) {
    //         throw new \Exception("Invalid Request.");
    //     }
    //     date_default_timezone_set("Asia/Calcutta");

    //     $customer = \Mage::getBlock('Block\Admin\Customer\Edit');
    //     $customer = $customer->getTableRow();
    //     $customerId = $this->getRequest()->getGet('id');

    //     if ($customerId) {
    //         if (!$customer->getData()) {
    //             throw new \Exception("No record found.");
    //         }
    //         $customer->updatedDate = date("Y-m-d H:i:s");
    //     } else {
    //         $customer->createdDate = date("Y-m-d H:i:s");
    //     }
    // }
    public function saveAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }
            $customer = \Mage::getModel("Model\Customer");
            if ($id = $this->getRequest()->getGet("id")) {
                $customer = $customer->load($id);
                if (!$customer) {
                    throw new \Exception("Record Not Found.");
                }
            }
            $customerData = $this->getRequest()->getPost('customer');
            date_default_timezone_set("Asia/Kolkata");
            $customer->createdDate = date('Y-m-d H:i:s');
            $customer->setData($customerData);
            if ($customer->save($id)) {
                $this->getMessage()->setSuccess("Record Added Successfully");
            } else {
                $this->getMessage()->setFailure("Unable to Add Record");
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect('grid');
        }
        $this->redirect('grid', 'customer', null, false);
    }

    public function saveAddressAction()
    {

        try {
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }
            date_default_timezone_set("Asia/Calcutta");

            $customerId = $this->getRequest()->getGet('id');

            $tab = $this->getRequest()->getGet('tab');
            if ($tab == 'address') {

                $addressBlock = \Mage::getBlock('Block\Admin\Customer\Edit\Tabs\Address');

                if (!$customerId) {
                    throw new \Exception("No record found.");
                }

                $billingAddress = $addressBlock->getBillingAddress();
                $billingData = $this->getRequest()->getPost('billing');

                $billingAddress->customerId = $customerId;
                $billingAddress->addressType = 'billing';
                $billingAddress->setData($billingData);
                if (!$billingAddress->save()) {
                    throw new \Exception("Error Processing Billing Address.");
                } else {
                    $this->getMessage()->setSuccess('Address Stored Successfully !!');
                }

                $address = $addressBlock->getShippingAddress();
                $shippingData = $this->getRequest()->getPost('shipping');

                $address->customerId = $customerId;
                $address->addressType = 'shipping';
                $address->setData($shippingData);
                if (!$address->save()) {
                    throw new \Exception("Error Processing Shipping Address.");
                } else {
                    $this->getMessage()->setSuccess('Address Stored Successfully !!');
                }
            } else {
                throw new \Exception();
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid', null, null, true);
    }

    public function deleteAction()
    {
        try {
            $id = (int) $this->getRequest()->getGet('id');
            if (!$id) {
                throw new \Exception("Id Required.");
            }
            $customer = \Mage::getModel("Model\Customer");
            $customerData = $this->getRequest()->getPost('customer');
            $customer->load($id);
            if ($customer->delete($id)) {
                $this->getMessage()->setSuccess("Record Deleted Successfully");
            } else {
                $this->getMessage()->setSuccess("Unable to Delete Record");
            }
        } catch (\Exception $e) {
            echo $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid');
    }
}
