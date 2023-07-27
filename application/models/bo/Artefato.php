<?php

include_once('AbstractBO.php');

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

	public function toString()
	{
		return $this->nome;
	}
}
