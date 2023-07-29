<?php

require_once 'abstract_bo/AbstractBO.php';

class Sugestao extends AbstractBO
{

	private $mensagem;
	private $usuario;

	public function __construct(
		$id,
		$status,
		$mensagem,
		$usuario
	)
	{
		parent::__construct($id, $status);
		$this->mensagem = $mensagem;
		$this->usuario = $usuario;
	}

	public function toString()
	{
		return
			$this->usuario->toString() . ': ' .
			$this->mensagem;
	}
}
