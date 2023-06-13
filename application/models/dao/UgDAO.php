<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Ug.php');

class UgDAO extends CI_Model
{

	public static $TABELA_DB = 'ug';

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

	public function buscarPorId($ugId)
	{
		$array = $this->DAO->buscarPorId(self::$TABELA_DB, $ugId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(self::$TABELA_DB, array($key => $value));

		return $this->criarLista($array->result());
	}

	public function atualizar($ug)
	{
		$this->DAO->atualizar(self::$TABELA_DB, $ug->array());
	}


	public function deletar($ug)
	{
		$this->DAO->deletar(self::$TABELA_DB, $ug->array());
	}

	public function contar()
	{
		return $this->DAO->contar(self::$TABELA_DB);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(self::$TABELA_DB);
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


}
