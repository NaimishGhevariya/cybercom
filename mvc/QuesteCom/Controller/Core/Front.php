<?php

namespace Controller\Core;

class Front
{
	public function init()
	{
		if (array_key_exists('c', $_GET) && array_key_exists('a', $_GET)) {
			$controllerName = $_GET['c'];
			$controllerName = "Controller\Admin\\" . ucfirst($_GET['c']);
			$actionName = $_GET['a'];
			$className = "Controller\Admin\\" . $_GET['c'];
			$methodName = $_GET['a'] . "Action";
			\Mage::loadFileByClassName($className);
			$controller = \Mage::getController($controllerName);
			$controller->$methodName();
		} else {
			echo "you are in index";
		}
	}
}
