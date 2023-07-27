<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once '../AbstractBO.php';
require_once 'status_do_andamento/InterfaceStatusDoAndamento.php';

class Andamento extends AbstractBO implements InterfaceStatusDoAndamento
{

	private $statusDoAndamento;
	private $dataHora;
	private $usuario;

	public function __construct(
		$id,
		$status,
		$statusDoAndamento,
		$dataHora,
		$usuario
	)
	{
		parent::__construct($id, $status);
		$this->statusDoAndamento = $statusDoAndamento;
		$this->dataHora = $dataHora;
		$this->usuario = $usuario;
	}

	public function nome()
	{
		return $this->statusDoAndamento->nome();
	}
}

?>
