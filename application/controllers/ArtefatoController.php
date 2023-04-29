<?php
defined('BASEPATH') or exit('No direct script access allowed');

include('application/models/bo/Artefato.php');

class ArtefatoController extends CI_Controller
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

		$artefatos = $this->ArtefatoDAO->retrive($indiceInicial, $mostrar);

		$quantidade = $this->ArtefatoDAO->count_rows();

		$botoes = empty($artefatos) ? '' : $this->botao->paginar('ArtefatoController/listar', $indice, $quantidade, $mostrar);

		$dados = array(
			'titulo' => 'Lista de Artefatos',
			'tabela' => $this->tabela->artefato($artefatos, $indiceInicial),
			'pagina' => 'artefato/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);
	}

	public function novo()
	{
		$this->load->view('index', [
			'titulo' => 'Novo Artefato',
			'pagina' => 'artefato/novo.php'
		]);
	}

	public function criar()
	{
		$data = $this->input->post();

		$this->ArtefatoDAO->create(Artefato::toArray($data));

		redirect('ArtefatoController');
	}

	public function alterar($id)
	{
		$this->load->view('index', [
			'titulo' => 'Alterar Artefato',
			'pagina' => 'artefato/alterar.php',
			'artefato' => $this->ArtefatoDAO->retriveId($id)
		]);

	}

	public function atualizar()
	{
		$this->ArtefatoDAO->update(
			Artefato::fromArray(
				$this->input->post()
			)
		);

		redirect('ArtefatoController');
	}

	public function deletar($id)
	{
		$this->ArtefatoDAO->delete($id);

		redirect('ArtefatoController');
	}
}