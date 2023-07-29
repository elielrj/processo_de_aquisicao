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

	public function toString()
	{
		return $this->nome;
	}
}
