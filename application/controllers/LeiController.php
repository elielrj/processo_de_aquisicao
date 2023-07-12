<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/models/bo/Lei.php');

class LeiController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dao/LeiDAO');
		$this->load->model('dao/TipoDAO');
		$this->load->model('dao/ArtefatoDAO');
		$this->load->library('LeiLibrary');
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

		$leis = $this->LeiDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base);

		$params = [
			'controller' => 'LeiController/listar',
			'quantidade_de_registros_no_banco_de_dados' => $this->LeiDAO->contar()
		];


		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($leis) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de leis',
			'tabela' => $this->leilibrary->listar($leis, $indice_no_data_base),
			'pagina' => 'lei/index.php',
			'botoes' => $botoes,
		);
		$this->load->view('index', $dados);
	}

	public function novo()
	{
		$this->load->view('index', [
			'titulo' => 'Nova lei',
			'pagina' => 'lei/novo.php',
			'options_lei' => $this->LeiDAO->options(),
			'options_tipo' => $this->TipoDAO->options(),
			'options_artefato' => $this->ArtefatoDAO->options()
		]);
	}

	public function criar()
	{

		$data_post = $this->input->post();

		$lei = new lei(
			null,
			$data_post['numero'],
			$data_post['artigo'],
			$data_post['inciso'],
			$this->data->dataHoraBr($data_post['data']),
			$data_post['modalidade_id'],
			$data_post['status']
		);

		$this->LeiDAO->create($lei);

		redirect('leiController');
	}

	public function alterar($id)
	{

		$lei = $this->LeiDAO->buscarPorId($id);

		$dados = [
			'titulo' => 'Alterar lei',
			'pagina' => 'lei/alterar.php',
			'lei' => $lei
		];

		$this->load->view('index', $dados);
	}

	public function atualizar()
	{

		$data_post = $this->input->post();

		$lei = new lei(
			$data_post['id'],
			$data_post['numero'],
			$data_post['artigo'],
			$data_post['inciso'],
			$this->data->dataHoraBr($data_post['data']),
			$data_post['modalidade_id'],
			$data_post['status']
		);

		$this->LeiDAO->update($lei);

		redirect('leiController');
	}

	public function deletar($id)
	{

		$this->LeiDAO->update($id);

		redirect('leiController');
	}

	public function optionsPorModalidadeId()
	{

		$data_post = $this->input->post();

		$modalidade_id = $data_post['modalidade_id'];

		$listaDeLeis = $this->LeiDAO->options($modalidade_id);

		$options = "<option>Selecione uma Lei</option>";

		foreach ($listaDeLeis as $key => $value) {
			$options .= "<option value='{$key}'>{$value}</option>";
		}

		echo $options;
	}

}
