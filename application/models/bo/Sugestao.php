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
		return
			$this->usuario->toString() . ': ' .
			$this->mensagem;
	}
}
