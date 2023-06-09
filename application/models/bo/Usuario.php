<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');

class Usuario implements InterfaceBO
{

	private $id;
	private $nomeDeGuerra;
	private $nomeCompleto;
	private $email;
	private $cpf;
	private $senha;
	private $departamento;
	private $status;
	private $hierarquia;
	private $funcao;

	public function __construct(
		$id,
		$nomeDeGuerra,
		$nomeCompleto,
		$email,
		$cpf,
		$senha,
		$departamento,
		$status = true,
		$hierarquia,
		$funcao
	)
	{
		$this->id = $id;
		$this->nomeDeGuerra = $nomeDeGuerra;
		$this->nomeCompleto = $nomeCompleto;
		$this->email = $email;
		$this->cpf = $cpf;
		$this->senha = $senha;
		$this->departamento = $departamento;
		$this->status = $status;
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

	public function array()
	{
		return array(
			'id' => $this->id ?? null,
			'nome_de_guerra' => $this->nomeDeGuerra,
			'nome_completo' => $this->nomeCompleto,
			'email' => $this->email,
			'cpf' => $this->cpf,
			'senha' => $this->senha,
			'departamento_id' => $this->departamento->id,
			'status' => $this->status,
			'hierarquia_id' => $this->hierarquia->id,
			'funcao_id' => $this->funcao->id,
		);
	}

	public function toString()
	{
		return $this->hierarquia->sigla . ' ' . $this->nomeDeGuerra;
	}

}
