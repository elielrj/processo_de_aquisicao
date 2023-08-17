<?php

require_once 'abstract_dao/AbstractDAO.php';

class SugestaoDAO extends AbstractDAO
{
	const TABELA_SUGESTAO = 'sugestao';

	public function __construct()
	{
		parent::__construct();
	}

	public function criar($array)
	{
		$this->db->insert(
			self::TABELA_SUGESTAO,
			$array
		);
	}

	public function atualizar($array, $where)
	{
		$this->db->update(
			self::TABELA_SUGESTAO,
			$array,
			$where
		);
	}

	public function buscarPorId($id)
	{
		$array = $this->db->get_where(
			self::TABELA_SUGESTAO,
			[ID => $id]
		);

		$this->load->model('dao/SugestaoDAO');
		$usuario = $this->SugestaoDAO->buscarPorId($array->result('usuario_id'));

		return
			new Sugestao(
				$array->result('id') ?? null,
				$array->result('status') ?? null,
				$array->result('mensagem') ?? null,
				$usuario ?? null,
			);
	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		return
			$this->db
				->order_by(DATA_HORA, DIRECTIONS_DESC)
				->where([STATUS => true])
				->get(self::TABELA_SUGESTAO, $inicio, $fim);
	}

	public function buscarTodosInativos($inicio, $fim)
	{
		return
			$this->db
				->order_by(DATA_HORA, DIRECTIONS_DESC)
				->where([STATUS => false])
				->get(self::TABELA_SUGESTAO, $inicio, $fim);
	}


	public function buscarTodosStatus($inicio, $fim)
	{
		return
			$this->db
				->order_by(ID, DIRECTIONS_ASC)
				->get(self::TABELA_SUGESTAO, $inicio, $fim);
	}

	public function buscarAonde($whare)
	{
		return
			$this->db
				->where($whare)
				->get(self::TABELA_SUGESTAO);
	}

	public function excluirDeFormaPermanente($id)
	{
		$this->db->delete(
			self::TABELA_SUGESTAO,
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
			->count_all_results(self::TABELA_SUGESTAO);
	}

	public function contarRegistrosInativos()
	{
		return $this->db
			->where([STATUS => false])
			->count_all_results(self::TABELA_SUGESTAO);
	}

	public function contarTodosOsRegistros()
	{
		return $this->db
			->count_all_results(self::TABELA_SUGESTAO);
	}

	public function options()
	{
		$options = [];

		foreach ($this->buscarTodosAtivos(null, null) as $sugestao) {
			$options += [$sugestao->id => $sugestao->nome];
		}
		return $options;
	}

	public function contarTodosOsRegistrosAonde($where)
	{
		return $this->db
			->where($where)
			->count_all_results(self::TABELA_SUGESTAO);
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
				->get(self::TABELA_SUGESTAO, $inicio, $fim);
	}
}
