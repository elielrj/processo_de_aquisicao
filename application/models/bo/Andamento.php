<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');
include_once('StatusDoAndamento.php');
include_once('Enviado.php');
include_once('Executado.php');
include_once('Conformado.php');

class Andamento implements StatusDoAndamento, InterfaceBO
{

	private $id;
	private $statusDoAndamento;
	private $dataHora;
	private $processo_id;

	public function __construct(
		$id,
		$statusDoAndamento,
		$dataHora,
		$processo_id
	)
	{
		$this->id = $id;
		$this->statusDoAndamento = $statusDoAndamento ?? new Enviado();
		$this->dataHora = $dataHora ?? DataLibrary::dataHoraMySQL();
		$this->processo_id = $processo_id;
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
			'status_do_andamento' => $this->statusDoAndamento->nome(),
			'data_hora' => DataLibrary::dataHoraMySQL($this->dataHora),
			'processo_id' => $this->processo_id
		);
	}

	public static function selecionarStatus($nome)
	{
		if ($nome == Enviado::NOME) {
			return new Enviado();
		} else if ($nome == Executado::NOME) {
			return new Executado();
		} else if ($nome == Conformado::NOME) {
			return new Conformado();
		}
	}

	public function nome()
	{
		return $this->statusDoAndamento->nome();
	}

	public function nivel()
	{
		return $this->statusDoAndamento->nivel();
	}
}

?>
