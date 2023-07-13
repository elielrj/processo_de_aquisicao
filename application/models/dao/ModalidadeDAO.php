<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Modalidade.php');

class ModalidadeDAO extends CI_Model
{


	public function __construct()
	{
		$this->load->model('dao/DAO');
	}

	public function criar($objeto)
	{
		$this->DAO->criar(TABLE_MODALIDADE, $objeto->array());
	}

	public function buscarTodos($inicial, $final)
	{
		$array = $this->DAO->buscarTodos(TABLE_MODALIDADE, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarTodosDesativados($inicial, $final)
	{
		$array = $this->DAO->buscarTodosDesativados(TABLE_MODALIDADE, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($modalidadeId): Modalidade
	{
		$array = $this->DAO->buscarPorId(TABLE_MODALIDADE, $modalidadeId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(TABLE_MODALIDADE, array($key => $value));

		return $this->criarLista($array->result());
	}

	public function atualizar($modalidade)
	{
		$this->DAO->atualizar(TABLE_MODALIDADE, $modalidade->array());
	}


	public function deletar($modalidade)
	{
		$this->DAO->deletar(TABLE_MODALIDADE, $modalidade->array());
	}

	public function contar()
	{
		return $this->DAO->contar(TABLE_MODALIDADE);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(TABLE_MODALIDADE);
	}

	private function toObject($arrayList)
	{
		return new Modalidade(
			$arrayList->id ?? ($arrayList['id'] ?? null),
			$arrayList->nome ?? ($arrayList['nome'] ?? null),
			$arrayList->status ?? ($arrayList['status'] ?? null)
		);
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
