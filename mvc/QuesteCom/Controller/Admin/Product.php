<?php

namespace Controller\Admin;

\Mage::loadFileByClassName("Controller\Core\Admin");

class Product extends \Controller\Core\Admin
{

    public function gridAction()
    {

        $layout = $this->getLayout();
        $gridBlock = \Mage::getBlock("Block\Admin\Product\Grid");
        $content = $layout->getChild('content');
        $content->addChild($gridBlock, 'grid');
        $this->toHtmlLayout();
    }

    public function formAction()
    {
        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $product = \Mage::getModel("Model\Product");

        $edit = \Mage::getBlock("Block\Admin\Product\Edit");
        $edit->setController($this);
        $id = $this->getRequest()->getGet('id');
        if ($id) {
            $product = $product->load($id);
            if (!$product) {
                throw new \Exception("error found !");
            }
        }
        $edit->setTableRow($product);
        $content->addChild($edit, 'edit');

        $left = $layout->getChild('left');
        $left->setController(\Mage::getController('Controller\Core\Admin'));
        $tabs = \Mage::getBlock("Block\Admin\Product\Edit\Tabs");
        $tabs->setController($this);

        $left->addChild($tabs, 'tabs');
        echo $layout->toHtml();
    }

    public function editAction()
    {
        try {
            $edit = \Mage::getBlock("Block\Admin\Product\Edit");
            $edit->setController($this);
            $layout = $this->getLayout();
            $content = $layout->getChild('content')->addChild($edit, 'edit');
            echo $layout->toHtml();
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function saveAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }
            $product = \Mage::getModel("Model\Product");
            if ($id = $this->getRequest()->getGet("id")) {
                $product = $product->load($id);
                if (!$product) {
                    throw new \Exception("Record Not Found.");
                }
            }
            $productData = $this->getRequest()->getPost('product');
            date_default_timezone_set("Asia/Kolkata");
            $product->createdDate = date('Y-m-d H:i:s');
            $product->setData($productData);
            if ($product->save($id)) {
                $this->getMessage()->setSuccess("Record Added Successfully");
            } else {
                $this->getMessage()->setFailure("Unable to Add Record");
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect('grid');
        }
        $this->redirect('grid', 'product', null, false);
    }

    public function deleteAction()
    {
        try {
            $id = (int) $this->getRequest()->getGet('id');
            if (!$id) {
                throw new \Exception("Id Required.");
            }
            $product = \Mage::getModel("Model\Product");
            $productData = $this->getRequest()->getPost('product');
            $product->load($id);
            if ($product->delete($id)) {
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
