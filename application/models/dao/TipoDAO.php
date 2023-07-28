<?php

require_once 'abstract_dao/AbstractDAO.php';

class TipoDAO extends CI_Model
{
	public function __construct()
	{
		$this->load->model('dao/DAO');
	}

	public function criar($objeto)
	{
		$this->DAO->criar(TABLE_TIPO, $objeto->array());
	}

	public function buscarTodos($inicial, $final)
	{
		$array = $this->DAO->buscarTodos(TABLE_TIPO, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarTodosDesativados($inicial, $final)
	{
		$array = $this->DAO->buscarTodosDesativados(TABLE_TIPO, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($tipoId)
	{
		$array = $this->DAO->buscarPorId(TABLE_TIPO, $tipoId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(TABLE_TIPO, array($key => $value));

		return $this->criarLista($array->result());
	}

	public function atualizar($tipo)
	{
		$this->DAO->atualizar(TABLE_TIPO, $tipo->array());
	}


	public function deletar($tipo)
	{
		$this->DAO->deletar(TABLE_TIPO, $tipo->array());
	}

	public function contar()
	{
		return $this->DAO->contar(TABLE_TIPO);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(TABLE_TIPO);
	}

	private function toObject($arrayList)
	{
		return new Tipo(
			$arrayList->id ?? ($arrayList['id'] ?? null),
			$arrayList->nome ?? ($arrayList['nome'] ?? null),
			$arrayList->status ?? ($arrayList['status'] ?? null)
		);
	}

	private function criarLista($array)
	{
		$listaDeTipo = array();

		foreach ($array->result() as $linha) {

			$tipo = $this->toObject($linha);

			$listaDeTipo[] = $tipo;
		}

		return $listaDeTipo;
	}

	public function options()
	{

		$tipos = $this->buscarTodos(null, null);

		$options = [];

		if (isset($tipos)) {

			foreach ($tipos as $key => $tipo) {

				$options += [$tipo->id => $tipo->nome];
			}
		}

		return $options;
	}
	public function array()
	{
		return array(
			'id' => $this->id ?? null,
			'nome' => $this->nome,
			'status' => $this->status
		);
	}

}
