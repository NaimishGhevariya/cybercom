<?php

namespace Model\Core;

\Mage::loadFileByClassName('Model\Core\Session');

class Message extends Session
{

	public function setSuccess($message)
	{
		$this->success = $message;
		return $this->success;
	}

	public function getSuccess()
	{
		return $this->success;
	}

	public function clearSuccess()
	{
		unset($this->success);
	}

	public function setFailure($message)
	{
		$this->failure = $message;
		return $this->failure;
	}

	public function clearFailure()
	{
		unset($this->failure);
	}

	public function getFailure()
	{
		return $this->failure;
	}

	public function setNotice($notice)
	{
		$this->notice = $notice;
	}

	public function getNotice()
	{
		return $this->notice;
	}

	public function unsetNotice()
	{
		unset($this->notice);
	}
}
