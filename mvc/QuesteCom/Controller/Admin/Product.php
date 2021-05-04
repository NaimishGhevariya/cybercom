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

    public function filterAction()
    {
        $data = $this->getRequest()->getPost('filter');

        $this->getFilterObject()->setFilters($data);
        $this->redirect('grid');
    }

    public function clearFilterAction()
    {
        $this->getFilterObject()->clearFilters('products');
        $this->redirect('grid');
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
            $layout->getChild('content')->addChild($edit, 'edit');
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
            $optionData = array_filter($productData, 'is_array');

            if (count($optionData) > 0) {
                foreach ($productData as $key => $value) {
                    if (is_array($value)) {
                        $value = implode(',', $value);
                    }
                    $productData[$key] = $value;
                    $product->setData($productData);
                }
            } else {
                $product->setData($productData);
            }

            if ($product->save()) {
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
            $product->load($id);
            // echo '<pre>';
            // print_r($product);
            // die();
            if ($product->delete()) {
                $this->getMessage()->setSuccess("Record Deleted Successfully");
            } else {
                $this->getMessage()->setFailure("Unable to Delete Record");
            }
        } catch (\Exception $e) {
            echo $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid');
    }

    // public function pageAction()
    // {
    //     $pager = \Mage::getController('Controller\Core\Pager');
    //     $query = "SELECT * FROM `products`";
    //     $product = \Mage::getModel('Model\Product');
    //     $productCount = $product->getAdapter()->fetchOne($query);
    //     $pager->setTotalRecords(100);
    //     $pager->setRecordPerPage(30);
    //     $pager->setCurrentPage(2);
    //     $pager->calculate();

    //     echo '<pre>';
    //     \print_r($pager);
    // }
}
