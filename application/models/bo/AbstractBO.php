<?php

require_once 'InterfaceToString.php';

class AbstractBO extends CI_Model implements InterfaceToString
{
	protected $id;
	protected $status;

	public function __construct($id, $status)
	{
		parent::__construct();
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
