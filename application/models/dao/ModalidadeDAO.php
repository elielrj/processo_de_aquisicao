<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Modalidade.php');

class ModalidadeDAO extends CI_Model
{

	public static $TABELA_DB = 'modalidade';

	public function __construct()
	{
		$this->load->model('dao/DAO');
	}

	public function criar($objeto)
	{
		$this->DAO->criar(self::$TABELA_DB, $objeto->array());
	}

	public function buscarTodos($inicial, $final)
	{
		$array = $this->DAO->buscarTodos(self::$TABELA_DB, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarTodosDesativados($inicial, $final)
	{
		$array = $this->DAO->buscarTodosDesativados(self::$TABELA_DB, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($modalidadeId): Modalidade
	{
		$array = $this->DAO->buscarPorId(self::$TABELA_DB, $modalidadeId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(self::$TABELA_DB, array($key => $value));

		return $this->criarLista($array->result());
	}

	public function atualizar($modalidade)
	{
		$this->DAO->atualizar(self::$TABELA_DB, $modalidade->array());
	}


	public function deletar($modalidade)
	{
		$this->DAO->deletar(self::$TABELA_DB, $modalidade->array());
	}

	public function contar()
	{
		return $this->DAO->contar(self::$TABELA_DB);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(self::$TABELA_DB);
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
