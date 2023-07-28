<?php

require_once 'AbstractDAO.php';
class LeiDAO  extends AbstractDAO
{
	const TABELA_LEI = 'lei';

	public function __construct()
	{
		$this->load->model('dao/ModalidadeDAO');
		$this->load->model('dao/DAO');
	}

	public function criar($objeto)
	{
		$this->DAO->criar(LeiDAO::TABELA_LEI, $objeto->array());
	}

	public function buscarTodos($inicial, $final)
	{
		$array = $this->DAO->buscarTodos(LeiDAO::TABELA_LEI, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarTodosDesativados($inicial, $final)
	{
		$array = $this->DAO->buscarTodosDesativados(LeiDAO::TABELA_LEI, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($leiId)
	{
		$array = $this->DAO->buscarPorId(LeiDAO::TABELA_LEI, $leiId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(LeiDAO::TABELA_LEI, array($key => $value));

		return $this->criarLista($array);
	}

	public function atualizar($lei)
	{
		$this->DAO->atualizar(LeiDAO::TABELA_LEI, $lei->array());
	}


	public function deletar($lei)
	{
		$this->DAO->deletar(LeiDAO::TABELA_LEI, $lei->array());
	}

	public function contar()
	{
		return $this->DAO->contar(TABELA_LEI);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(TABELA_LEI);
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
