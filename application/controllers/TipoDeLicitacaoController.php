<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TipoDeLicitacaoController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (!isset($this->session->email)) {

			$this->load->view('login.php');

		} else {
			$this->listar();
		}
	}


	public function listar($indice = 1)
	{
		$indice--;

		$mostrar = 10;
		$indiceInicial = $indice * $mostrar;

		$tiposDeLicitacoes = $this->TipoDeLicitacaoDAO->retrive($indiceInicial, $mostrar);

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
		$data = $this->input->post();
		
		$tipoDeLicitacao = new TipoDeLicitacao(
			null,
			$data['nome'],
			$data['lei'],
			$data['artigo'],
			$data['inciso'],
			$data['dataDaLei'],
			$data['pagina'],
			$data['status']		
		);

		$this->TipoDeLicitacaoDAO->create($tipoDeLicitacao);

		redirect('TipoDeLicitacaoController');
	}

	public function alterar($id)
	{

		$tipoDeLicitacao = $this->TipoDeLicitacaoDAO->retriveId($id);

		$dados = array(
			'titulo' => 'Alterar Tipo de Licitação',
			'pagina' => 'tipoDeLicitacao/alterar.php',
			'tipoDeLicitacao' => $tipoDeLicitacao,
		);

		$this->load->view('index', $dados);

	}

	public function atualizar()
	{

		$data = $this->input->post();
		
		$tipoDeLicitacao = new TipoDeLicitacao(
			$data['id'],
			$data['nome'],
			$data['lei'],
			$data['artigo'],
			$data['inciso'],
			$data['dataDaLei'],
			$data['pagina'],
			$data['status']	
		);

		$this->TipoDeLicitacaoDAO->update($tipoDeLicitacao);

		redirect('TipoDeLicitacaoController');
	}

	public function deletar($id)
	{
		$this->TipoDeLicitacaoDAO->delete($id);

		redirect('TipoDeLicitacaoController');
	}
}