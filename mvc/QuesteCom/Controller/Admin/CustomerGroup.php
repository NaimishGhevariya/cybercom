<?php

namespace Controller\Admin;

\Mage::loadFileByClassName("Controller\Core\Admin");

class CustomerGroup extends \Controller\Core\Admin
{

    public function gridAction()
    {

        $layout = $this->getLayout();

        $gridBlock = \Mage::getBlock("Block\Admin\CustomerGroup\Grid");
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
        $customerGroup = \Mage::getModel("Model\CustomerGroup");

        $edit = \Mage::getBlock("Block\Admin\CustomerGroup\Edit");
        $edit->setController($this);
        if ($id) {
            $customerGroup = $customerGroup->load($id);
            if (!$customerGroup) {
                throw new \Exception("error found !");
            }
        }
        $edit->setTableRow($customerGroup);
        $content->addChild($edit, 'edit');

        $left = $layout->getChild('left');
        $left->setController(\Mage::getController('Controller\Core\Admin'));
        $tabs = \Mage::getBlock("Block\Admin\CustomerGroup\Edit\Tabs");
        $tabs->setController($this);
        $left->addChild($tabs, 'tabs');
        echo $layout->toHtml();
    }

    public function editAction()
    {
        try {
            $edit = \Mage::getBlock("Block\Admin\CustomerGroup\Edit");
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
            $customerGroup = \Mage::getModel("Model\CustomerGroup");
            if ($id = $this->getRequest()->getGet("id")) {
                $customerGroup = $customerGroup->load($id);
                if (!$customerGroup) {
                    throw new \Exception("Record Not Found.");
                }
            }
            $customerGroupData = $this->getRequest()->getPost('customerGroup');
            $customerGroup->setData($customerGroupData);
            if ($customerGroup->save()) {
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
            $customerGroup = \Mage::getModel("Model\CustomerGroup");
            $customerGroup->load($id);
            if ($customerGroup->delete($id)) {
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
