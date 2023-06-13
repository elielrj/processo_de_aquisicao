<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/models/bo/Andamento.php');

class AndamentoController extends CI_Controller
{
	public static $andamentoController = 'AndamentoController';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dao/AndamentoDAO');
		$this->load->library('AndamentoLibrary');
	}

	public function index()
	{
		usuarioPossuiSessaoAberta() ? $this->listar() : redirecionarParaPaginaInicial();
	}

	public function listar($indice = 1): void
	{
		$indice--;

		$mostrar = 10;
		$indiceInicial = $indice * $mostrar;

		$leis = $this->AndamentoDAO->buscarTodosAtivosInativos($indiceInicial, $mostrar);

		$quantidade = $this->AndamentoDAO->contarAtivosInativos();

		$botoes = empty($leis) ? '' : $this->botao->paginar(self::$andamentoController . '/listar', $indice, $quantidade, $mostrar);

		$dados = array(
			'titulo' => 'Lista de andamentos',
			'tabela' => $this->andamentolibrary->listar($leis, $indiceInicial),
			'pagina' => 'andamento/index.php',
			'botoes' => $botoes,
		);
		$this->load->view('index', $dados);
	}

	public function criar()
	{
		$andamento = new Andamento(
			null,
			$this->input->post(AndamentoDAO::$statusDoAndamento),
			$this->input->post(AndamentoDAO::$dataHora),
			$this->input->post(AndamentoDAO::$processo_id)
		);

		$this->AndamentoDAO->criar($andamento);

		redirect(self::$andamentoController);
	}

	public function atualizar()
	{
		$andamento = new Andamento(
			$this->input->post()('id'),
			$this->input->post('status_do_andamento'),
			$this->input->post('data_hora'),
			$this->input->post('processo_id')
		);

		$this->AndamentoDAO->atualizar($andamento);

		redirect(self::$andamentoController);
	}
}
