<?php

namespace Block\Admin\Attribute\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');

class OptionGrid extends \Block\Core\Edit
{
    protected $options = [];

    public function __construct()
    {
        $this->setTemplate('./view/admin/attribute/edit/tabs/optionGrid.php');
    }

    public function setOptions($options = null)
    {
        try {
            if ($options) {
                $this->options = $options;
                return $this;
            }
            $options = \Mage::getModel("Model\Attribute\Option");
            if ($id = $this->getRequest()->getGet('id'))
                $options = $options->load($id);

            if (!$options) {
                throw new \Exception("Id Not Found");
            }
            $this->options = $options;
            return $this;
        } catch (\Exception $e) {
            $message = \Mage::getModel("Model\Admin\Message");
            $message->setFailure($e->getMessage());
            $this->redirect('grid');
        }
    }
    public function getOptions()
    {
        $options = \Mage::getModel('Model\Attribute\Option');
        $id = $this->getRequest()->getGet('id');
        if (!$id) {
            return false;
        }
        $query = "SELECT * FROM `{$options->getTableName()}`
        WHERE `attributeId` = {$id}
        ORDER BY `sortOrder` ASC";

        $options = $options->fetchAll($query)->getData();
        return $options;
    }
}
