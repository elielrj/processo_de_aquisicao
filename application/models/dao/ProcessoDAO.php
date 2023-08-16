<?php

require_once 'abstract_dao/AbstractDAO.php';
require_once 'application/models/bo/Processo.php';

class ProcessoDAO extends AbstractDAO
{
	const TABELA_PROCESSO = 'processo';

	public function __construct()
	{
		parent::__construct();
	}

	public function criar($array)
	{
		$this->db->insert(
			self::TABELA_PROCESSO,
			$array
		);
	}

	public function atualizar($array, $where)
	{
		$this->db->update(
			self::TABELA_PROCESSO,
			$array,
			$where
		);
	}

	public function buscarPorId($id)
	{
		$array = $this->db->get_where(
			self::TABELA_PROCESSO,
			[ID => $id]
		);

		$this->load->model('dao/LeiDAO');
		$lei = $this->LeiDAO->buscarPorId($array->result('lei_id'));

		$this->load->model('dao/DepartamentoDAO');
		$departamento = $this->DepartamentoDAO->buscarPorId($array->result('departamento_id'));

		$array_lei_tipo_artefato =
			$this->db
				->order_by('ordem', DIRECTIONS_ASC)
				->where([
					STATUS => true,
					'lei_id' => $array->result('lei_id'),
					'tipo_id' => $array->result('tipo_id')
				])
				->get('lei_tipo_artefato');

		$listaDeArtefatos = [];

		foreach ($array_lei_tipo_artefato->result() as $linha) {
			$this->load->model('dao/ArtefatoDAO');
			$listaDeArtefatos[] = $this->ArtefatoDAO->buscarPorId($linha->artefato_id);
		}

		$this->load->model('dao/TipoDAO');
		$tipo = $this->TipoDAO->buscarPorId($array->result('tipo_id'));

		$this->load->model('dao/AndamentoDAO');
		$listaDeAndamento = $this->AndamentoDAO->buscarAonde(['processo_id'=>$array->result('id')]);

		return
			new Processo(
				$array->result('id') ?? null,
				$array->result('status') ?? null,
				$array->result('objeto') ?? null,
				$array->result('numero') ?? null,
				$array->result('data_hora') ?? null,
				$array->result('chave') ?? null,
				$array->result('completo') ?? null,
				$lei ?? null,
				$departamento ?? null,
				$listaDeArtefatos?? null,
				$tipo ?? null,
				$listaDeAndamento ?? null
			);
	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		return
			$this->db
				->order_by(DATA_HORA, DIRECTIONS_DESC)
				->where([STATUS => true])
				->get(self::TABELA_PROCESSO, $inicio, $fim);
	}

	public function buscarTodosInativos($inicio, $fim)
	{
		return
			$this->db
				->order_by(DATA_HORA, DIRECTIONS_DESC)
				->where([STATUS => false])
				->get(self::TABELA_PROCESSO, $inicio, $fim);
	}


	public function buscarTodosStatus($inicio, $fim)
	{
		return
			$this->db
				->order_by(ID, DIRECTIONS_ASC)
				->get(self::TABELA_PROCESSO, $inicio, $fim);
	}

	public function buscarAonde($whare)
	{
		return
			$this->db
				->where($whare)
				->get(self::TABELA_PROCESSOCESSO);
	}

	public function excluirDeFormaPermanente($id)
	{
		$this->db->delete(
			self::TABELA_PROCESSO,
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
			->count_all_results(self::TABELA_PROCESSOCESSO);
	}

	public function contarRegistrosInativos()
	{
		return $this->db
			->where([STATUS => false])
			->count_all_results(self::TABELA_PROCESSOCESSO);
	}

	public function contarTodosOsRegistros()
	{
		return $this->db
			->count_all_results(self::TABELA_PROCESSOCESSO);
	}

	public function options()
	{
		$options = [];

		foreach ($this->buscarTodosAtivos(null, null) as $processo) {
			$options += [$processo->id => $processo->nome];
		}
		return $options;
	}

	public function contarTodosOsRegistrosAonde($where)
	{
		return $this->db
			->where($where)
			->count_all_results(self::TABELA_PROCESSO);
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
				->get(self::TABELA_PROCESSO, $inicio, $fim);
	}
}
