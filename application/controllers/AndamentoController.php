<?php

defined('BASEPATH') or exit('No direct script access allowed');

use helper\Tempo;

include_once 'application/models/helper/Tempo.php';
require_once('application/models/bo/Andamento.php');
include_once 'application/models/dao/AndamentoDAO.php';

class AndamentoController extends CI_Controller
{
	const ANDAMENTO_CONTROLLER = 'AndamentoController';

	public function __construct()
	{
		parent::__construct();
		$this->load->model(AndamentoDAO::ANDAMENTO_DAO);
	}

	public function index()
	{
		usuarioPossuiSessaoAberta() ? $this->listar() : redirecionarParaPaginaInicial();
	}

	public function listar($indice = 1)
	{
		$indice--;
		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		$andamentos = $this->AndamentoDAO->buscarTodosStatus($qtd_de_itens_para_exibir, $indice_no_data_base);

		$this->load->library(
			'CriadorDeBotoes',
			[
				'controller' => self::ANDAMENTO_CONTROLLER . '/listar',
				'quantidade_de_registros_no_banco_de_dados' => $this->AndamentoDAO->contarTodosOsRegistros()
			]);

		$this->load->view(
			'index',
			[
				'titulo' => 'Lista de andamentos',
				'tabela' => $andamentos,
				'pagina' => 'andamento/index.php',
				'botoes' => empty($andamentos) ? '' : $this->criadordebotoes->listar($indice),
			]);
	}

	public function criar()
	{
		$andamento = new Andamento(
			null,
			$this->input->post(AndamentoDAO::STATUS_DO_ANDAMENTO),
			$this->input->post(AndamentoDAO::DATA_HORA),
			$this->input->post(AndamentoDAO::PROCESSO_ID),
			$_SESSION['id'],
			true//todo
		);

		$this->AndamentoDAO->criar($andamento);

		redirect(ANDAMENTO_CONTROLLER);
	}

	public function atualizar()
	{
		$andamento = new Andamento(
			$this->input->post(AndamentoDAO::ID),
			$this->input->post(AndamentoDAO::STATUS_DO_ANDAMENTO),
			new Tempo($this->input->post(AndamentoDAO::DATA_HORA)),
			$this->input->post(AndamentoDAO::PROCESSO_ID),
			$_SESSION['id'],
			true//todo
		);

		$this->AndamentoDAO->atualizar($andamento);

		redirect(ANDAMENTO_CONTROLLER);
	}

	public function listarPorProcesso($proceso_id)
	{
		$andamentos = $this->AndamentoDAO->buscarTodosAtivosInativosDeUmProcesso($proceso_id);
		$this->load->library('AndamentoLibrary');

		$dados = array(
			'titulo' => 'Lista de andamento do processo',
			'tabela' => $this->andamentolibrary->listar($andamentos, 0),
			'pagina' => 'andamento/index.php',
			'botoes' => '',
		);

		$this->load->view('index', $dados);
	}
}
