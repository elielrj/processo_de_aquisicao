<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once 'InterfaceDAO.php';

class SugestaoDAO extends CI_Model implements IntefaceDAO
{
	public function __construct()
	{
		parent::__contruct();
	}

	public function criar($objeto)
	{
		$this->DAO->criar(TABLE_SUGESTAO, $objeto->array());
	}

	public function buscarTodos($inicial, $final)
	{
		$array = $this->DAO->buscarTodos(TABLE_SUGESTAO, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarTodosDesativados($inicial, $final)
	{
		$array = $this->DAO->buscarTodosDesativados(TABLE_SUGESTAO, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($sugestaoId)
	{
		$array = $this->DAO->buscarPorId(TABLE_SUGESTAO, $sugestaoId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(TABLE_SUGESTAO, array($key => $value));

		return $this->criarLista($array->result());
	}

	public function atualizar($sugestao)
	{
		$this->DAO->atualizar(TABLE_SUGESTAO, $sugestao->array());
	}


	public function deletar($sugestao)
	{
		$this->DAO->deletar(TABLE_SUGESTAO, $sugestao->array());
	}

	public function contar()
	{
		return $this->DAO->contar(TABLE_SUGESTAO);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(TABLE_SUGESTAO);
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


	public function array()
	{
		return array(
			'id' => $this->id ?? null,
			'mensagem' => $this->mensagem,
			'status' => $this->status,
			'usuario_id' => $this->usuario_id
		);
	}
}
