<?php

defined('BASEPATH') or exit('No direct script access allowed');

use  helper\Tempo;

include_once('application/models/bo/Andamento.php');
include_once('application/models/bo/status_do_andamento/Criado.php');
include_once('application/models/bo/status_do_andamento/Enviado.php');
include_once('application/models/bo/status_do_andamento/AprovadoFiscAdm.php');
include_once('application/models/bo/status_do_andamento/AprovadoOd.php');
include_once('application/models/bo/status_do_andamento/Executado.php');
include_once('application/models/bo/status_do_andamento/Conformado.php');
include_once('application/models/bo/status_do_andamento/Arquivado.php');

include_once 'application/models/helper/Tempo.php';

class AndamentoDAO extends CI_Model
{

	public static $TABELA_DB = 'andamento';

	public function __construct()
	{
		$this->load->model('dao/DAO');
	}

	public function criar($objeto)
	{
		$this->DAO->criar(self::$TABELA_DB, $objeto->array());
	}

	public function atualizar($andamento)
	{
		$this->DAO->atualizar(self::$TABELA_DB, $andamento->array());
	}

	/**
	 * @param $key
	 * @param $value
	 * @return array
	 * Devolve uma lista de Objetos de Andamento em Ordem descrescente por DataTime
	 */
	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOndeOrderById(self::$TABELA_DB, array($key => $value));

		$listaDeAndamento = [];

		foreach ($array->result() as $andamento) {

			$listaDeAndamento[] = $this->toObject($andamento);
		}

		return $listaDeAndamento;
	}

	public function buscarTodosAtivosInativos($inicial, $final)
	{
		$array = $this->DAO->buscarTodosAtivosInativosOrderByProcessoId(self::$TABELA_DB, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarTodosAtivosInativosDeUmProcesso($proceso_id)
	{
		$whare = array('processo_id' => $proceso_id);

		$array = $this->DAO->buscarOndeOrderById(self::$TABELA_DB, $whare);

		return $this->criarLista($array);
	}

	public static function toObject($arrayList)
	{
		return new Andamento(
			$arrayList->id ?? ($arrayList['id'] ?? null),
			isset($arrayList->status_do_andamento)
				? (Andamento::selecionarStatus($arrayList->status_do_andamento))
				: (isset($arrayList['status_do_andamento']) ? Andamento::selecionarStatus($arrayList['status_do_andamento']) : null),
			isset($arrayList->data_hora)
				? (new Tempo($arrayList->data_hora))
				: (isset($arrayList['data_hora']) ? new Tempo($arrayList['data_hora']) : null),
			$arrayList->processo_id ?? ($arrayList['processo_id'] ?? null),
			$arrayList->usuario_id ?? ($arrayList['usuario_id'] ?? null),
			$arrayList->status ?? ($arrayList['status'] ?? null)
		);
	}

	private function criarLista($array)
	{
		$listaDeAndamento = array();

		foreach ($array->result() as $linha) {

			$andamento = $this->toObject($linha);

			$listaDeAndamento[] = $andamento;
		}

		return $listaDeAndamento;
	}

	public function options()
	{
		$options = [Criado::$NOME => Criado::$NOME];
		$options += [Enviado::$NOME => Enviado::$NOME];
		$options += [AprovadoFiscAdm::$NOME => AprovadoFiscAdm::$NOME];
		$options += [Executado::$NOME => Executado::$NOME];
		$options += [Conformado::$NOME => Conformado::$NOME];
		$options += [Arquivado::$NOME => Arquivado::$NOME];
	}

	public function contarAtivosInativos()
	{
		return $this->DAO->contarAtivosInativos(self::$TABELA_DB);
	}

	public function processoEnviado($processo_id)
	{
		$andamento = new Andamento(
			null,
			new Enviado(),
			DataLibrary::dataHoraMySQL(),
			$processo_id,
			$_SESSION['id'],
			true
		);

		$this->AndamentoDAO->criar($andamento);
		return;
	}

	public function processoAprovadoFiscAdm($processo_id)
	{
		$andamento = new Andamento(
			null,
			new AprovadoFiscAdm(),
			DataLibrary::dataHoraMySQL(),
			$processo_id,
			$_SESSION['id'],
			true
		);

		$this->AndamentoDAO->criar($andamento);
	}

	public function processoAprovadoOd($processo_id)
	{
		$andamento = new Andamento(
			null,
			new AprovadoOd(),
			DataLibrary::dataHoraMySQL(),
			$processo_id,
			$_SESSION['id'],
			true
		);

		$this->AndamentoDAO->criar($andamento);
	}

	public function processoExecutado($processo_id)
	{
		$andamento = new Andamento(
			null,
			new Executado(),
			DataLibrary::dataHoraMySQL(),
			$processo_id,
			$_SESSION['id'],
			true
		);

		$this->AndamentoDAO->criar($andamento);
	}

	public function processoConformado($processo_id)
	{
		$andamento = new Andamento(
			null,
			new Conformado(),
			DataLibrary::dataHoraMySQL(),
			$processo_id,
			$_SESSION['id'],
			true
		);

		$this->AndamentoDAO->criar($andamento);

	}

	public function processoArquivar($processo_id)
	{
		$andamento = new Andamento(
			null,
			new Arquivado(),
			DataLibrary::dataHoraMySQL(),
			$processo_id,
			$_SESSION['id'],
			true
		);

		$this->AndamentoDAO->criar($andamento);

	}

}
