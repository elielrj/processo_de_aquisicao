<?php


defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');

class Arquivo implements InterfaceBO
{

	private $id;
	private $path;
	private $dataHora;
	private $usuarioId;
	private $artefatoId;
	private $processoId;
	private $nome;
	private $status;

	public function __construct(
		$id,
		$path,
		$dataHora,
		$usuarioId,
		$artefatoId,
		$processoId,
		$nome,
		$status
	)
	{
		$this->id = $id;
		$this->path = $path;
		$this->dataHora = $dataHora;
		$this->usuarioId = $usuarioId;
		$this->artefatoId = $artefatoId;
		$this->processoId = $processoId;
		$this->nome = $nome;
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
		include_once 'application/libraries/DataHora.php';
		$dataHora = new DataHora($this->dataHora);

		return array(
			'id' => $this->id ?? null,
			'path' => $this->path,
			'data_hora' => $dataHora->formatoDoMySQL(),
			'usuario_id' => $this->usuarioId,
			'artefato_id' => $this->artefatoId,
			'processo_id' => $this->processoId,
			'nome' => $this->nome ?? '',
			'status' => $this->status,
		);
	}
}
