<?php
defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Sugestao.php');

class SugestaoController extends CI_Controller
{
	const SUGESTAO_CONTROLLER = 'SugestaoController';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dao/SugestaoDAO');
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

		$sugestao = $this->SugestaoDAO->buscarTodos($qtd_de_itens_para_exibir,$indice_no_data_base);

		$params = [
			'controller' => 'SugestaoController/listar',
			'quantidade_de_registros_no_banco_de_dados' => $this->SugestaoDAO->contar()
		];


		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($sugestao) ? '' : $this->criadordebotoes->listar($indice);
		
		$this->load->library('SugestaoLibrary');

		$dados = array(
			'titulo' => 'Lista de Sugestões',
			'tabela' => $this->sugestaolibrary->listar($sugestao, $indice_no_data_base),
			'pagina' => 'sugestao/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);
	}

	public function novo()
	{
		$dados = array(
			'titulo' => 'Sugestão para o sistema',
			'pagina' => 'sugestao/novo.php',
		);

		$this->load->view('index', $dados);
	}

	public function criar()
	{
		$data_post = $this->input->post();

		$sugestao = new Sugestao(
			null,
			$data_post['mensagem'],
			false,
			$_SESSION['id']
		);

		$this->SugestaoDAO->criar($sugestao);

		redirect('processo-listar');
	}

	public function alterar($id)
	{

		$sugestao = $this->SugestaoDAO->buscarPorId($id);

		$dados = array(
			'titulo' => 'Alterar Tipo de Licitação',
			'pagina' => 'sugestao/alterar.php',
			'sugestao' => $sugestao,
		);

		$this->load->view('index', $dados);

	}

	public function atualizar()
	{

		$data_post = $this->input->post();

		$sugestao = new Sugestao(
			$data_post['id'],
			$data_post['mensagem'],
			$data_post['status'],
			$data_post['usuario_id']
		);

		$this->SugestaoDAO->update($sugestao);

		redirect(SugestaoController::$controller);
	}

	public function deletar($id)
	{
		$sugestaoDeLicitcao = $this->SugestaoDAO->buscarPorId($id);

		$this->SugestaoDAO->deletar($sugestaoDeLicitcao);

		redirect(SugestaoController::$controller);
	}
}
