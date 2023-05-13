<?php
defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Tipo.php');

class TipoDeLicitacaoController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		
		$this->load->model('dao/TipoDeLicitacaoDAO');
	}

	public function index()
	{
		if (!isset($this->session->email)) {

			header("Location:" . base_url());

		} else {
			$this->listar();
		}
	}


	public function listar($indice = 1)
	{
		$indice--;

		$mostrar = 10;
		$indiceInicial = $indice * $mostrar;

		$tiposDeLicitacoes = $this->TipoDeLicitacaoDAO->buscarTodos($indiceInicial, $mostrar);

		$quantidade = $this->TipoDeLicitacaoDAO->count_rows();

		$botoes = empty($tiposDeLicitacoes) ? '' : $this->botao->paginar('TipoDeLicitacaoController/listar', $indice, $quantidade, $mostrar);

		$dados = array(
			'titulo' => 'Lista de Tipos De Licitacões',
			'tabela' => $this->tabela->tipoDeLicitacao($tiposDeLicitacoes, $indiceInicial),
			'pagina' => 'tipoDeLicitacao/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);
	}

	public function novo()
	{

		$dados = array(
			'titulo' => 'Novo Tipo de Licitação',
			'pagina' => 'tipoDeLicitacao/novo.php',
		);

		$this->load->view('index', $dados);
	}

	public function criar()
	{
		$data_post = $this->input->post();
		
		$tipoDeLicitacao = new TipoDeLicitacao(
			null,
			$data_post['nome'],
			$data_post['lei'],
			$data_post['artigo'],
			$data_post['inciso'],
			$this->data->dataMySQL($data_post['dataDaLei']),
			$data_post['pagina'],
			$data_post['status']		
		);

		$this->TipoDeLicitacaoDAO->create($tipoDeLicitacao);

		redirect('TipoDeLicitacaoController');
	}

	public function alterar($id)
	{

		$tipoDeLicitacao = $this->TipoDeLicitacaoDAO->buscarPorId($id);

		$dados = array(
			'titulo' => 'Alterar Tipo de Licitação',
			'pagina' => 'tipoDeLicitacao/alterar.php',
			'tipoDeLicitacao' => $tipoDeLicitacao,
		);

		$this->load->view('index', $dados);

	}

	public function atualizar()
	{

		$data_post = $this->input->post();
		
		$tipoDeLicitacao = new TipoDeLicitacao(
			$data_post['id'],
			$data_post['nome'],
			$data_post['lei'],
			$data_post['artigo'],
			$data_post['inciso'],
			$this->data->dataMySQL($data_post['dataDaLei']),
			$data_post['pagina'],
			$data_post['status']	
		);

		$this->TipoDeLicitacaoDAO->update($tipoDeLicitacao);

		redirect('TipoDeLicitacaoController');
	}

	public function deletar($id)
	{
		$tipoDeLicitcao = $this->TipoDeLicitacaoDAO->buscarPorId($id);

		$this->TipoDeLicitacaoDAO->deletar($tipoDeLicitcao);

		redirect('TipoDeLicitacaoController');
	}
}