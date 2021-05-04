<?php

namespace Model\Core;

class Session
{

	protected $nameSpace = null;

	public function __construct()
	{
		$this->nameSpace = "core";
		$this->start();
	}

	public function getNameSpace()
	{
		return $this->nameSpace;
	}

	public function setNameSpace($nameSpace)
	{
		$this->nameSpace = $nameSpace;
		return $this;
	}

	public function start()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		return $this;
	}

	public function getId()
	{
		return session_id();
	}

	public function destroy()
	{
		session_destroy();
		return $this;
	}

	public function regenerateId()
	{
		return session_regenerate_id();
	}

	public function __set($key, $value)
	{
		$_SESSION[$this->getNameSpace()][$key] = $value;
		return $this;
	}

	public function __get($key)
	{
		if (is_array($_SESSION) && array_key_exists($this->getNameSpace(), $_SESSION)) {
			if (!array_key_exists($key, $_SESSION[$this->getNameSpace()])) {
				return null;
			}
			return $_SESSION[$this->getNameSpace()][$key];
		}
		return null;
	}


	public function __unset($key)
	{
		if (is_array($_SESSION[$this->getNameSpace()])) {

			if (array_key_exists($key, $_SESSION[$this->getNameSpace()])) {
				unset($_SESSION[$this->getNameSpace()][$key]);
			}
			return $this;
		}
		return null;
	}
}
