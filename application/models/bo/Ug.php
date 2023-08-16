<?php

require_once 'abstract_bo/AbstractBO.php';

class Ug extends AbstractBO
{
	private $numero;
	private $nome;
	private $sigla;

	public function __construct(
		$id,
		$status,
		$numero,
		$nome,
		$sigla
	)
	{
		parent::__construct($id, $status);
		$this->numero = $numero;
		$this->nome = $nome;
		$this->sigla = $sigla;
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
