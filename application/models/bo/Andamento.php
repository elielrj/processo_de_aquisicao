<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');
include_once('Status.php');
include_once('Criado.php');  //Nível 0
include_once('Enviado.php');  //Nível 1
include_once('Aprovado.php');  //Nível 2
include_once('Executado.php');  //Nível 3
include_once('Conformado.php');  //Nível 4
include_once('Arquivado.php');  //Nível 5

class Andamento implements Status, InterfaceBO
{

	private $id;
	private $status;
	private $dataHora;
	private $processo_id;

	public function __construct(
		$id,
		$status,
		$dataHora,
		$processo_id
	)
	{
		$this->id = $id ?? null;
		$this->status = $status;
		$this->dataHora = $dataHora;
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
			'status' => $this->status->nome(),
			'data_hora' => DataLibrary::dataHoraMySQL($this->dataHora),
			'processo_id' => $this->processo_id
		);
	}

	public static function selecionarStatus($nome)
	{
		switch ($nome) {
			case Criado::NOME:
				return new Criado();
			case Enviado::NOME:
				return new Enviado();
			case Aprovado::NOME:
				return new Aprovado();
			case Executado::NOME:
				return new Executado();
			case Conformado::NOME:
				return new Conformado();
			case Arquivado::NOME:
				return new Arquivado();
		}
	}

	public function nome()
	{
		return $this->status->nome();
	}

	public function nivel()
	{
		return $this->status->nivel();
	}
}

?>
