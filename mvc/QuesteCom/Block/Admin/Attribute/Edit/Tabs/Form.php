<?php

namespace Block\Admin\Attribute\Edit\Tabs;

\Mage::loadFileByClassName('Block\Core\Edit');

class Form extends \Block\Core\Edit
{

    function __construct()
    {
        parent::__construct();
        $this->setTemplate("./view/admin/attribute/edit/tabs/form.php");
    }


    public function getButton()
    {
        if ($this->getTableRow()->attributeId) {
            echo 'Update';
        } else {
            echo 'Add';
        }
    }

    public function getBackendTypeOptions()
    {
        return [
            'varchar' => 'Varchar',
            'int' => 'Int',
            'decimal' => 'Decimal',
            'text' => 'Text'
        ];
    }

    public function getInputTypeOptions()
    {
        return [
            'text' => 'Text Box',
            'textarea' => 'Text Area',
            'selsect' => 'Select',
            'checkbox' => 'Checkbox',
            'radio' => 'Radio'
        ];
    }

    public function getEntityTypeOptions()
    {
        return [
            'product' => 'Product',
            'category' => 'Category'
        ];
    }
}
