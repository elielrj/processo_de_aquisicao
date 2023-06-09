<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Sugestao.php');

class SugestaoDAO extends CI_Model
{

	public static $TABELA_DB = 'sugestao';

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

	public function buscarPorId($sugestaoId)
	{
		$array = $this->DAO->buscarPorId(self::$TABELA_DB, $sugestaoId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(self::$TABELA_DB, array($key => $value));

		return $this->criarLista($array->result());
	}

	public function atualizar($sugestao)
	{
		$this->DAO->atualizar(self::$TABELA_DB, $sugestao->array());
	}


	public function deletar($sugestao)
	{
		$this->DAO->deletar(self::$TABELA_DB, $sugestao->array());
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
		return new Sugestao(
			$arrayList->id ?? ($arrayList['id'] ?? null),
			$arrayList->nome ?? ($arrayList['mensagem'] ?? null),
			$arrayList->status ?? ($arrayList['status'] ?? null),
			$arrayList->usuario_id ?? ($arrayList['usuario_id'] ?? null)
		);
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
