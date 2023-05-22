<?php
defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Tipo.php');

class TipoController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('TipoLibrary');
		$this->load->model('dao/tipoDAO');
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

		$tipo = $this->tipoDAO->buscarTodos($indiceInicial, $mostrar);

		$quantidade = $this->tipoDAO->contar();

		$botoes = empty($tipo) ? '' : $this->botao->paginar('TipoController/listar', $indice, $quantidade, $mostrar);

		$dados = array(
			'titulo' => 'Lista de Tipos De Licitacões',
			'tabela' => $this->tipolibrary->listar($tipo, $indiceInicial),
			'pagina' => 'tipo/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);
	}

	public function novo()
	{

		$dados = array(
			'titulo' => 'Novo Tipo de Licitação',
			'pagina' => 'tipo/novo.php',
		);

		$this->load->view('index', $dados);
	}

	public function criar()
	{
		$data_post = $this->input->post();

		$tipo = new Tipo(
			null,
			$data_post['nome'],
			$data_post['status']
		);

		$this->tipoDAO->create($tipo);

		redirect('TipoController');
	}

	public function alterar($id)
	{

		$tipo = $this->tipoDAO->buscarPorId($id);

		$dados = array(
			'titulo' => 'Alterar Tipo de Licitação',
			'pagina' => 'tipo/alterar.php',
			'tipo' => $tipo,
		);

		$this->load->view('index', $dados);

	}

	public function atualizar()
	{

		$data_post = $this->input->post();

		$tipo = new Tipo(
			$data_post['id'],
			$data_post['nome'],
			$data_post['status']
		);

		$this->tipoDAO->update($tipo);

		redirect('TipoController');
	}

	public function deletar($id)
	{
		$tipoDeLicitcao = $this->tipoDAO->buscarPorId($id);

		$this->tipoDAO->deletar($tipoDeLicitcao);

		redirect('TipoController');
	}
}