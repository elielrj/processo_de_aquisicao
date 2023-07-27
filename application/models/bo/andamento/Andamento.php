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

	public function toString()
	{
		return
			$this->replace_fisc_adm(
				$this->replace_od(
					$this->nome())) .
			' por ' .
			$this->usuario->toString();
	}

	private function replace_od($value)
	{
		return ucfirst(str_replace('_od', ' OD', $value));
	}

	private function replace_fisc_adm($value)
	{
		return ucfirst(str_replace('_fisc_adm', ' Fisc Adm', $value));
	}
}

?>
