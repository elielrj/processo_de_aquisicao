<?php

require_once 'AbstractDAO.php';

class UgDAO  extends AbstractDAO
{
	const TABELA_UG = 'ug';

	public function __construct()
	{
		parent::__construct();
	}

	public function criar($objeto)
	{
		$this->DAO->criar(UgDAO::TABELA_UG, $objeto->array());
	}

	public function buscarTodos($inicial, $final)
	{
		$array = $this->DAO->buscarTodos(UgDAO::TABELA_UG, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarTodosDesativados($inicial, $final)
	{
		$array = $this->DAO->buscarTodosDesativados(UgDAO::TABELA_UG, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($ugId)
	{
		$array = $this->DAO->buscarPorId(UgDAO::TABELA_UG, $ugId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(UgDAO::TABELA_UG, array($key => $value));

		return $this->criarLista($array->result());
	}

	public function atualizar($ug)
	{
		$this->DAO->atualizar(UgDAO::TABELA_UG, $ug->array());
	}


	public function deletar($ug)
	{
		$this->DAO->deletar(UgDAO::TABELA_UG, $ug->array());
	}

	public function contar()
	{
		return $this->DAO->contar(TABELA_UG);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(TABELA_UG);
	}

	public function toObject($arrayList)
	{
		return new Ug(
			$arrayList->id ?? ($arrayList['id'] ?? null),
			$arrayList->numero ?? ($arrayList['numero'] ?? null),
			$arrayList->nome ?? ($arrayList['nome'] ?? null),
			$arrayList->sigla ?? ($arrayList['sigla'] ?? null),
			$arrayList->status ?? ($arrayList['status'] ?? null)
		);
	}

	private function criarLista($array)
	{
		$listaDeUg = array();

		foreach ($array->result() as $linha) {

			$ug = $this->toObject($linha);

			$listaDeUg[] = $ug;
		}

		return $listaDeUg;
	}

	public function options()
	{

		$ugs = $this->buscarTodos(null, null);

		$options = [];

		if (isset($ugs)) {

			foreach ($ugs as $key => $ug) {

				$options += [$ug->id => $ug->toString()];
			}
		}
		return $options;
	}
	public function array()
	{
		return array(
			'id' => $this->id ?? null,
			'numero' => $this->numero,
			'nome' => $this->nome,
			'sigla' => $this->sigla,
			'status' => $this->status
		);
	}

}
