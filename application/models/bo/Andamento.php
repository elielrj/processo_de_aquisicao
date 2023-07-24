<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');
include_once('status_do_andamento/StatusDoAndamento.php');
include_once('status_do_andamento/Criado.php');  //Nível 0
include_once('status_do_andamento/Enviado.php');  //Nível 1
include_once('status_do_andamento/AprovadoFiscAdm.php');  //Nível 2
include_once('status_do_andamento/AprovadoOd.php');  //Nível 2
include_once('status_do_andamento/Executado.php');  //Nível 3
include_once('status_do_andamento/Conformado.php');  //Nível 4
include_once('status_do_andamento/Arquivado.php');  //Nível 5
include_once 'application/models/dao/AndamentoDAO.php';

class Andamento implements StatusDoAndamento, InterfaceBO
{

	private $id;
	private $statusDoAndamento;
	private $dataHora;
	private $processo_id;
	private $usuario;
	private $status;

	public function __construct(
		$id,
		$statusDoAndamento,
		$dataHora,
		$processo_id,
		$usuario,
		$status
	)
	{
		$this->id = $id ?? null;
		$this->statusDoAndamento = $statusDoAndamento;
		$this->dataHora = $dataHora;
		$this->processo_id = $processo_id;
		$this->usuario = $usuario;
		$this->status = $status;
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
			ID => $this->id ?? null,
			STATUS_DO_ANDAMENTO => $this->statusDoAndamento->nome(),
			DATA_HORA  => $this->dataHora,
			PROCESSO_ID => $this->processo_id,
			USUARIO_ID => $_SESSION[SESSION_ID],
			STATUS => $this->status,
		);
	}

	public static function selecionarStatus($nome)
	{
		switch ($nome) {
			case Criado::NOME:
				return new Criado();
			case Enviado::NOME:
				return new Enviado();
			case AprovadoFiscAdm::NOME:
				return new AprovadoFiscAdm();
			case AprovadoOd::NOME:
				return new AprovadoOd();
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
		return $this->statusDoAndamento->nome();
	}

	public function nivel()
	{
		return $this->statusDoAndamento->nivel();
	}
}

?>
