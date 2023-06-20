<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/LeiTipoArtefato.php');


class LeiTipoArtefatoDAO extends CI_Model
{

	public static $TABELA_DB = 'lei_tipo_artefato';

	public function __construct()
	{
		$this->load->model('dao/ArtefatoDAO');
		$this->load->model('dao/LeiDAO');
		$this->load->model('dao/TipoDAO');
		$this->load->model('dao/DAO');
	}

	public function buscarListaDeArtefatos($lei_id, $tipo_id)
	{
		$array = $this->DAO->buscarOnde(self::$TABELA_DB, array('lei_id' => $lei_id, 'tipo_id' => $tipo_id));

		return $this->criarListaDeArtefatos($array);
	}

	private function criarListaDeArtefatos($array)
	{
		$listaDeArtefato = array();

		foreach ($array->result() as $linha) {

			$artefato = $this->ArtefatoDAO->buscarPorId($linha->artefato_id);

			$listaDeArtefato[] = $artefato;
		}

		return $listaDeArtefato;
	}

	private function criarLista($array)
	{
		$lista = array();

		foreach ($array->result() as $linha) {

			$leiTipoArtefato = $this->toObject($linha);

			$lista[] = $leiTipoArtefato;
		}

		return $lista;
	}

	private function toObject($array)
	{
		return new LeiTipoArtefato(
			$array->id,
			$this->LeiDAO->buscarPorId($array->lei_id),
			$this->TipoDAO->buscarPorId($array->tipo_id),
			$this->ArtefatoDAO->buscarPorId($array->artefato_id),
			$array->status
		);
	}

	public function buscarTodos($inicial, $final)
	{
		$array = $this->DAO->buscarTodosOrderBy(self::$TABELA_DB, 'lei_id', $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($leiTipoArtefatoId)
	{
		$array = $this->DAO->buscarPorId(self::$TABELA_DB, $leiTipoArtefatoId);

		return $this->toObject($array->result()[0]);
	}

	public function contar()
	{
		return $this->DAO->contar(self::$TABELA_DB);
	}
}
