<?php

require_once 'abstract_dao/AbstractDAO.php';
require_once 'application/models/bo/Lei.php';

class LeiDAO extends AbstractDAO
{
	const TABELA_LEI = 'lei';

	public function __construct()
	{
		parent::__construct();
	}

	public function criar($array)
	{
		$this->db->insert(
			self::TABELA_LEI,
			$array
		);
	}

	public function atualizar($array, $where)
	{
		$this->db->update(
			self::TABELA_LEI,
			$array,
			$where
		);
	}

	public function buscarPorId($id)
	{
		$array = $this->db->get_where(
			self::TABELA_LEI,
			[ID => $id]
		);

		$this->load->model('dao/ModalidadeDAO');
		$modalidade = $this->ModalidadeDAO->buscarPorId($array->result('modalidade_id'));

		$this->load->library('data',$array->result('data'));

		return
			new Lei(
				$array->result('id') ?? null,
					$array->result('status') ?? null,
					$array->result('numero') ?? null,
					$array->result('artigo') ?? null,
					$array->result('inicio') ?? null,
					$this->data ?? null,
					$modalidade ?? null,
			);
	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		return
			$this->db
				->order_by(DATA_HORA, DIRECTIONS_DESC)
				->where([STATUS => true])
				->get(self::TABELA_LEI, $inicio, $fim);
	}

	public function buscarTodosInativos($inicio, $fim)
	{
		return
			$this->db
				->order_by(DATA_HORA, DIRECTIONS_DESC)
				->where([STATUS => false])
				->get(self::TABELA_LEI, $inicio, $fim);
	}


	public function buscarTodosStatus($inicio, $fim)
	{
		return
			$this->db
				->order_by(ID, DIRECTIONS_ASC)
				->get(self::TABELA_LEI, $inicio, $fim);
	}

	public function buscarAonde($whare)
	{
		return
			$this->db
				->where($whare)
				->get(self::TABELA_LEI);
	}

	public function excluirDeFormaPermanente($id)
	{
		$this->db->delete(
			self::TABELA_LEI,
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
			->count_all_results(self::TABELA_LEI);
	}

	public function contarRegistrosInativos()
	{
		return $this->db
			->where([STATUS => false])
			->count_all_results(self::TABELA_LEI);
	}

	public function contarTodosOsRegistros()
	{
		return $this->db
			->count_all_results(self::TABELA_LEI);
	}

	public function options()
	{
		$options = [];

		foreach ($this->buscarTodosAtivos(null, null) as $lei) {
			$options += [$lei->id => $lei->nome];
		}
		return $options;
	}

	public function contarTodosOsRegistrosAonde($where)
	{
		return $this->db
			->where($where)
			->count_all_results(self::TABELA_LEI);
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
				->get(self::TABELA_LEI, $inicio, $fim);
	}
}
