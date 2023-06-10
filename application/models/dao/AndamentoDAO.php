<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Andamento.php');

class AndamentoDAO extends CI_Model
{

	public static string $TABELA_DB = 'andamento';

	public static string $id = 'id';
	public static string $statusDoAndamento = 'status_do_andamento';
	public static string $dataHora = 'data_hora';
	public static string $processo_id = 'processo_id';

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

	public function buscarOnde($key, $value): Andamento
	{
		$array = $this->DAO->buscarOnde(self::$TABELA_DB, array($key => $value));

		return $this->toObject($array->result());
	}

	public function buscarTodosAtivosInativos($inicial, $final): array
	{
		$array = $this->DAO->buscarTodosAtivosInativos(self::$TABELA_DB, $inicial, $final);

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
				? (DataLibrary::dataHoraBr($arrayList->data_hora))
				: (isset($arrayList['data_hora']) ? DataLibrary::dataHoraBr($arrayList['data_hora']) : null),
			$arrayList->processo_id ?? ($arrayList['processo_id'] ?? null)
		);
	}

	private function criarLista($array): array
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
		$options = [Enviado::$NOME => Enviado::$NOME];
		$options += [Executado::$NOME => Executado::$NOME];
		$options += [Conformado::$NOME => Conformado::$NOME];
	}

	public function contarAtivosInativos()
	{
		return $this->DAO->contarAtivosInativos(self::$TABELA_DB);
	}

}
