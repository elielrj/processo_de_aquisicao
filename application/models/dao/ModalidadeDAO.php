<?php

require_once 'AbstractDAO.php';

class ModalidadeDAO  extends AbstractDAO
{

	const TABELA_MODALIDADE = 'modalidade';

	public function __construct()
	{
		$this->load->model('dao/DAO');
	}

	public function criar($objeto)
	{
		$this->DAO->criar(ModalidadeDAO::TABELA_MODALIDADE, $objeto->array());
	}

	public function buscarTodos($inicial, $final)
	{
		$array = $this->DAO->buscarTodos(ModalidadeDAO::TABELA_MODALIDADE, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarTodosDesativados($inicial, $final)
	{
		$array = $this->DAO->buscarTodosDesativados(ModalidadeDAO::TABELA_MODALIDADE, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($modalidadeId): Modalidade
	{
		$array = $this->DAO->buscarPorId(ModalidadeDAO::TABELA_MODALIDADE, $modalidadeId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(ModalidadeDAO::TABELA_MODALIDADE, array($key => $value));

		return $this->criarLista($array->result());
	}

	public function atualizar($modalidade)
	{
		$this->DAO->atualizar(ModalidadeDAO::TABELA_MODALIDADE, $modalidade->array());
	}


	public function deletar($modalidade)
	{
		$this->DAO->deletar(ModalidadeDAO::TABELA_MODALIDADE, $modalidade->array());
	}

	public function contar()
	{
		return $this->DAO->contar(TABELA_MODALIDADE);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(TABELA_MODALIDADE);
	}



	private function criarLista($array): array
	{
		$listaDeModalidade = array();

		foreach ($array->result() as $linha) {

			$modalidade = $this->toObject($linha);

			$listaDeModalidade[] = $modalidade;
		}

		return $listaDeModalidade;
	}

	public function options()
	{
		$modalidades = $this->buscarTodos(null, null);

		$options = [];

		if (isset($modalidades)) {

			foreach ($modalidades as $modalidade) {

				$options += [$modalidade->id => $modalidade->nome];
			}
		}
		return $options;
	}

}
