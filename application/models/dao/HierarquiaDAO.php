<?php

require_once 'AbstractDAO.php';

class HierarquiaDAO extends AbstractDAO
{
	const TABELA_HIERARQUIA = 'hierarquia';

	public function __construct()
	{
		$this->load->model('dao/DAO');
	}

	public function criar($objeto)
	{
		$this->DAO->criar(HierarquiaDAO::TABELA_HIERARQUIA, $objeto->array());
	}

	public function buscarTodos($inicial, $final)
	{
		$array = $this->DAO->buscarTodos(HierarquiaDAO::TABELA_HIERARQUIA, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarTodosDesativados($inicial, $final)
	{
		$array = $this->DAO->buscarTodosDesativados(HierarquiaDAO::TABELA_HIERARQUIA, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($hierarquiaId)
	{
		$array = $this->DAO->buscarPorId(HierarquiaDAO::TABELA_HIERARQUIA, $hierarquiaId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(HierarquiaDAO::TABELA_HIERARQUIA, array($key => $value));

		return $this->criarLista($array->result());
	}

	public function atualizar($hierarquia)
	{
		$this->DAO->atualizar(HierarquiaDAO::TABELA_HIERARQUIA, $hierarquia->array());
	}


	public function deletar($hierarquia)
	{
		$this->DAO->deletar(HierarquiaDAO::TABELA_HIERARQUIA, $hierarquia->array());
	}

	public function contar()
	{
		return $this->DAO->contar(TABELA_HIERARQUIA);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(TABELA_HIERARQUIA);
	}

	private function toObject($arrayList)
	{
		return new Hierarquia(
			isset($arrayList->id)
				? $arrayList->id
				: (isset($arrayList['id']) ? $arrayList['id'] : null),
			isset($arrayList->posto_ou_graduacao)
				? $arrayList->posto_ou_graduacao
				: (isset($arrayList['posto_ou_graduacao']) ? $arrayList['posto_ou_graduacao'] : null),
			isset($arrayList->sigla)
				? $arrayList->sigla
				: (isset($arrayList['sigla']) ? $arrayList['sigla'] : null),
			isset($arrayList->status)
				? $arrayList->status
				: (isset($arrayList['status']) ? $arrayList['status'] : null)
		);
	}

	private function criarLista($array)
	{
		$listaDeHierarquia = array();

		foreach ($array->result() as $linha) {

			$hierarquia = $this->toObject($linha);

			array_push($listaDeHierarquia, $hierarquia);
		}

		return $listaDeHierarquia;
	}

	public function options()
	{
		$hierarquias = $this->buscarTodos(null, null);

		$options = [];

		if (isset($hierarquias)) {

			foreach ($hierarquias as $hierarquia) {

				$options += [$hierarquia->id => $hierarquia->postoOuGraduacao];
			}
		}
		return $options;
	}

	public function array()
	{
		return array(
			'id' => ($this->id ?? null),
			'posto_ou_graduacao' => $this->postoOuGraduacao,
			'sigla' => $this->sigla,
			'status' => $this->status
		);
	}

}
