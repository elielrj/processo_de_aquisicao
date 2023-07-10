<?php


defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');
include_once('status_do_andamento/Criado.php');
include_once('status_do_andamento/Enviado.php');
include_once('status_do_andamento/AprovadoFiscAdm.php');
include_once('status_do_andamento/AprovadoOd.php');
include_once('status_do_andamento/Executado.php');
include_once('status_do_andamento/Conformado.php');
include_once('status_do_andamento/Arquivado.php');
include_once('application/models/helper/Tempo.php');


class Processo implements InterfaceBO
{

	private $id;
	private $objeto;
	private $numero;
	private $dataHora;
	private $chave;
	private $departamento;
	private $lei;
	private $tipo;
	private $completo;
	private $listaDeAndamento;
	private $status;


	public function __construct(
		$id,
		$objeto,
		$numero,
		$dataHora,
		$chave,
		$departamento,
		$lei,
		$tipo,
		$completo = false,
		$status = true,
		$listaDeAndamento = []
	)
	{
		$this->id = $id;
		$this->objeto = $objeto;
		$this->numero = $numero;
		$this->dataHora = $dataHora;
		$this->chave = $chave;
		$this->departamento = $departamento;
		$this->lei = $lei;
		$this->tipo = $tipo;
		$this->completo = $completo;
		$this->status = $status;
		$this->listaDeAndamento = $listaDeAndamento;
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
			'objeto' => $this->objeto,
			'numero' => $this->numero,
			'data_hora' => $this->dataHora->dataHoraNoFormatoMySQL(),
			'chave' => $this->chave,
			'departamento_id' => $this->departamento->id,
			'lei_id' => $this->lei->id,
			'tipo_id' => $this->tipo->id,
			'completo' => $this->completo,
			'status' => $this->status
		);
	}

	public function toString()
	{
		$nomeDoArquivo =
			'Processo de ' . $this->tipo->toString() .
			', Lei ' . $this->lei->toString() .
			', Número ' . $this->numero;

		return $nomeDoArquivo;
	}
}
