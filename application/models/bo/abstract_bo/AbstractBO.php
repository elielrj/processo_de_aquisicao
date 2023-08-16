<?php

require_once 'InterfaceToString.php';

abstract class AbstractBO implements InterfaceToString
{
	protected $id;
	protected $status;

	public function __construct($id, $status)
	{
		$this->id = $id;
		$this->status = $status;
	}

	function __get($key)
	{
		return $this->$key;
	}

	function __set($key, $value)
	{
		$this->$key = $value;
	}
}
