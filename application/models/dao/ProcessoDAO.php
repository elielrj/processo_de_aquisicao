<?php

require_once 'AbstractDAO.php';
class ProcessoDAO  extends AbstractDAO
{
	const TABELA_PROCESSO = 'processo';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dao/DAO');
		$this->load->model('dao/DepartamentoDAO');
		$this->load->model('dao/LeiDAO');
		$this->load->model('dao/TipoDAO');
		$this->load->model('dao/LeiTipoArtefatoDAO');
		$this->load->model('dao/ArquivoDAO');
		$this->load->model('dao/AndamentoDAO');
	}

	public function criar($processo)
	{
		$this->DAO->criar(ProcessoDAO::TABELA_PROCESSO, $processo->array());

		$processo = $this->buscarOnde('chave', $processo->chave);

		$this->load->library('DataHora');

		$andamento = new Andamento(
			null,
			new Criado(),
			$this->datahora->formatoDoMySQL(),
			$processo->id,
			$_SESSION[SESSION_ID],
			true
		);

		$this->AndamentoDAO->criar($andamento);

		return $processo->id;
	}

	public function buscarTodos($inicial, $final, $where = [])
	{
		$array = $this->DAO->buscarTodosOrderByData(ProcessoDAO::TABELA_PROCESSO, $inicial, $final, $where);

		return $this->criarLista($array);
	}


	public function buscarTodosDesativados($inicial, $final)
	{
		$array = $this->DAO->buscarTodosDesativados(ProcessoDAO::TABELA_PROCESSO, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($processoId)
	{
		$array = $this->DAO->buscarPorId(ProcessoDAO::TABELA_PROCESSO, $processoId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(ProcessoDAO::TABELA_PROCESSO, array($key => $value));

		return $this->toObject($array->result()[0]);
	}

	public function atualizar($processo)
	{
		$this->DAO->atualizar(ProcessoDAO::TABELA_PROCESSO, $processo->array());
	}

	public function deletar($processo_id)
	{
		$processo = $this->buscarPorId($processo_id);

		$processo->status = false;

		$this->DAO->atualizar(ProcessoDAO::TABELA_PROCESSO, $processo->array());
	}

	public function recuperar($processo_id)
	{
		$processo = $this->buscarPorId($processo_id);

		$processo->status = true;

		$this->DAO->atualizar(ProcessoDAO::TABELA_PROCESSO, $processo->array());
	}

	public function contar($where = [])
	{
		return $this->DAO->contar(ProcessoDAO::TABELA_PROCESSO, $where);
	}

	public function contarProcessosPorSetorDemandante($departamento_id = null)
	{
		$departamento_id = $departamento_id ?? $_SESSION['departamento_id'];

		$where = ['departamento_id' => $departamento_id,'status'=>true];

		return $this->DAO->contar(ProcessoDAO::TABELA_PROCESSO, $where);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(TABELA_PROCESSO);
	}



	private function criarLista($array)
	{
		$listaDeProcesso = array();

		foreach ($array->result() as $linha) {

			$processo = $this->toObject($linha);

			$listaDeProcesso[] = $processo;
		}

		return $listaDeProcesso;
	}

	public function options()
	{

		$processos = $this->buscarTodos(null, null);

		$options = [];

		if (isset($processos)) {

			foreach ($processos as $key => $value) {

				$options += [$value->id => 'Nup/Nud: ' . $value->numero . ' - Objeto: ' . $value->objeto];
			}
		}
		return $options;
	}

	public function buscarProcessoPeloNumeroChave($numero, $chave)
	{
		$array = $this->DAO->buscarOnde(ProcessoDAO::TABELA_PROCESSO, array('numero' => $numero, 'chave' => $chave));

		if (isset($array)) {
			return $this->toObject($array->result()[0]);
		} else {
			return null;
		}
	}

	/**
	 * Consultar processo
	 *
	 */
	public function buscarPorNumeroChave($numero, $chave)
	{
		return $this->ProcessoDAO->buscarProcessoPeloNumeroChave($numero, $chave);
	}

	public function numeroExiste($numero)
	{
		$array = $this->DAO->buscarOnde(self::$TABELA_DB, array('numero' => $numero));

		return ($array->num_rows() == 1);
	}

	public function chaveEstaCorreta($chave)
	{
		$array = $this->DAO->buscarOnde(self::$TABELA_DB, array('chave' => $chave));

		return ($array->num_rows() == 1);
	}


}
