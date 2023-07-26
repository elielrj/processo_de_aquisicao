<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once 'InterfaceDAO.php';
require_once 'application/models/bo/Arquivo.php';

class ArquivoDAO extends CI_Model implements InterfaceDAO
{

	public function __construct()
	{
		parent::__construct();
	}

	public function criar($objeto)
	{
		$this->db->insert(
			TABLE_ARQUIVO,
			$objeto->array()
		);
	}

	public function atualizar($objeto)
	{
		$this->db->update(
			TABLE_ARQUIVO,
			$objeto->array(),
			[ID => $objeto->id]
		);
	}

	public function buscarPorId($objetoId)
	{
		$linhaArrayList =
			$this->db->get_where(
				TABLE_ARQUIVO,
				[ID => $objetoId]
			);

		return $this->toObject($linhaArrayList);
	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		$arrayList =
			$this->db
				->order_by(DATA_HORA, DIRECTIONS_DESC)
				->where([STATUS => true])
				->get(TABLE_ARQUIVO, $inicio, $fim);

		return $this->criarLista($arrayList);
	}

	public function buscarTodosStatus($inicio, $fim)
	{
		$arrayList =
			$this->db
				->order_by(ID, DIRECTIONS_ASC)
				->get(TABLE_ARQUIVO, $inicio, $fim);

		return $this->criarLista($arrayList);
	}

	public function buscarAonde($whare)
	{
		$arrayList =
			$this->db
				->where($whare)
				->get(TABLE_ARQUIVO);

		return $this->criarLista($arrayList);
	}

	//todo VERIFICAR SE NÃO SERÁ PRECISO EXCLUIR OUTRO OBJETO PRIMEIRO
	public function excluirDeFormaPermanente($objetoId)
	{
		$this->db->delete(
			TABLE_ARQUIVO,
			[ID => $objetoId]);
	}

	public function excluirDeFormaLogica($objetoId)
	{
		$linhaArrayList = $this->buscarPorId($objetoId);

		$arquivo = $this->toObject($linhaArrayList);

		$arquivo->status = false;

		$this->atualizar($arquivo);
	}

	public function contarRegistrosAtivos()
	{
		return $this->db
			->where([STATUS => true])
			->count_all_results(TABLE_ANDAMENTO);
	}

	public function contarRegistrosInativos()
	{
		return $this->db
			->where([STATUS => false])
			->count_all_results(TABLE_ANDAMENTO);
	}

	public function contarTodosOsRegistros()
	{
		return $this->db
			->count_all_results(TABLE_ANDAMENTO);
	}

	private function criarLista($arrayList)
	{
		$listaDeArquivos = [];

		foreach ($arrayList->result() as $linha) {

			$listaDeArquivos[] = $this->toObject($linha);
		}

		return $listaDeArquivos;
	}


	/**
	 */

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


	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(TABLE_ARQUIVO, array($key => $value));

		return $this->criarLista($array->result());
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
		$id = $arrayList->id ?? ($arrayList['id'] ?? null);
		$path = $arrayList->path ?? ($arrayList['path'] ?? null);
		$data_hora = $arrayList->data_hora ?? ($arrayList['data_hora'] ?? null);
		$usuario_id = $arrayList->usuario_id ?? ($arrayList['usuario_id'] ?? null);
		$artefato_id = $arrayList->artefato_id ?? ($arrayList['artefato_id'] ?? null);

		$this->load->library('DataHora', $data_hora);
		$this->load->model('dao/UsuarioDAO');
		$this->load->model('dao/ArtefatoDAO');

		return new Arquivo(
			$id,
			$path,
			$this->datahora,
			$this->UsuarioDAO->buscarPorId($usuario_id),
			$this->ArtefatoDAO->buscarPorId($artefato_id),
			$arrayList->processo_id ?? ($arrayList['processo_id'] ?? null),
			$arrayList->nome ?? ($arrayList['nome'] ?? ''),
			$arrayList->status ?? ($arrayList['status'] ?? null)
		);
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
