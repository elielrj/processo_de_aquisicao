<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DepartamentoController extends CI_Controller
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

		$departamentos = $this->DepartamentoDAO->retrive($indiceInicial, $mostrar);

		$quantidade = $this->DepartamentoDAO->count_rows();

		$botoes = empty($departamentos) ? '' : $this->botao->paginar('DepartamentoController/listar', $indice, $quantidade, $mostrar);

		$dados = array(
			'titulo' => 'Lista de Departamentos',
			'tabela' => $this->tabela->departamento($departamentos, $indiceInicial),
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
		);

		$this->load->view('index', $dados);
	}

	public function criar()
	{
		$data = $this->input->post();
		
		$departamento = new Departamento(
			null,
			$data['nome'],
			$data['sigla'],
			$data['status']		
		);

		$this->DepartamentoDAO->create($departamento);

		redirect('DepartamentoController');
	}

	public function alterar($id)
	{

		$departamento = $this->DepartamentoDAO->retriveId($id);

		$dados = array(
			'titulo' => 'Alterar Seção',
			'pagina' => 'departamento/alterar.php',
			'departamento' => $departamento,
		);

		$this->load->view('index', $dados);

	}

	public function atualizar()
	{

		$data = $this->input->post();
		
		$departamento = new Departamento(
			$data['id'],
			$data['nome'],
			$data['sigla'],
			$data['status']
		);

		$this->DepartamentoDAO->update($departamento);

		redirect('DepartamentoController');
	}

	public function deletar($id)
	{
		$this->DepartamentoDAO->delete($id);

		redirect('DepartamentoController');
	}
}