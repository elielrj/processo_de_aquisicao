<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DepartamentoController extends CI_Controller
{
	const DEPARTAMENTO_CONTROLLER = 'DepartamentoController';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dao/DepartamentoDAO');
		$this->load->model('dao/UgDAO');
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

		$departamentos = $this->DepartamentoDAO->buscarTodos($qtd_de_itens_para_exibir,$indice_no_data_base);

		$params = [
			'controller' => 'DepartamentoController/listar',
			'quantidade_de_registros_no_banco_de_dados' => $this->DepartamentoDAO->contar()
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($departamentos) ? '' : $this->criadordebotoes->listar($indice);

		$this->load->library('DepartamentoLibrary');

		$dados = array(
			'titulo' => 'Lista de Departamentos',
			'tabela' => $this->departamentolibrary->listar($departamentos, $indice_no_data_base),
			'pagina' => 'departamento/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);
	}

	public function novo()
	{

		$dados = array(
			'titulo' => 'Nova Seção',
			'pagina' => 'departamento/novo.php',
			'ugs' => $this->UgDAO->options()
		);

		$this->load->view('index', $dados);
	}

	public function criar()
	{
		$data_post = $this->input->post();

		$this->load->model('UgDAO');

		$departamento = new Departamento(
			null,
			$data_post['nome'],
			$data_post['sigla'],
			$this->UgDAO->buscarPorId($data_post['ug']),
			true
		);

		$this->DepartamentoDAO->criar($departamento);

		redirect('DepartamentoController');
	}

	public function alterar($id)
	{

		$departamento = $this->DepartamentoDAO->buscarPorId($id);



		$dados = array(
			'titulo' => 'Alterar Seção',
			'pagina' => 'departamento/alterar.php',
			'departamento' => $departamento,
			'ugs' => $this->UgDAO->options()
		);

		$this->load->view('index', $dados);
	}

	public function atualizar()
	{

		$data_post = $this->input->post();

		$departamento = new Departamento(
			$data_post['id'],
			$data_post['nome'],
			$data_post['sigla'],
			$this->UgDAO->buscarPorId($data_post['ug']),
			$data_post['status']
		);

		$this->DepartamentoDAO->atualizar($departamento);

		redirect('DepartamentoController');
	}

	public function deletar($id)
	{
		$this->DepartamentoDAO->deletar($id);

		redirect('DepartamentoController');
	}

}
