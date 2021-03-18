<?php

namespace Model\Core;

class Url
{
    protected $request = null;

    public function __construct()
    {
        $this->setRequest();
    }

    public function setRequest()
    {
        $this->request = \Mage::getModel('Model\Core\Request');
        return $this;
    }

    public function getRequest()
    {
        if (!$this->request) {
            $this->setRequest();
        }
        return $this->request;
    }

    public function getUrl($actionName = NULL, $controllerName = NULL, $params = NULL, $resetParams = false)
    {

        $final = $this->getRequest()->getGet();
        if (!$resetParams) {
            $final = [];
        }
        if ($actionName == NULL) {
            $actionName = $this->getRequest()->getGet('a');
        }
        if ($controllerName == NULL) {
            $controllerName = $this->getRequest()->getGet('c');;
        }
        $final['c'] = $controllerName;
        $final['a'] = $actionName;
        if (is_array($params)) {
            $final = array_merge($final, $params);
        }
        $queryString = http_build_query($final);
        return "http://localhost:9080/QuesteCom/index.php?{$queryString}";
    }

    public function baseUrl($subUrl = null)
    {
        $url = "http://localhost:9080/QuesteCom/";
        if ($subUrl) {
            $url .=  $subUrl;
        }
        return $url;
    }
}
