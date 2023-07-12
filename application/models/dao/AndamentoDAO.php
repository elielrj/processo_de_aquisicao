<?php

defined('BASEPATH') or exit('No direct script access allowed');

use  helper\Tempo;

include_once('application/models/bo/Andamento.php');
include_once('application/models/bo/status_do_andamento/*.php');

include_once 'application/models/helper/Tempo.php';

class AndamentoDAO extends CI_Model implements InterfaceDAO
{
	const ANDAMENTO_DAO = 'dao/AndamentoDAO';

	const TABELA_DB = 'andamento';

	public function __construct()
	{
		parent::__construct();
	}

	public function criar($objeto)
	{
		$this->db->insert(
			self::TABELA_DB,
			$objeto->array()
		);
	}

	public function atualizar($objeto)
	{
		$this->db->update(
			self::TABELA_DB,
			$objeto->array(),
			['id' => $objeto->id]
		);
	}

	public function buscarPorId($objetoId)
	{
		$linhaArrayList =
			$this->db->get_where(
				self::TABELA_DB,
				['id' => $objetoId]
			);

		return $this->toObject($linhaArrayList);
	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		$arrayList =
			$this->db
				->order_by('data_hora', 'DESC')
				->where(['status' => true])
				->get(self::TABELA_DB, $inicio, $fim);

		return $this->criarLista($arrayList);
	}

	public function buscarTodosInativos($inicio, $fim)
	{
		$arrayList =
			$this->db
				->order_by('data_hora', 'DESC')
				->where(['status' => false])
				->get(self::TABELA_DB, $inicio, $fim);

		return $this->criarLista($arrayList);
	}

	public function buscarTodosStatus($inicio, $fim)
	{
		$arrayList =
			$this->db
				->order_by('id', 'ASC')
				->get(self::TABELA_DB, $inicio, $fim);

		return $this->criarLista($arrayList);
	}

	public function buscarAonde($whare)
	{
		$arrayList =
			$this->db
				->where($whare)
				->get(self::TABELA_DB);

		return $this->criarLista($arrayList);
	}

	public function excluirDeFormaPermanente($objetoId)
	{
		$this->db->delete(
			self::TABELA_DB,
			['id' => $objetoId]);
	}

	public function excluirDeFormaLogica($objetoId)
	{
		$linhaArrayList = $this->buscarPorId($objetoId);

		$andamento = $this->toObject($linhaArrayList);

		$andamento->status = false;

		$this->atualizar($andamento);
	}

	public function contarRegistrosAtivos()
	{
		return $this->db
			->where(['status' => true])
			->count_all_results(self::TABELA_DB);
	}

	public function contarRegistrosInativos()
	{
		return $this->db
			->where(['status' => false])
			->count_all_results(self::TABELA_DB);
	}

	public function contarTodosOsRegistros()
	{
		return $this->db
			->count_all_results(self::TABELA_DB);
	}

	public function criarLista($arrayList)
	{
		$listaDeAndamentos = [];

		foreach ($arrayList->result() as $linha) {
			$listaDeAndamento[] = $this->toObject($linha);
		}

		return $listaDeAndamento;
	}

	public function toObject($linhaDoArrayList)
	{
		$id = $linhaDoArrayList->id ?? $linhaDoArrayList['id'] ?? null;
		$statusDoAndamento = $linhaDoArrayList->status_do_andamento ?? $linhaDoArrayList['status_do_andamento'] ?? null;
		$dataHora = $linhaDoArrayList->data_hora ?? $linhaDoArrayList['data_hora'] ?? null;
		$processo_id = $linhaDoArrayList->processo_id ?? $linhaDoArrayList['processo_id'] ?? null;
		$usuario_id = $linhaDoArrayList->usuario_id ?? $linhaDoArrayList['usuario_id'] ?? null;
		$status = $linhaDoArrayList->status ?? $linhaDoArrayList['status'] ?? null;

		return
			new Andamento(
				$id,
				Andamento::selecionarStatus($statusDoAndamento),
				new Tempo($dataHora),
				$processo_id,
				$usuario_id,
				$status
			);
	}

	public function options()
	{
		$options = [Criado::$NOME => Criado::$NOME];
		$options += [Enviado::$NOME => Enviado::$NOME];
		$options += [AprovadoFiscAdm::$NOME => AprovadoFiscAdm::$NOME];
		$options += [Executado::$NOME => Executado::$NOME];
		$options += [Conformado::$NOME => Conformado::$NOME];
		$options += [Arquivado::$NOME => Arquivado::$NOME];

		return $options;
	}

	public function buscarTodosOsAndamentosDeUmProcesso($procesoId)
	{
		$whare = array('processo_id' => $procesoId);

		$arrayList =
			$this->db
				->order_by('data_hora', 'DESC')
				->where(['processo_id' => $procesoId])
				->get(self::TABELA_DB);

		return $this->criarLista($arrayList);
	}

	/*
	| *
	| */


	public function processoEnviado($processo_id)
	{
		$andamento = new Andamento(
			null,
			new Enviado(),
			new Tempo(),
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
			new Tempo(),
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
			new Tempo(),
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
			new Tempo(),
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
			new Tempo(),
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
			new Tempo(),
			$processo_id,
			$_SESSION['id'],
			true
		);

		$this->AndamentoDAO->criar($andamento);

	}

}
