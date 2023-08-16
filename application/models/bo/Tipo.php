<?php

require_once 'abstract_bo/AbstractBO.php';

class Tipo extends AbstractBO
{
	private $nome;

	public function __construct(
		$id,
		$status,
		$nome
	)
	{
		parent::__construct($id, $status);
		$this->nome = $nome;
	}
	function __get($key)
	{
		return $this->$key;
	}

	function __set($key, $value)
	{
		$this->$key = $value;
	}
	public function toString()
	{
		return $this->nome;
	}
}
