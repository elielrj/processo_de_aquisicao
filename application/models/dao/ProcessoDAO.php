<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Processo.php');

class ProcessoDAO extends CI_Model
{

	public static $TABELA_DB = 'processo';

	public function __construct()
	{
		$this->load->model('dao/DAO');
		$this->load->model('dao/DepartamentoDAO');
		$this->load->model('dao/LeiDAO');
		$this->load->model('dao/TipoDAO');
		$this->load->model('dao/LeiTipoArtefatoDAO');
		$this->load->model('dao/ArquivoDAO');
		$this->load->model('dao/AndamentoDAO');
	}

	public function criar($processo)
	{
		$this->DAO->criar(self::$TABELA_DB, $processo->array());

		$processo = $this->buscarOnde('chave', $processo->chave);

		$andamento = new Andamento(
			null,
			new Criado(),
			DataLibrary::dataHoraMySQL(),
			$processo->id
		);

		$this->AndamentoDAO->criar($andamento);

		return $processo->id;
	}

	public function buscarTodos($inicial, $final)
	{
		$array = $this->DAO->buscarTodosOrderByData(self::$TABELA_DB, $inicial, $final);

		return $this->criarLista($array);
	}


	public function buscarTodosDesativados($inicial, $final)
	{
		$array = $this->DAO->buscarTodosDesativados(self::$TABELA_DB, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($processoId)
	{
		$array = $this->DAO->buscarPorId(self::$TABELA_DB, $processoId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(self::$TABELA_DB, array($key => $value));

		return $this->toObject($array->result()[0]);
	}

	public function atualizar($processo)
	{
		$this->DAO->atualizar(self::$TABELA_DB, $processo->array());
	}

	public function deletar($processo)
	{
		$this->DAO->deletar(self::$TABELA_DB, $processo->array());
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
		$processo = new Processo(
			$arrayList->id ?? ($arrayList['id'] ?? null),
			$arrayList->objeto ?? ($arrayList['objeto'] ?? null),
			$arrayList->numero ?? ($arrayList['numero'] ?? null),
			$arrayList->data_hora ?? ($arrayList['data_hora'] ?? null),
			$arrayList->chave ?? ($arrayList['chave'] ?? null),
			isset($arrayList->departamento_id) ? $this->DepartamentoDAO->buscarPorId($arrayList->departamento_id) : (isset($arrayList['departamento_id']) ? $this->DepartamentoDAO->buscarPorId($arrayList['departamento_id']) : null),
			isset($arrayList->lei_id) ? $this->LeiDAO->buscarPorId($arrayList->lei_id) : (isset($arrayList['lei_id']) ? $this->LeiDAO->buscarPorId($arrayList['lei_id']) : null),
			isset($arrayList->tipo_id) ? $this->TipoDAO->buscarPorId($arrayList->tipo_id) : (isset($arrayList['tipo_id']) ? $this->TipoDAO->buscarPorId($arrayList['tipo_id']) : null),
			$arrayList->completo ?? ($arrayList['completo'] ?? null),
			$arrayList->status ?? ($arrayList['status'] ?? null),
			isset($arrayList->id)
				? $this->AndamentoDAO->buscarOnde('processo_id', $arrayList->id)
				: (isset($arrayList['id'])
				? $this->AndamentoDAO->buscarOnde('processo_id', $arrayList['id'])
				: null)

		);

		/**
		 * LeiTipoArtefatoDAO vai buscar na tabela lei_tipo_artefato todos os artefatos
		 * (entre artefatos, tipos e lei), tem que ser passado os parâmetros lei_id e processo_id
		 */
		$processo->tipo->listaDeArtefatos =
			$this->LeiTipoArtefatoDAO
				->buscarListaDeArtefatos($processo->lei->id, $processo->tipo->id);

		foreach ($processo->tipo->listaDeArtefatos as $artefato) {

			$artefato->arquivos = $this->ArquivoDAO
				->buscarArquivoDoArtefato($processo->id, $artefato->id);
		}

		return $processo;
	}

	private function criarLista($array)
	{
		$listaDeProcesso = array();

		foreach ($array->result() as $linha) {

			$processo = $this->toObject($linha);

			$listaDeProcesso[] = $processo;
		}

		return $listaDeProcesso;
	}

	public function options()
	{

		$processos = $this->buscarTodos(null, null);

		$options = [];

		if (isset($processos)) {

			foreach ($processos as $key => $value) {

				$options += [$value->id => 'Nup/Nud: ' . $value->numero . ' - Objeto: ' . $value->objeto];
			}
		}
		return $options;
	}

	public function buscarProcessoPeloNumeroChave($numero, $chave)
	{
		$array = $this->DAO->buscarOnde(self::$TABELA_DB, array('numero' => $numero, 'chave' => $chave));

		if (isset($array)) {
			return $this->toObject($array->result()[0]);
		} else {
			return null;
		}
	}
}
