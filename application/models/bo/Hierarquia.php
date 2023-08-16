<?php

require_once 'abstract_bo/AbstractBO.php';

class Hierarquia extends AbstractBO
{
	private $postoOuGraduacao;
	private $sigla;

	public function __construct(
		$id,
		$status,
		$postoOuGraduacao,
		$sigla
	)
	{
		parent::__construct($id, $status);
		$this->postoOuGraduacao = $postoOuGraduacao;
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
