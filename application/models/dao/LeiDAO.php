<?php

defined('BASEPATH') or exit('No direct script access allowed');

use helper\Tempo;

include_once('application/models/bo/Lei.php');

class LeiDAO extends CI_Model
{

	public static $TABELA_DB = 'lei';

	public function __construct()
	{
		$this->load->model('dao/ModalidadeDAO');
		$this->load->model('dao/DAO');
	}

	public function criar($objeto)
	{
		$this->DAO->criar(self::$TABELA_DB, $objeto->array());
	}

	public function buscarTodos($inicial, $final)
	{
		$array = $this->DAO->buscarTodos(self::$TABELA_DB, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarTodosDesativados($inicial, $final)
	{
		$array = $this->DAO->buscarTodosDesativados(self::$TABELA_DB, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($leiId)
	{
		$array = $this->DAO->buscarPorId(self::$TABELA_DB, $leiId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(self::$TABELA_DB, array($key => $value));

		return $this->criarLista($array);
	}

	public function atualizar($lei)
	{
		$this->DAO->atualizar(self::$TABELA_DB, $lei->array());
	}


	public function deletar($lei)
	{
		$this->DAO->deletar(self::$TABELA_DB, $lei->array());
	}

	public function contar()
	{
		return $this->DAO->contar(self::$TABELA_DB);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(self::$TABELA_DB);
	}

	public function toObject($array)
	{
		$data = $array->data ?? ($array['data'] ?? null);
		$this->load->library('Data',$data);

		return new Lei(
			$array->id ?? ($array['id'] ?? null),
			$array->numero ?? ($array['numero'] ?? null),
			$array->artigo ?? ($array['artigo'] ?? null),
			$array->inciso ?? ($array['inciso'] ?? null),
			$this->data->formatoDoMySQL(),
			isset($array->modalidade_id)
				? $this->ModalidadeDAO->buscarPorId($array->modalidade_id)
				: (isset($array['modalidade_id']) ? $this->ModalidadeDAO->buscarPorId($array['modalidade_id']) : null),
			$array->status
		);
	}

	private function criarLista($array)
	{
		$listaDeLei = array();

		foreach ($array->result() as $linha) {

			$lei = $this->toObject($linha);

			array_push($listaDeLei, $lei);
		}

		return $listaDeLei;
	}

	public function options($modalidadeId = null)
	{
		$leis = array();

		if (isset($modalidadeId)) {
			$leis = $this->buscarLeisPorModalideId($modalidadeId);

		} else {
			$leis = $this->buscarTodos(null, null);
		}

		$options = [];

		if (isset($leis)) {

			foreach ($leis as $lei) {

				$options += array($lei->id => $lei->toString());
			}
		}
		return $options;
	}

	private function buscarLeisPorModalideId($modalidadeId)
	{
		return $this->buscarOnde('modalidade_id', $modalidadeId);
	}

}
