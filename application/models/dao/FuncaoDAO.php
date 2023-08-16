<?php

require_once 'abstract_dao/AbstractDAO.php';
require_once 'application/models/bo/funcao/Funcao.php';

class FuncaoDAO extends AbstractDAO
{
	const TABELA_FUNCAO = 'funcao';

	public function __construct()
	{
		parent::__construct();
	}

	public function criar($array)
	{
		$this->db->insert(
			self::TABELA_FUNCAO,
			$array
		);
	}

	public function atualizar($array, $where)
	{
		$this->db->update(
			self::TABELA_FUNCAO,
			$array,
			$where
		);
	}

	public function buscarPorId($id)
	{
		$array = $this->db->get_where(
			self::TABELA_FUNCAO,
			[ID => $id]
		);

		return
			new Funcao(
				$array->result('id') ?? null,
				$array->result('status') ?? null,
				$array->result('descricao') ?? null,
				$array->result('nivel_de_acesso') ?? null
			);
	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		return
			$this->db
				->order_by(DATA_HORA, DIRECTIONS_DESC)
				->where([STATUS => true])
				->get(self::TABELA_FUNCAO, $inicio, $fim);
	}

	public function buscarTodosInativos($inicio, $fim)
	{
		return
			$this->db
				->order_by(DATA_HORA, DIRECTIONS_DESC)
				->where([STATUS => false])
				->get(self::TABELA_FUNCAO, $inicio, $fim);
	}


	public function buscarTodosStatus($inicio, $fim)
	{
		return
			$this->db
				->order_by(ID, DIRECTIONS_ASC)
				->get(self::TABELA_FUNCAO, $inicio, $fim);
	}

	public function buscarAonde($whare)
	{
		return
			$this->db
				->where($whare)
				->get(TABELA_FUNCAO);
	}

	public function excluirDeFormaPermanente($id)
	{
		$this->db->delete(
			self::TABELA_FUNCAO,
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

		foreach ($this->buscarTodosAtivos(null, null) as $funcao) {
			$options += [$funcao->id => $funcao->nome];
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

	public function buscarAondeComInicioEFim($where, $inicio, $fim)
	{
		return
			$this->db
				->where($where)
				->get(self::TABELA_FUNCAO, $inicio, $fim);
	}
}
