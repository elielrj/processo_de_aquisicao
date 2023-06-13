<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Tipo.php');

class TipoDAO extends CI_Model
{

	public static $TABELA_DB = 'tipo';

	public function __construct()
	{
		$this->load->model('dao/DAO');
	}

	public function criar($objeto)
	{
		$this->DAO->criar(self::$TABELA_DB, $objeto->array());
	}

	public function buscarTodos($inicial, $final): array
	{
		$array = $this->DAO->buscarTodos(self::$TABELA_DB, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarTodosDesativados($inicial, $final): array
	{
		$array = $this->DAO->buscarTodosDesativados(self::$TABELA_DB, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($tipoId): Tipo
	{
		$array = $this->DAO->buscarPorId(self::$TABELA_DB, $tipoId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value): array
	{
		$array = $this->DAO->buscarOnde(self::$TABELA_DB, array($key => $value));

		return $this->criarLista($array->result());
	}

	public function atualizar($tipo)
	{
		$this->DAO->atualizar(self::$TABELA_DB, $tipo->array());
	}


	public function deletar($tipo)
	{
		$this->DAO->deletar(self::$TABELA_DB, $tipo->array());
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
		return new Tipo(
			$arrayList->id ?? ($arrayList['id'] ?? null),
			$arrayList->nome ?? ($arrayList['nome'] ?? null),
			$arrayList->status ?? ($arrayList['status'] ?? null)
		);
	}

	private function criarLista($array): array
	{
		$listaDeTipo = array();

		foreach ($array->result() as $linha) {

			$tipo = $this->toObject($linha);

			$listaDeTipo[] = $tipo;
		}

		return $listaDeTipo;
	}

	public function options()
	{

		$tipos = $this->buscarTodos(null, null);

		$options = [];

		if (isset($tipos)) {

			foreach ($tipos as $key => $tipo) {

				$options += [$tipo->id => $tipo->nome];
			}
		}

		return $options;
	}

}
