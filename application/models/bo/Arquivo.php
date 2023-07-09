<?php

use helper\Tempo;

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');
include_once('application/models/helper/Tempo.php');

class Arquivo implements InterfaceBO
{

	private $id;
	private $path;
	private Tempo $dataHora;
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
		return array(
			'id' => $this->id ?? null,
			'path' => $this->path,
			'data_hora' => $this->dataHora->dataHoraNoFormatoMySQL(),
			'usuario_id' => $this->usuarioId,
			'artefato_id' => $this->artefatoId,
			'processo_id' => $this->processoId,
			'nome' => $this->nome ?? '',
			'status' => $this->status,
		);
	}
}
