<?php

namespace Block\Core;

\Mage::loadFileByClassName('Block\Core\Template');

class Grid extends Template
{

    protected $collection = [];
    protected $columns = [];
    protected $actions = [];
    protected $buttons = [];

    public function __construct()
    {
        parent::__construct();
        $this->prepareCollection();
        $this->prepareColumns();
        $this->prepareActions();
        $this->prepareButtons();
        $this->setTemplate('./view/core/grid.php');
    }
    public function prepareCollection()
    {
        return $this;
    }
    public function setCollection($collection)
    {

        $this->collection = $collection;
        return $this;
    }

    public function getCollection()
    {
        return $this->collection;
    }

    public function getColumns()
    {
        return $this->columns;;
    }
    public function addColumns($key, $value)
    {
        $this->columns[$key] = $value;
        return $this;
    }

    public function prepareColumns()
    {
        return $this;
    }


    public function getTitle()
    {
        $this->getTitle = 'Manage Modules';
        return $this->getTitle;
    }

    public function getFieldValue($row, $fieldname)
    {
        return $row->$fieldname;
    }

    // -----> Manage button actions ------

    public function getActions()
    {
        return $this->actions;
    }
    public function addActions($key, $actions)
    {
        $this->actions[$key] = $actions;
        return $this;
    }

    public function prepareActions()
    {
        return $this;
    }

    public function getMethodUrl($row, $methodName)
    {
        return $this->$methodName($row);
    }


    // -----> Manage buttons ------
    public function getButtons()
    {
        return $this->buttons;
    }
    public function addButtons($key, $buttons)
    {
        $this->buttons[$key] = $buttons;
        return $this;
    }

    public function prepareButtons()
    {
        return $this;
    }

    public function getButtonUrl($row, $methodName)
    {
        if ($methodName) {
            return $this->$methodName($row);
        }
        return "javascript:void(0)";
    }
    public function addNewUrl()
    {
        return $this->getUrlObject()->getUrl('form');
    }

    public function getFilterAction()
    {
        return $this->getUrlObject()->getUrl('filter');
    }

    public function getClearFilterAction()
    {
        return $this->getUrlObject()->getUrl('clearFilter');
    }


    public function buildFilterQuery($tableName)
    {
        $filters = $this->getFilterObject()->getFilters($tableName);

        // $this->getFilterObject()->clearFilters();
        if (array_filter($filters)) {
            if ($filters) {
                $query = "SELECT * FROM `{$tableName}`";
                $query .= " WHERE ";
                foreach ($filters as $key => $value) {
                    if ($value) {
                        $query .= "`" . $key . "` LIKE '%" . $value . "%' AND ";
                    }
                }
                $query = rtrim($query, ' AND ') . ";";
            }

            return $query;
        }
    }
}
