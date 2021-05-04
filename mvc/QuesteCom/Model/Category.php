<?php

namespace Model;

\Mage::loadFileByClassName("Model\Core\Table");

class Category extends Core\Table
{

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    const FEATURED_YES = 1;
    const FEATURED_NO = 0;

    public function __construct()
    {
        $this->setTableName("categories");
        $this->setPrimaryKey("categoryId");
    }

    public function getStatusOptions()
    {
        return [
            self::STATUS_DISABLED => "Disable",
            self::STATUS_ENABLED => "Enable"
        ];
    }

    public function getFeaturedOptions()
    {
        return [
            self::FEATURED_YES => "Yes",
            self::FEATURED_NO => "No"
        ];
    }

    public function updatePath()
    {
        if (!$this->parentId) {
            $path = $this->categoryId;
        } else {
            $parent = \Mage::getModel('Model\Category');
            $parent->load($this->parentId);
            if (!$parent) {
                throw new \Exception('Unable to load parent', 1);
            }
            $path = $parent->path . "=" . $this->categoryId;
        }
        $this->path = $path;
        return $this->save();
    }

    public function updateChildrenPaths($path, $parentId = null)
    {
        $path = $path . "=";
        $query = "SELECT * FROM `{$this->getTableName()}` 
        WHERE `path` LIKE '{$path}%' 
        ORDER BY `path` ASC ";
        $categories = $this->fetchAll($query);
        if ($categories) {
            foreach ($categories->getData() as $row) {
                if ($parentId != null) {
                    $row->parentId = $parentId;
                }
                $row->updatePath();
            }
        }
    }
}
