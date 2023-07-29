<?php

require_once 'AbstractDAO.php';
class DepartamentoDAO  extends AbstractDAO
{
	const TABELA_DEPARTAMENTO = 'departamento';

	public function __construct()
	{
		parent::__construct();
	}

	public function criar($array)
	{
		$this->db->insert(
			self::TABELA_DEPARTAMENTO,
			$array
		);
	}

	public function atualizar($array, $where)
	{
		$this->db->update(
			self::TABELA_DEPARTAMENTO,
			$array,
			$where
		);
	}

	public function buscarPorId($id)
	{
		return
			$this->db->get_where(
				self::TABELA_DEPARTAMENTO,
				[ID => $id]
			);
	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		return
			$this->db
				->order_by(DATA_HORA, DIRECTIONS_DESC)
				->where([STATUS => true])
				->get(self::TABELA_DEPARTAMENTO, $inicio, $fim);
	}

	public function buscarTodosInativos($inicio, $fim)
	{
		return
			$this->db
				->order_by(DATA_HORA, DIRECTIONS_DESC)
				->where([STATUS => false])
				->get(self::TABELA_DEPARTAMENTO, $inicio, $fim);
	}


	public function buscarTodosStatus($inicio, $fim)
	{
		return
			$this->db
				->order_by(ID, DIRECTIONS_ASC)
				->get(self::TABELA_DEPARTAMENTO, $inicio, $fim);
	}

	public function buscarAonde($whare)
	{
		return
			$this->db
				->where($whare)
				->get(TABELA_DEPARTAMENTO);
	}

	public function excluirDeFormaPermanente($id)
	{
		$this->db->delete(
			self::TABELA_DEPARTAMENTO,
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

	public function options()
	{
		$options = [];

		foreach ($this->buscarTodosAtivos(null, null) as $departamento) {
			$options += [$departamento->id => $departamento->nome];
		}
		return $options;
	}
}
