<?php

include_once('abstract_bo/AbstractBO.php');

class Artefato extends AbstractBO
{
	private $ordem;
	private $nome;
	private $listaDeArquivos;

	public function __construct(
		$id,
		$status,
		$ordem,
		$nome,
		$listaDeArquivos
	)
	{
		parent::__construct($id, $status);
		$this->ordem = $ordem;
		$this->nome = $nome;
		$this->listaDeArquivos = $listaDeArquivos;
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
