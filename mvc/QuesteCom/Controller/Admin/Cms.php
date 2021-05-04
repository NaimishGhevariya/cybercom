<?php

namespace Controller\Admin;

\Mage::loadFileByClassName("Controller\Core\Admin");

class Cms extends \Controller\Core\Admin
{
    public function gridAction()
    {

        $layout = $this->getLayout();

        $gridBlock = \Mage::getBlock("Block\Admin\Cms\Grid");
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
        $cms = \Mage::getModel("Model\Cms");

        $edit = \Mage::getBlock("Block\Admin\Cms\Edit");
        $edit->setController($this);
        if ($id) {
            $cms = $cms->load($id);
            if (!$cms) {
                throw new \Exception("error found !");
            }
        }
        $edit->setTableRow($cms);
        $content->addChild($edit, 'edit');

        $left = $layout->getChild('left');
        $left->setController(\Mage::getController('Controller\Core\Admin'));
        $tabs = \Mage::getBlock("Block\Admin\Cms\Edit\Tabs");
        $tabs->setController($this);
        $left->addChild($tabs, 'tabs');
        echo $layout->toHtml();
    }

    public function editAction()
    {
        try {
            $edit = \Mage::getBlock("Block\Admin\Cms\Edit");
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
            $cmsPage = \Mage::getModel("Model\Cms");
            $id = $this->getRequest()->getGet("id");
            if ($id) {
                $cmsPage = $cmsPage->load($id);
                if (!$cmsPage) {
                    throw new \Exception("Record Not Found.");
                }
            }
            $cmsPage->createdDate = date("Y-m-d H:i:s");
            $cmsPageData = $this->getRequest()->getPost('cms');
            $cmsPage->setData($cmsPageData);
            if ($cmsPage->save()) {
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
            $cmsPage = \Mage::getModel("Model\Cms");
            $cmsPage->load($id);
            if ($cmsPage->delete($id)) {
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
