<?php

require_once 'abstract_bo/AbstractBO.php';

class Usuario extends AbstractBO
{

	private $nomeDeGuerra;
	private $nomeCompleto;
	private $email;
	private $cpf;
	private $senha;
	private $departamento;
	private $hierarquia;
	private $funcao;

	public function __construct(
		$id,
		$status,
		$nomeDeGuerra,
		$nomeCompleto,
		$email,
		$cpf,
		$senha,
		$departamento,
		$hierarquia,
		$funcao
	)
	{
		parent::__construct($id, $status);
		$this->nomeDeGuerra = $nomeDeGuerra;
		$this->nomeCompleto = $nomeCompleto;
		$this->email = $email;
		$this->cpf = $cpf;
		$this->senha = $senha;
		$this->departamento = $departamento;
		$this->hierarquia = $hierarquia;
		$this->funcao = $funcao;
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
		return $this->hierarquia->sigla . ' ' . $this->nomeDeGuerra;
	}
}
