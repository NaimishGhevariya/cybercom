<?php

namespace Controller\Admin\Cart\Invoice;

\Mage::loadFileByClassName("Controller\Core\Admin");

class Invoice extends \Controller\Core\Admin
{
    public function gridAction()
    {
        $layout = $this->getLayout();
        $invoice = \Mage::getBlock("Block\Admin\Cart\Checkout\Invoice\Invoice");
        $content = $layout->getChild('content');
        $content->addChild($invoice, 'grid');
        $this->toHtmlLayout();
    }
}
