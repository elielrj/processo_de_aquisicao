<?php

require_once 'abstract_bo/AbstractBO.php';

class Arquivo extends AbstractBO
{
	private $nome;
	private $path;
	private $dataHora;
	private $usuario;

	public function __construct(
		$id,
		$status,
		$nome,
		$path,
		$dataHora,
		$usuario
	)
	{
		parent::__construct($id, $status);
		$this->nome = $nome;
		$this->path = $path;
		$this->dataHora = $dataHora;
		$this->usuario = $usuario;
	}

	public function toString()
	{
		return
			(
			empty($this->nome)
				? ''
				: $this->nome . ' - '
			) .
			'Transferido por ' .
			$this->usuario->toString();
	}
}
