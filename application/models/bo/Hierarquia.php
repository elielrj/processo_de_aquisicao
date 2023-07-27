<?php

require_once 'AbstractBO.php';

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

	public function toString()
	{
		return $this->sigla;
	}
}
