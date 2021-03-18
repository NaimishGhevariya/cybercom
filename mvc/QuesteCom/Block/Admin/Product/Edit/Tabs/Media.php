<?php

namespace Block\Admin\Product\Edit\Tabs;

\Mage::loadFileByClassName("Block\Core\Edit");


class Media extends \Block\Core\Edit
{
    protected $media = null;

    public function __construct()
    {
        $this->setTemplate("./view/admin/product/edit/tabs/media.php");
    }

    public function setMedia($media = null)
    {
        if ($media) {
            $this->$media = $media;
            return $this;
        }
        if ($id = $this->getRequest()->getGet('id')) {
            $media = \Mage::getModel('Model\ProductMedia');
            $query = "SELECT * FROM {$media->getTableName()} WHERE `productId` = {$id}";
            $mediaData = $media->fetchAll($query);
            if ($mediaData) {
                $this->media = $mediaData;
                return $this;
            }
        }
        $this->media = $media;
        return $this;
    }

    public function getMedia()
    {
        if (!$this->media) {
            $this->setMedia();
        }
        return $this->media;
    }
}
