<?php

require_once 'AbstractDAO.php';

class ArtefatoDAO extends AbstractDAO
{
	const TABELA_ARTEFATO = 'artefato';

	public function __construct()
	{
		parent::__construct();
	}

	public function criar($array)
	{
		$this->db->insert(
			self::TABELA_ARTEFATO,
			$array
		);
	}

	public function atualizar($array, $where)
	{
		$this->db->update(
			self::TABELA_ARTEFATO,
			$array,
			$where
		);
	}

	public function buscarPorId($id)
	{
		return $this->db->get_where(
			self::TABELA_ARTEFATO,
			[ID => $id]
		);
	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		return
			$this->db
				->order_by(DATA_HORA, DIRECTIONS_ASC)
				->where([STATUS => true])
				->get(self::TABELA_ARTEFATO, $inicio, $fim);
	}

	public function buscarTodosInativos($inicio, $fim)
	{
		return
			$this->db
				->order_by(DATA_HORA, DIRECTIONS_DESC)
				->where([STATUS => false])
				->get(self::TABELA_ARTEFATO, $inicio, $fim);
	}

	public function buscarTodosStatus($inicio, $fim)
	{
		return
			$this->db
				->order_by(ID, DIRECTIONS_ASC)
				->get(self::TABELA_ARTEFATO, $inicio, $fim);
	}

	public function buscarAonde($whare)
	{
		return
			$this->db
				->where($whare)
				->get(self::TABELA_ARTEFATO);
	}

	public function excluirDeFormaPermanente($id)
	{
		$this->db->delete(
			self::TABELA_ARTEFATO,
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
			->count_all_results(self::TABELA_ARTEFATO);
	}

	public function contarRegistrosInativos()
	{
		return $this->db
			->where([STATUS => false])
			->count_all_results(self::TABELA_ARTEFATO);
	}

	public function contarTodosOsRegistros()
	{
		return $this->db
			->count_all_results(self::TABELA_ARTEFATO);
	}

	public function options()
	{
		$options = [];

		foreach ($this->buscarTodosAtivos(null, null) as $artefato) {
			$options += [$artefato->id => $artefato->nome];
		}
		return $options;
	}

	public function contarTodosOsRegistrosAonde($where)
	{
		// TODO: Implement contarTodosOsRegistrosAonde() method.
	}

	public function recuperar($id)
	{
		// TODO: Implement recuperar() method.
	}
}
