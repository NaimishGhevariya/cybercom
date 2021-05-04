<?php

namespace Block\Admin\Attribute;

\Mage::loadFileByClassName("Block\Core\Grid");

class Grid extends \Block\Core\Grid
{
    public function prepareCollection()
    {
        $attributes = \Mage::getModel("Model\Attribute");
        if ($this->getFilterObject()->getFilters($attributes->getTableName())) {
            $collection = $attributes->fetchAll($this->buildFilterQuery($attributes->getTableName()))->getData();
        } else {
            $collection = $attributes->fetchAll()->getData();
        }
        $this->setCollection($collection);
        return $this;
    }


    public function getTableName()
    {
        return \Mage::getModel('Model\Attribute')->getTableName();
    }

    public function prepareColumns()
    {
        $tableName = $this->getTableName();
        $this->addColumns('attributeId', [
            'field' => 'attributeId',
            'label' => '#',
            'type' => 'number',
            'filter' => $this->getFilterObject()->getFilters($tableName, 'attributeId')['attributeId'],
        ]);
        $this->addColumns('entityTypeId', [
            'field' => 'entityTypeId',
            'label' => 'EntityType',
            'type' => 'number',
            'filter' => $this->getFilterObject()->getFilters($tableName, 'entityTypeId')['entityTypeId'],
        ]);
        $this->addColumns('name', [
            'field' => 'name',
            'label' => 'Name',
            'type' => 'text',
            'filter' => $this->getFilterObject()->getFilters($tableName, 'name')['name'],
        ]);
        $this->addColumns('code', [
            'field' => 'code',
            'label' => 'Code',
            'type' => 'text',
            'filter' => $this->getFilterObject()->getFilters($tableName, 'code')['code'],
        ]);
        $this->addColumns('inputType', [
            'field' => 'inputType',
            'label' => 'Input Type',
            'type' => 'text',
            'filter' => $this->getFilterObject()->getFilters($tableName, 'inputType')['inputType'],
        ]);
        $this->addColumns('backendType', [
            'field' => 'backendType',
            'label' => 'Backend Type',
            'type' => 'text',
            'filter' => $this->getFilterObject()->getFilters($tableName, 'backendType')['backendType'],
        ]);
        $this->addColumns('sortOrder', [
            'field' => 'sortOrder',
            'label' => 'Sort Order',
            'type' => 'number',
            'filter' => $this->getFilterObject()->getFilters($tableName, 'sortOrder')['sortOrder'],
        ]);
        $this->addColumns('backendModel', [
            'field' => 'backendModel',
            'label' => 'Backend Model',
            'type' => 'text',
            'filter' => $this->getFilterObject()->getFilters($tableName, 'backendModel')['backendModel'],
        ]);

        return $this;
    }

    public function getTitle()
    {
        $this->getTitle = 'Manage Attributes';
        return $this->getTitle;
    }

    // -----> Manage button actions ------

    public function prepareActions()
    {
        $this->addActions('edit', [
            'label' => "<i class='fas fa-pen'></i>",
            'method' => 'getEditUrl',
            'ajax' => false
        ]);
        $this->addActions('delete', [
            'label' => '<i class="fas fa-trash-alt" style="color:tomato"></i>',
            'method' => 'getDeleteUrl',
            'ajax' => false
        ]);
        return $this;
    }

    public function getEditUrl($row)
    {
        return $this->getUrlObject()->getUrl('form', null, ['id' => $row->attributeId], true);
    }

    public function getDeleteUrl($row)
    {
        return $this->getUrlObject()->getUrl('delete', null, ['id' => $row->attributeId], true);
    }



    // -----> Manage buttons ------

    public function prepareButtons()
    {
        $this->addButtons('addnew', [
            'label' => '<i class="fas fa-plus"></i> Add New',
            'method' => 'AddNewUrl',
            'ajax' => false,
        ]);
        $this->addButtons('applyFilter', [
            'label' => '<i class="fas fa-filter"></i> Apply Filter',
            'method' => 'getFilterAction',
            'ajax' => false,
        ]);
        if ($this->getFilterObject()->getFilters($this->getTableName()) != null) {
            $this->addButtons('clearFilter', [
                'label' => '<i class="fas fa-times-circle"></i> Clear Filters',
                'method' => 'getClearFilterAction',
                'ajax' => false,
            ]);
            return $this;
        }
    }
}
