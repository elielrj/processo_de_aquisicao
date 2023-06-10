<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');

class Departamento implements InterfaceBO
{

	private $id;
	private $nome;
	private $sigla;
	private $ug;
	private $status;

	public function __construct(
		$id,
		$nome,
		$sigla,
		$ug,
		$status = true
	)
	{
		$this->id = $id;
		$this->nome = $nome;
		$this->sigla = $sigla;
		$this->ug = $ug;
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

	public function toString()
	{
		return $this->nome . ' (' . $this->sigla . ')';
	}

	public function array(): array
	{
		return array(
			'id' => isset($this->id) ? $this->id : null,
			'nome' => $this->nome,
			'sigla' => $this->sigla,
			'ug_id' => $this->ug->id,
			'status' => $this->status
		);
	}

}
