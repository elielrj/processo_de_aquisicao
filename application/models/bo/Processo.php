<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');
include_once('Criado.php');
include_once('Enviado.php');
include_once('Aprovado.php');
include_once('Executado.php');
include_once('Conformado.php');
include_once('Arquivado.php');


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
			'data_hora' => $this->dataHora,
			'chave' => $this->chave,
			'departamento_id' => $this->departamento->id,
			'lei_id' => $this->lei->id,
			'tipo_id' => $this->tipo->id,
			'completo' => $this->completo,
			'status' => $this->status
		);
	}
}
