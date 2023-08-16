<?php

require_once 'abstract_bo/AbstractBO.php';

class Departamento extends AbstractBO
{

	private $nome;
	private $sigla;
	private $ug;

	public function __construct(
		$id,
		$status,
		$nome,
		$sigla,
		$ug
	)
	{
		parent::__construct($id, $status);
		$this->nome = $nome;
		$this->sigla = $sigla;
		$this->ug = $ug;
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
		return $this->sigla;
	}
}
