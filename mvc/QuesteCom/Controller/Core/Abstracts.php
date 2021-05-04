<?php

namespace Controller\Core;

date_default_timezone_set("Asia/Calcutta");
\Mage::loadFileByClassName('Block\Customer\Layout');

class Abstracts
{

    protected $request = Null;
    protected $layout = null;
    protected $message = null;
    public function __construct()
    {
        $this->setRequest();
        $this->setLayout();
        $this->setMessage();
    }

    public function setRequest()
    {
        if (!$this->request) {
            $this->request = \Mage::getModel('Model\Core\Request');
        }
        return $this;
    }
    public function getRequest()
    {
        return $this->request;
    }

    public function setLayout(\Block\Core\Layout $layout = null)
    {
        if (!$layout) {
            $layout = \Mage::getBlock('Block\Customer\Layout');
        }
        $this->layout = $layout;
        return $this;
    }
    public function getLayout()
    {
        return $this->layout;
    }
    public function getHeader()
    {
        return $this->getLayout()->getChild('header');
    }
    public function getLeft()
    {
        return $this->getLayout()->getChild('left');
    }
    public function getContent()
    {
        return $this->getLayout()->getChild('content');
    }
    public function getRight()
    {
        return $this->getLayout()->getChild('right');
    }
    public function getFooter()
    {
        return $this->getLayout()->getChild('footer');
    }
    public function renderLayout()
    {
        echo $this->getLayout()->toHtml();
    }

    public function setMessage()
    {
        if (!$this->message) {
            $this->message = \Mage::getModel('Model\Customer\Message');
        }
        return $this;
    }
    public function getMessage()
    {
        return $this->message;
    }

    public function redirect($actionName = Null, $controllerName = Null, $params = Null, $resetParams = false)
    {
        header("Location: " . $this->getUrl($actionName, $controllerName, $params, $resetParams));
        exit();
    }
    public function getUrl($actionName = Null, $controllerName = Null, $params = Null, $resetParams = false)
    {
        $final = $this->getRequest()->getGet();
        if ($resetParams) {
            $final = [];
        }

        if (empty(trim($actionName))) {
            $actionName = $this->getRequest()->getGet('a');
        }
        if (empty(trim($controllerName))) {
            $controllerName = $this->getRequest()->getGet('c');
        }
        $final['c'] = $controllerName;
        $final['a'] = $actionName;
        if (is_array($params)) {
            $final = array_merge($final, $params);
        }
        $queryString = http_build_query($final);
        unset($final);
    }
}
