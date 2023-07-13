<?php

defined('BASEPATH') or exit('No direct script access allowed');

use helper\Tempo;

include_once('application/models/bo/Arquivo.php');

class ArquivoDAO extends CI_Model
{


	public function __construct()
	{
		$this->load->model('dao/DAO');
	}

	public function criar($objeto)
	{
		$this->DAO->criar(TABLE_ARQUIVO, $objeto->array());
	}

	public function buscarTodos($inicial, $final)
	{
		$array = $this->DAO->buscarTodos(TABLE_ARQUIVO, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarTodosDesativados($inicial, $final)
	{
		$array = $this->DAO->buscarTodosDesativados(TABLE_ARQUIVO, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($arquivoId)
	{
		$array = $this->DAO->buscarPorId(TABLE_ARQUIVO, $arquivoId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(TABLE_ARQUIVO, array($key => $value));

		return $this->criarLista($array->result());
	}

	public function atualizar($arquivo)
	{
		$this->DAO->atualizar(TABLE_ARQUIVO, $arquivo->array());
	}


	public function deletar($arquivo)
	{
		$this->DAO->deletar(TABLE_ARQUIVO, $arquivo->array());
	}

	public function contar()
	{
		return $this->DAO->contar(TABLE_ARQUIVO);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(TABLE_ARQUIVO);
	}

	public function toObject($arrayList)
	{
		$data_hora = $arrayList->data_hora ?? ($arrayList['data_hora'] ?? null);
		$this->load->library('DataHora',$data_hora);

		return new Arquivo(
			$arrayList->id ?? ($arrayList['id'] ?? null),
			$arrayList->path ?? ($arrayList['path'] ?? null),
			$this->datahora->formatoDoMySQL(),
			$arrayList->usuario_id ?? ($arrayList['usuario_id'] ?? null),
			$arrayList->artefato_id ?? ($arrayList['artefato_id'] ?? null),
			$arrayList->processo_id ?? ($arrayList['processo_id'] ?? null),
			$arrayList->nome ?? ($arrayList['nome'] ?? ''),
			$arrayList->status ?? ($arrayList['status'] ?? null)
		);
	}

	private function criarLista($array)
	{
		$listaDeArquivo = array();

		foreach ($array->result() as $linha) {

			$arquivo = $this->toObject($linha);

			$listaDeArquivo[] = $arquivo;
		}

		return $listaDeArquivo;
	}

	public function buscarArquivosDeUmProcesso($processoId)
	{
		$array = $this->buscarOnde('processo_id', $processoId);

		return $this->criarLista($array);
	}

	public function buscarArquivoDoArtefato($processoId, $artefatoId)
	{
		$whare = array('processo_id' => $processoId, 'artefato_id' => $artefatoId);

		$array = $this->DAO->buscarOnde(TABLE_ARQUIVO, $whare);

		if (!empty($array->result())) {

			$arquivos = [];

			foreach ($array->result() as $linha) {

				$arquivo = $this->toObject($linha);

				array_push($arquivos, $arquivo);

			}

			return $arquivos;

		} else {
			return null;
		}
	}

}
