<?php

namespace Controller\Admin;

\Mage::loadFileByClassName("Controller\Core\Admin");

class ShippingMethod extends \Controller\Core\Admin
{

    public function gridAction()
    {

        $layout = $this->getLayout();

        $gridBlock = \Mage::getBlock("Block\Admin\ShippingMethod\Grid");
        $gridBlock->setController($this);

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
        $this->getFilterObject()->clearFilters('shippingmethod');
        $this->redirect('grid');
    }


    public function formAction()
    {
        $id = $this->getRequest()->getGet('id');
        $layout = $this->getLayout();
        $content = $layout->getChild('content');
        $shippingMethod = \Mage::getModel("Model\shippingMethod");

        $edit = \Mage::getBlock("Block\Admin\ShippingMethod\Edit");
        $edit->setController($this);
        if ($id) {
            $shippingMethod = $shippingMethod->load($id);
            if (!$shippingMethod) {
                throw new \Exception("error found !");
            }
        }
        $edit->setTableRow($shippingMethod);
        $content->addChild($edit, 'edit');

        $left = $layout->getChild('left');
        $left->setController(\Mage::getController('Controller\Core\Admin'));
        $tabs = \Mage::getBlock("Block\Admin\ShippingMethod\Edit\Tabs");
        $tabs->setController($this);
        $left->addChild($tabs, 'tabs');
        echo $layout->toHtml();
    }

    public function editAction()
    {
        try {
            $edit = \Mage::getBlock("Block\Admin\ShippingMethod\Edit");
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
            $shippingMethod = \Mage::getModel("Model\ShippingMethod");
            if ($id = $this->getRequest()->getGet("id")) {
                $shippingMethod = $shippingMethod->load($id);
                if (!$shippingMethod) {
                    throw new \Exception("Record Not Found.");
                }
            }
            $shippingMethodData = $this->getRequest()->getPost('shippingMethod');
            $shippingMethod->setData($shippingMethodData);
            if ($shippingMethod->save()) {
                $this->getMessage()->setSuccess("Record Added Successfully");
            } else {
                $this->getMessage()->setSuccess("Unable to Add Record");
            }
        } catch (\Exception $e) {
            echo $this->getMessage()->setFailure($e->getMessage());
            $this->redirect('grid');
        }
        $this->redirect('grid', null, null, false);
    }

    public function deleteAction()
    {
        try {
            $id = (int) $this->getRequest()->getGet('id');
            if (!$id) {
                throw new \Exception("Id Required.");
            }
            $shippingMethod = \Mage::getModel("Model\ShippingMethod");
            $shippingMethod->load($id);
            if ($shippingMethod->delete($id)) {
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
