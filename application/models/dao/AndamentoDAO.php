<?php

require_once 'AbstractDAO.php';

class AndamentoDAO extends AbstractDAO
{
	const TABELA_ANDAMENTO = 'andamento';
	const STATUS_DO_ANDAMENTO = 'status_do_andamento';


	public function __construct()
	{
		parent::__construct();
	}

	public function criar($objeto)
	{
		$this->db->insert(
			AndamentoDAO::TABELA_ANDAMENTO,
			$this->toArray($objeto)
		);
	}

	public function atualizar($objeto)
	{
		$this->db->update(
			AndamentoDAO::TABELA_ANDAMENTO,
			$this->toArray($objeto),
			[ID => $objeto->id]
		);
	}

	public function buscarPorId($objetoId)
	{
		$linhaArrayList =
			$this->db->get_where(
				AndamentoDAO::TABELA_ANDAMENTO,
				[ID => $objetoId]
			);

		return $this->toObject($linhaArrayList);
	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		$arrayList =
			$this->db
				->order_by(DATA_HORA, DIRECTIONS_ASC)
				->where([STATUS => true])
				->get(AndamentoDAO::TABELA_ANDAMENTO, $inicio, $fim);

		return $this->toObject($arrayList);
	}

	public function buscarTodosInativos($inicio, $fim)
	{
		$arrayList =
			$this->db
				->order_by(DATA_HORA, DIRECTIONS_DESC)
				->where([STATUS => false])
				->get(AndamentoDAO::TABELA_ANDAMENTO, $inicio, $fim);

		return $this->criarLista($arrayList);
	}

	public function buscarTodosStatus($inicio, $fim)
	{
		$arrayList =
			$this->db
				->order_by(ID, DIRECTIONS_ASC)
				->get(AndamentoDAO::TABELA_ANDAMENTO, $inicio, $fim);

		return $this->criarLista($arrayList);
	}

	public function buscarAonde($whare)
	{
		$arrayList =
			$this->db
				->where($whare)
				->get(AndamentoDAO::TABELA_ANDAMENTO);

		return $this->criarLista($arrayList);
	}

	public function excluirDeFormaPermanente($objetoId)
	{
		$this->db->delete(
			AndamentoDAO::TABELA_ANDAMENTO,
			[ID => $objetoId]);
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
			->where([STATUS => true])
			->count_all_results(AndamentoDAO::TABELA_ANDAMENTO);
	}

	public function contarRegistrosInativos()
	{
		return $this->db
			->where([STATUS => false])
			->count_all_results(AndamentoDAO::TABELA_ANDAMENTO);
	}

	public function contarTodosOsRegistros()
	{
		return $this->db
			->count_all_results(AndamentoDAO::TABELA_ANDAMENTO);
	}

	public function criarLista($arrayList)
	{
		$listaDeAndamentos = [];

		foreach ($arrayList->result() as $linha) {
			$listaDeAndamentos[] = $this->toObject($linha);
		}

		return $listaDeAndamentos;
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
		$arrayList =
			$this->db
				->order_by(DATA_HORA, DIRECTIONS_ASC)
				->where(['processo_id' => $procesoId])
				->get(AndamentoDAO::TABELA_ANDAMENTO);

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
			$_SESSION[ID],
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
			$_SESSION[ID],
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
			$_SESSION[ID],
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
			$_SESSION[ID],
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
			$_SESSION[ID],
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
			$_SESSION[ID],
			true
		);

		$this->AndamentoDAO->criar($andamento);

	}

	public static function selecionarStatus($nome)
	{
		switch ($nome) {
			case Criado::NOME:
				return new Criado();
			case Enviado::NOME:
				return new Enviado();
			case AprovadoFiscAdm::NOME:
				return new AprovadoFiscAdm();
			case AprovadoOd::NOME:
				return new AprovadoOd();
			case Executado::NOME:
				return new Executado();
			case Conformado::NOME:
				return new Conformado();
			case Arquivado::NOME:
				return new Arquivado();
		}
	}


}
