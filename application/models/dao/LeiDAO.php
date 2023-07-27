<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once 'InterfaceDAO.php';

class LeiDAO extends CI_Model
{
	public function __construct()
	{
		$this->load->model('dao/ModalidadeDAO');
		$this->load->model('dao/DAO');
	}

	public function criar($objeto)
	{
		$this->DAO->criar(TABLE_LEI, $objeto->array());
	}

	public function buscarTodos($inicial, $final)
	{
		$array = $this->DAO->buscarTodos(TABLE_LEI, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarTodosDesativados($inicial, $final)
	{
		$array = $this->DAO->buscarTodosDesativados(TABLE_LEI, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($leiId)
	{
		$array = $this->DAO->buscarPorId(TABLE_LEI, $leiId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(TABLE_LEI, array($key => $value));

		return $this->criarLista($array);
	}

	public function atualizar($lei)
	{
		$this->DAO->atualizar(TABLE_LEI, $lei->array());
	}


	public function deletar($lei)
	{
		$this->DAO->deletar(TABLE_LEI, $lei->array());
	}

	public function contar()
	{
		return $this->DAO->contar(TABLE_LEI);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(TABLE_LEI);
	}

	public function toObject($array)
	{
		$data = $array->data ?? ($array['data'] ?? null);
		$this->load->library('Data', $data);

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
	public function array()
	{
		include_once 'application/libraries/Data.php';
		$data = new Data($this->data);

		return array(
			'id' => $this->id ?? null,
			'numero' => $this->numero,
			'artigo' => $this->artigo,
			'inciso' => $this->inciso,
			'data' => $data->formatoDoMySQL(),
			'modalidade_id' => $this->modalidade->id,
			'status' => $this->status
		);
	}
}
