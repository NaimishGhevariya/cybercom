<?php

namespace Controller\Admin\Attribute\Options;

\Mage::loadFileByClassName("Controller\Core\Admin");

class Price extends \Controller\Core\Admin
{
    public function optionAction()
    {
        try {
            $option = \Mage::getBlock("Block\Admin\Attribute\Edit\Tabs");
            $option->setController($this);
            $layout = $this->getLayout();
            $layout->getChild('content')->addChild($option);
            echo $layout->toHtml();
        } catch (\Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function updateOptions()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new \Exception("Invalid Request.");
            }
            $options = $this->getRequest()->getPost('option');
            $attribute = \Mage::getModel('Model\Attribute');
            if ($attributeId = $this->getRequest()->getGet('id')) {
                if (!$attribute->load($attributeId)) {
                    throw new \Exception("Something went wrong.");
                }
            }
            $optionsModel = \Mage::getModel('Model\Attribute\Options');
            $options = $this->getRequest()->getPost('option');
            if (array_key_exists('exist', $options)) {
                $existOptions = $options['exist'];
                foreach ($existOptions as $key => $existOption) {
                    $updateData = [
                        'optionId' => $key,
                        'name'    => $existOption['name'],
                        'sortOrder'    => $existOption['sortOrder'],
                    ];
                    if (!$optionsModel->update($updateData)) {
                        throw new \Exception("Something went wrong.");
                    }
                }

                $removeOptionsId = implode(',', array_keys($existOptions));
                $query = "DELETE FROM `{$optionsModel->getTableName()}` 
                    WHERE `attributeId` = '{$attributeId}' 
                        AND `{$optionsModel->getPrimaryKey()}` NOT IN ({$removeOptionsId})";
                if (!$optionsModel->query($query)) {
                    throw new \Exception("Something went wrong.");
                }
            } else {
                $query = "DELETE FROM `{$optionsModel->getTableName()}` 
                    WHERE `attributeId` = '{$attributeId}'";
                if (!$optionsModel->query($query)) {
                    throw new \Exception("Something went wrong.");
                }
            }

            if (array_key_exists('new', $options)) {
                $newOptions = $options['new'];
                if (!array_key_exists('name', $newOptions)) {
                    throw new \Exception("Something went wrong.");
                }
                if (!array_key_exists('sortOrder', $newOptions)) {
                    throw new \Exception("Something went wrong.");
                }
                $newOptionsName = $newOptions['name'];
                $newOptionsSortOrder = $newOptions['sortOrder'];
                foreach ($newOptionsName as $key => $newOptionNameData) {
                    if (!$newOptionNameData or !$newOptionsSortOrder[$key]) {
                        continue;
                    }
                    $inserData = [
                        'name'    => $newOptionNameData,
                        'attributeId'    => $attributeId,
                        'sortOrder'    => $newOptionsSortOrder[$key],
                    ];
                    if (!$optionsModel->insert($inserData)) {
                        throw new \Exception("Something went wrong.");
                    }
                }
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }
    }

    public function deleteOptionAction()
    {
        try {
            $id = (int) $this->getRequest()->getGet('id');
            if (!$id) {
                throw new \Exception("Id Required.");
            }
            $option = \Mage::getModel("Model\Attribute\Option");
            $option->load($id);
            if ($option->delete($id)) {
                $this->getMessage()->setSuccess("Record Deleted Successfully");
            } else {
                $this->getMessage()->setSuccess("Unable to Delete Record");
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('form', null, ['id' => $option->attributeId], true);
    }
}
