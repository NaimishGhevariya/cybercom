<?php

namespace Block\Core;

class Template
{
	protected $template = NULL;
	protected $controller = NULL;
	protected $children = [];
	protected $message = null;
	protected $request = NULL;
	protected $urlObject = null;
	protected $tabs = [];
	protected $defaultTab = null;
	protected $filters = null;

	public function __construct()
	{
		$this->setRequest();
		$this->setUrlObject();
	}

	public function setRequest()
	{
		$this->request = \Mage::getModel('Model\Core\Request');
		return $this->request;
	}

	public function getRequest()
	{
		if (!$this->request) {
			$this->setRequest();
		}
		return $this->request;
	}

	public function setTemplate($template)
	{
		$this->template = $template;
		return $this;
	}

	public function getTemplate()
	{
		return $this->template;
	}

	public function toHtml()
	{
		ob_start();
		require_once($this->getTemplate());
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
		require_once($this->getTemplate());
	}

	public function setController(\Controller\Core\Admin $controller)
	{
		$this->controller = $controller;
		return $this;
	}

	public function getController()
	{
		return $this->controller;
	}

	public function setUrlObject($urlObject = null)
	{
		$this->urlObject = \Mage::getBlock("Model\Core\Url");
		return $this->urlObject;
	}

	public function getUrlObject()
	{
		if ($this->urlObject == null) {
			$this->setUrlObject();
		}
		return $this->urlObject;
	}

	public function redirect($actionName = null, $controllerName = null, $params = null, $resetParams = false)
	{
		$url = $this->getUrl($actionName, $controllerName, $params, $resetParams);
		header("location: {$url}");
		exit(0);
	}

	public function getUrl($actionName = NULL, $controllerName = NULL, $params = NULL, $resetParams = false)
	{
		return $this->getController()->getUrl($actionName, $controllerName, $params, $resetParams);
	}

	public function setChildren(array $children = [])
	{
		$this->children = $children;
		return $this;
	}

	public function getChildren()
	{
		return $this->children;
	}

	public function addChild($child, $key = null)
	{
		if (!$key) {
			$key = get_class($child);
		}
		$this->children[$key] = $child;
		return $this;
	}

	public function getChild($key)
	{
		if (!array_key_exists($key, $this->children)) {
			return null;
		}
		return $this->children[$key];
	}


	public function removeChild($key)
	{
		if (!array_key_exists($key, $this->children)) {
			unset($this->children[$key]);
		}
		return $this;
	}

	public function createBlock($className)
	{
		return \Mage::getBlock($className);
	}


	public function getMessage()
	{
		if (!$this->message) {
			$this->setMessage();
		}
		return $this->message;
	}

	public function setMessage(\Model\Admin\Message $message = null)
	{
		if (!$message) {
			$message = \Mage::getModel('Model\Admin\Message');
		}
		$this->message = $message;
		return $this;
	}

	public function setFilterObject(\Model\Admin\Filter $filters = null)
	{
		if (!$this->filters) {
			$filters = \Mage::getModel('Model\Admin\Filter');
		}
		$this->filters = $filters;
		return $this->filters;
	}

	public function getFilterObject()
	{
		if (!$this->filters) {
			$this->setFilterObject();
		}
		return $this->filters;
	}

	public function baseUrl($subUrl = null)
	{
		return $this->getUrlObject()->baseUrl($subUrl);
	}

	public function setDefaultTab($defaultTab)
	{
		$this->defaultTab = $defaultTab;
		return $this;
	}

	public function getDefaultTab()
	{
		return $this->defaultTab;
	}

	public function setTabs(array $tabs)
	{
		$this->tabs = $tabs;
		return $this;
	}

	public function getTabs()
	{
		return $this->tabs;
	}

	public function addTabs($key, $tab = [])
	{
		$this->tabs[$key] = $tab;
		return $this;
	}

	public function removeTab($key)
	{
		if (!array_key_exists($key, $this->tabs)) {
			return null;
		}
		unset($this->tabs[$key]);
	}
}
