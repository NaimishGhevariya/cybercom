<?php

namespace Controller;

\Mage::loadFileByClassName('Controller\Core\Customer');

class Home extends Core\Customer
{

    public function indexAction()
    {
        $grid = \Mage::getBlock('Block\Home\Index');
        // $grid->setController($this);
        $layout = $this->getLayout();
        $layout->getChild('content')->addChild($grid, 'content');
        echo $layout->toHtml();
    }
}
