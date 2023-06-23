<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Andamento.php');

class AndamentoDAO extends CI_Model
{

	public static $TABELA_DB = 'andamento';

	public static $id = 'id';
	public static $statusDoAndamento = 'status_do_andamento';
	public static $dataHora = 'data_hora';
	public static $processo_id = 'processo_id';

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
		$array = $this->DAO->buscarOndeOrderByData(self::$TABELA_DB, array($key => $value));

		$listaDeAndamento = [];

		foreach ($array->result() as $andamento) {

			$listaDeAndamento[] = $this->toObject($andamento);
		}

		return $listaDeAndamento;
	}

	public function buscarTodosAtivosInativos($inicial, $final)
	{
		$array = $this->DAO->buscarTodosAtivosInativos(self::$TABELA_DB, $inicial, $final);

		return $this->criarLista($array);
	}

	public static function toObject($arrayList)
	{
		return new Andamento(
			$arrayList->id ?? ($arrayList['id'] ?? null),
			isset($arrayList->status)
				? (Andamento::selecionarStatus($arrayList->status))
				: (isset($arrayList['status']) ? Andamento::selecionarStatus($arrayList['status']) : null),
			isset($arrayList->data_hora)
				? (DataLibrary::dataHoraBr($arrayList->data_hora))
				: (isset($arrayList['data_hora']) ? DataLibrary::dataHoraBr($arrayList['data_hora']) : null),
			$arrayList->processo_id ?? ($arrayList['processo_id'] ?? null)
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
		$options += [Aprovado::$NOME => Aprovado::$NOME];
		$options += [Executado::$NOME => Executado::$NOME];
		$options += [Conformado::$NOME => Conformado::$NOME];
		$options += [Arquivado::$NOME => Arquivado::$NOME];
	}

	public function contarAtivosInativos()
	{
		return $this->DAO->contarAtivosInativos(self::$TABELA_DB);
	}

}
