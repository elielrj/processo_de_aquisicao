<?php

defined('BASEPATH') or exit('No direct script access allowed');

use helper\Tempo;

include_once 'application/models/helper/Tempo.php';
require_once('application/models/bo/Andamento.php');

class AndamentoController extends CI_Controller
{
	const ANDAMENTO_CONTROLLER = 'AndamentoController';
	public function __construct()
	{
		parent::__construct();
		$this->load->model(AndamentoDAO::ANDAMENTO_DAO);
		$this->load->library(AndamentoLibrary::ANDAMENTO_LIBRARY);
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

		$andamento = $this->AndamentoDAO->buscarTodosAtivosInativos($qtd_de_itens_para_exibir, $indice_no_data_base);

		$params = [
			'controller' => 'AndamentoController/listar',
			'quantidade_de_registros_no_banco_de_dados' => $this->AndamentoDAO->contarAtivosInativos()
		];

		$this->load->library('CriadorDeBotoes', $params);


		$botoes = empty($andamento) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de andamentos',
			'tabela' => $this->andamentolibrary->listar($andamento, $indice_no_data_base),
			'pagina' => 'andamento/index.php',
			'botoes' => $botoes,
		);
		$this->load->view('index', $dados);
	}

	public function criar()
	{
		$andamento = new Andamento(
			null,
			$this->input->post('status'),
			$this->input->post('data_hora'),
			$this->input->post('processo_id'),
			$_SESSION['id'],
			true//todo
		);

		$this->AndamentoDAO->criar($andamento);

		redirect(self::$andamentoController);
	}

	public function atualizar()
	{
		$andamento = new Andamento(
			$this->input->post('id'),
			$this->input->post('status'),
			new Tempo($this->input->post('data_hora')),
			$this->input->post('processo_id'),
			$_SESSION['id'],
			true//todo
		);

		$this->AndamentoDAO->atualizar($andamento);

		redirect(self::$andamentoController);
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
