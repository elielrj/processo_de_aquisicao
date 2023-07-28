<?php

require_once 'AbstractDAO.php';
class SugestaoDAO  extends AbstractDAO
{
	const TABELA_SUGESTAO = 'sugestao';

	public function __construct()
	{
		parent::__contruct();
	}

	public function criar($objeto)
	{
		$this->DAO->criar(SugestaoDAO::TABELA_SUGESTAO, $objeto->array());
	}

	public function buscarTodos($inicial, $final)
	{
		$array = $this->DAO->buscarTodos(SugestaoDAO::TABELA_SUGESTAO, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarTodosDesativados($inicial, $final)
	{
		$array = $this->DAO->buscarTodosDesativados(SugestaoDAO::TABELA_SUGESTAO, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($sugestaoId)
	{
		$array = $this->DAO->buscarPorId(SugestaoDAO::TABELA_SUGESTAO, $sugestaoId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(SugestaoDAO::TABELA_SUGESTAO, array($key => $value));

		return $this->criarLista($array->result());
	}

	public function atualizar($sugestao)
	{
		$this->DAO->atualizar(SugestaoDAO::TABELA_SUGESTAO, $sugestao->array());
	}


	public function deletar($sugestao)
	{
		$this->DAO->deletar(SugestaoDAO::TABELA_SUGESTAO, $sugestao->array());
	}

	public function contar()
	{
		return $this->DAO->contar(TABELA_SUGESTAO);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(TABELA_SUGESTAO);
	}



	private function criarLista($array)
	{
		$listaDeSugestao = array();

		foreach ($array->result() as $linha) {

			$sugestao = $this->toObject($linha);

			$listaDeSugestao[] = $sugestao;
		}

		return $listaDeSugestao;
	}



}
