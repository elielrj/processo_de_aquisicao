<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');
include_once('application/libraries/DataLibrary.php');

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
		$id = null,
		$path,
		$dataHora = null,
		$usuarioId,
		$artefatoId,
		$processoId,
		$nome,
		$status = true
	)
	{
		$this->id = $id ?? null;
		$this->path = $path;
		$this->dataHora = $dataHora ?? DataLibrary::dataHoraBr();
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

	public function array(): array
	{
		return array(
			'id' => $this->id ?? null,
			'path' => $this->path,
			'data_hora' => DataLibrary::dataHoraMySQL($this->dataHora),
			'usuario_id' => $this->usuarioId,
			'artefato_id' => $this->artefatoId,
			'processo_id' => $this->processoId,
			'nome' => $this->nome ?? '',
			'status' => $this->status,
		);
	}
}
