<?php

require_once 'AbstractDAO.php';
class DepartamentoDAO  extends AbstractDAO
{
	const TABELA_DEPARTAMENTO = 'departamento';

	public function __construct()
	{
		parent::__construct();
	}

	public function criar($objeto)
	{
		$this->DAO->criar(DepartamentoDAO::TABELA_DEPARTAMENTO, $objeto->array());
	}

	public function buscarTodos($inicial, $final)
	{
		$array = $this->DAO->buscarTodos(DepartamentoDAO::TABELA_DEPARTAMENTO, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarTodosDesativados($inicial, $final)
	{
		$array = $this->DAO->buscarTodosDesativados(DepartamentoDAO::TABELA_DEPARTAMENTO, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($departamentoId)
	{
		$array = $this->DAO->buscarPorId(DepartamentoDAO::TABELA_DEPARTAMENTO, $departamentoId);

		$departamento = $this->toObject($array->result()[0]);

		return $departamento;
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(DepartamentoDAO::TABELA_DEPARTAMENTO, array($key => $value));

		return $this->criarLista($array->result());
	}

	public function atualizar($departamento)
	{
		$this->DAO->atualizar(DepartamentoDAO::TABELA_DEPARTAMENTO, $departamento->array());
	}


	public function deletar($id)
	{
		$departamento = $this->buscarPorId($id);

		$departamento->status = false;

		$this->DAO->atualizar(DepartamentoDAO::TABELA_DEPARTAMENTO, $departamento->array());
	}

	public function contar()
	{
		return $this->DAO->contar(TABELA_DEPARTAMENTO);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(TABELA_DEPARTAMENTO);
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
