<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once 'InterfaceDAO.php';

class DepartamentoDAO extends CI_Model implements InterfaceDAO
{
	public function __construct()
	{
		parent::__construct();
	}

	public function criar($objeto)
	{
		$this->DAO->criar(TABLE_DEPARTAMENTO, $objeto->array());
	}

	public function buscarTodos($inicial, $final)
	{
		$array = $this->DAO->buscarTodos(TABLE_DEPARTAMENTO, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarTodosDesativados($inicial, $final)
	{
		$array = $this->DAO->buscarTodosDesativados(TABLE_DEPARTAMENTO, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($departamentoId)
	{
		$array = $this->DAO->buscarPorId(TABLE_DEPARTAMENTO, $departamentoId);

		$departamento = $this->toObject($array->result()[0]);

		return $departamento;
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(TABLE_DEPARTAMENTO, array($key => $value));

		return $this->criarLista($array->result());
	}

	public function atualizar($departamento)
	{
		$this->DAO->atualizar(TABLE_DEPARTAMENTO, $departamento->array());
	}


	public function deletar($id)
	{
		$departamento = $this->buscarPorId($id);

		$departamento->status = false;

		$this->DAO->atualizar(TABLE_DEPARTAMENTO, $departamento->array());
	}

	public function contar()
	{
		return $this->DAO->contar(TABLE_DEPARTAMENTO);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(TABLE_DEPARTAMENTO);
	}

	public function toObject($arrayList)
	{
		return new Departamento(
			$arrayList->id ?? ($arrayList['id'] ?? null),
			$arrayList->nome ?? ($arrayList['nome'] ?? null),
			$arrayList->sigla ?? ($arrayList['sigla'] ?? null),
			isset($arrayList->ug_id)
				? $this->UgDAO->buscarPorId($arrayList->ug_id)
				: (isset($arrayList['ug_id']) ? $this->UgDAO->buscarPorId($arrayList['ug_id']) : null),
			$arrayList->status ?? ($arrayList['status'] ?? null)
		);
	}

	private function criarLista($array)
	{
		$listaDeDepartamento = array();

		foreach ($array->result() as $linha) {

			$departamento = $this->toObject($linha);

			$listaDeDepartamento[] = $departamento;
		}

		return $listaDeDepartamento;
	}

	public function options()
	{
		$departamentos = $this->buscarTodos(null, null);

		$options = [];

		if (isset($departamentos)) {

			foreach ($departamentos as $departamento) {
				$options += [$departamento->id => $departamento->toString()];
			}
		}
		return $options;
	}

}
