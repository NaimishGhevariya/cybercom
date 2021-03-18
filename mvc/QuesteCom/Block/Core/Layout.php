<?php

namespace Block\Core;

\Mage::loadFileByClassName("Block\Core\Template");

class Layout extends Template
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('./view/core/layout/oneColumn.php');
		$this->prepareChildren();
	}

	public function prepareChildren()
	{
		$this->addChild(\Mage::getBlock("Block\Core\Layout\Head"), 'head');
		$this->addChild(\Mage::getBlock("Block\Core\Layout\Header"), 'header');
		$this->addChild(\Mage::getBlock("Block\Core\Layout\Content"), 'content');
		$this->addChild(\Mage::getBlock("Block\Core\Layout\Footer"), 'footer');
		$this->addChild(\Mage::getBlock("Block\Core\Layout\Message"), 'message');
		$this->addChild(\Mage::getBlock("Block\Core\Layout\Left"), 'left');
	}

	public function getContent()
	{
		return $this->getChild('content');
	}

	public function getHeader()
	{
		return $this->getChild('header');
	}

	public function getLeft()
	{
		return $this->getChild('left');
	}
}
