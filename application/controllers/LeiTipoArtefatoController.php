<?php

defined('BASEPATH') or exit('No direct script access allowed');


class LeiTipoArtefatoController extends CI_Controller
{

	public static $leiTipoArtefatoController = 'LeiTipoArtefatoController';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dao/LeiTipoArtefatoDAO');
		$this->load->model('dao/LeiDAO');
		$this->load->model('dao/TipoDAO');
		$this->load->model('dao/ArtefatoDAO');
		$this->load->library('LeiTipoArtefatoLibrary');
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

		$leisTiposArtefatos = $this->LeiTipoArtefatoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base);

		$params = [
			'controller' => 'LeiTipoArtefatoController/listar',
			'quantidade_de_registros_no_banco_de_dados' => $this->LeiTipoArtefatoDAO->contar()
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($leisTiposArtefatos) ? '' : $this->criadordebotoes->listar($indice);


		$dados = array(
			'titulo' => 'Lista de Leis/Tipos/Artefatos',
			'tabela' => $this->leitipoartefatolibrary->listar($leisTiposArtefatos, $indice_no_data_base),
			'pagina' => 'lei_tipo_artefato/index.php',
			'botoes' => $botoes,
		);
		$this->load->view('index', $dados);
	}

	public function atualizar()
	{

		$data_post = $this->input->post();

		$whare = array(
			$data_post['id'],
			$data_post['lei_id'],
			$data_post['tipo_id'],
			$data_post['artefato_id'],
			$data_post['status']
		);

		$this->LeiTipoArtefatoDAO->atualizar($whare);

		redirect('LeiTipoArtefatoController');
	}

	public function novo()
	{
		$this->load->view('index', [
			'titulo' => 'Nova LeiTipoArtefato',
			'pagina' => 'lei_tipo_artefato/novo.php',
			'options_lei' => $this->LeiDAO->options(),
			'options_tipo' => $this->TipoDAO->options(),
			'options_artefato' => $this->ArtefatoDAO->options(),
		]);

	}

	public function alterar($id)
	{

		$leiTipoArtefato = $this->LeiTipoArtefatoDAO->buscarPorId($id);

		$this->load->model('dao/LeiDAO');
		$this->load->model('dao/TipoDAO');
		$this->load->model('dao/ArtefatoDAO');

		$dados = [
			'titulo' => 'Alterar lei',
			'pagina' => 'lei_tipo_artefato/alterar.php',
			'leiTipoArtefato' => $leiTipoArtefato,
			'options_lei' => $this->LeiDAO->options(),
			'options_tipo' => $this->TipoDAO->options(),
			'options_artefato' => $this->ArtefatoDAO->options(),
		];

		$this->load->view('index', $dados);
	}
}
