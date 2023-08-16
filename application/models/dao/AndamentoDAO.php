<?php

require_once 'abstract_dao/AbstractDAO.php';

class AndamentoDAO extends AbstractDAO
{
	const TABELA_ANDAMENTO = 'andamento';

	public function __construct()
	{
		parent::__construct();
	}

	public function criar($array)
	{
		$this->db->insert(
			self::TABELA_ANDAMENTO,
			$array
		);
	}

	public function atualizar($array, $where)
	{
		$this->db->update(
			self::TABELA_ANDAMENTO,
			$array,
			$where
		);
	}

	public function buscarPorId($id)
	{
		return $this->db->get_where(
			self::TABELA_ANDAMENTO,
			[ID => $id]
		);
	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		return
			$this->db
				->order_by(DATA_HORA, DIRECTIONS_ASC)
				->where([STATUS => true])
				->get(self::TABELA_ANDAMENTO, $inicio, $fim);
	}

	public function buscarTodosInativos($inicio, $fim)
	{
		return
			$this->db
				->order_by(DATA_HORA, DIRECTIONS_DESC)
				->where([STATUS => false])
				->get(self::TABELA_ANDAMENTO, $inicio, $fim);
	}

	public function buscarTodosStatus($inicio, $fim)
	{
		return
			$this->db
				->order_by(ID, DIRECTIONS_ASC)
				->get(self::TABELA_ANDAMENTO, $inicio, $fim);
	}

	public function buscarAonde($whare)
	{
		return
			$this->db
				->where($whare)
				->get(self::TABELA_ANDAMENTO);
	}

	public function excluirDeFormaPermanente($id)
	{
		$this->db->delete(
			self::TABELA_ANDAMENTO,
			[ID => $id]);
	}

	public function excluirDeFormaLogica($id)
	{
		$linhaArrayList = $this->buscarPorId($id);

		foreach ($linhaArrayList as $linha) {
			$linha->status = false;
		}

		$this->db->update($linhaArrayList);
	}

	public function contarRegistrosAtivos()
	{
		return $this->db
			->where([STATUS => true])
			->count_all_results(self::TABELA_ANDAMENTO);
	}

	public function contarRegistrosInativos()
	{
		return $this->db
			->where([STATUS => false])
			->count_all_results(self::TABELA_ANDAMENTO);
	}

	public function contarTodosOsRegistros()
	{
		return $this->db
			->count_all_results(self::TABELA_ANDAMENTO);
	}

	public function options()
	{
		return [
			Criado::$NOME => Criado::$NOME,
			Enviado::$NOME => Enviado::$NOME,
			AprovadoFiscAdm::$NOME => AprovadoFiscAdm::$NOME,
			Executado::$NOME => Executado::$NOME,
			Conformado::$NOME => Conformado::$NOME,
			Arquivado::$NOME => Arquivado::$NOME
		];
	}
	public function contarTodosOsRegistrosAonde($where)
	{
		return $this->db
			->where($where)
			->count_all_results(self::TABELA_ANDAMENTO);
	}

	public function recuperar($id)
	{
		$linhaArrayList = $this->buscarPorId($id);

		foreach ($linhaArrayList as $linha) {
			$linha->status = true;
		}

		$this->db->update($linhaArrayList);
	}

	public function buscarAondeComInicioEFim($where, $inicio, $fim)
	{
		return
			$this->db
				->where($where)
				->get(self::TABELA_ANDAMENTO, $inicio, $fim);
	}
}
