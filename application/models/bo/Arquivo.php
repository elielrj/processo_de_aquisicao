<?php


defined('BASEPATH') or exit('No direct script access allowed');

require_once 'AbstractBO.php';

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
		parent::__contruct($id, $status);
		$this->nome = $nome;
		$this->path = $path;
		$this->dataHora = $dataHora;
		$this->usuario = $usuario;
	}
}
