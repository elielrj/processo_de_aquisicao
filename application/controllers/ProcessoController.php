<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use Dompdf\Dompdf;

require_once('vendor/PDFMerger/PDFMerger.php');

use PDFMerger\PDFMerger;

class ProcessoController extends CI_Controller
{
	public static $controller = 'ProcessoController';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dao/ProcessoDAO');
		$this->load->model('dao/DepartamentoDAO');
		$this->load->model('dao/ModalidadeDAO');
		$this->load->model('dao/TipoDAO');
		$this->load->model('dao/LeiDAO');
		$this->load->model('dao/UsuarioDAO');
		$this->load->model('dao/AndamentoDAO');
		$this->load->library('ProcessoLibrary');
		$this->load->library('session');
		$this->load->library('DataLibrary');
	}

	public function index()
	{
		usuarioPossuiSessaoAberta() ? $this->listar() : redirecionarParaPaginaInicial();
	}


	function listar($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base);

		$params = [
			'controller' => 'ProcessoController/listar',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contar()
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos',
			'tabela' => $this->processolibrary->listar($processos, $indice_no_data_base),
			'pagina' => 'processo/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);

	}

	function listarTodosProcessosIncompleto($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		$where = array('completo' => false);

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $where);

		$params = [
			'controller' => 'ProcessoController/listarTodosProcessosIncompleto',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contar($where)
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos',
			'tabela' => $this->processolibrary->listar($processos, $indice_no_data_base),
			'pagina' => 'processo/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);

	}

	function listarTodosProcessosCompleto($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		$where = array('completo' => true);

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $where);

		$params = [
			'controller' => 'ProcessoController/listarTodosProcessosCompleto',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contar($where)
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos',
			'tabela' => $this->processolibrary->listar($processos, $indice_no_data_base),
			'pagina' => 'processo/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);

	}

	function listarPorSetorDemandante($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		$where = array('departamento_id' => $_SESSION['departamento_id']);

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $where);

		$params = [
			'controller' => 'ProcessoController/listarPorSetorDemandante',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contarProcessosPorSetorDemandante()
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos',
			'tabela' => $this->processolibrary->listar($processos, $indice_no_data_base),
			'pagina' => 'processo/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);

	}

	public function exibir($id)
	{
		$processo = $this->ProcessoDAO->buscarPorId($id);

		$this->load->library('ProcessoExibirLibrary');

		$this->load->view('index', [
			'titulo' => 'Processo: ' . $processo->tipo->nome,
			'tabela' => $this->processoexibirlibrary->listar($processo),
			'pagina' => 'processo/exibir.php',
		]);
	}

	public function enviarProcesso($processo_id)
	{
		$this->AndamentoDAO->processoEnviado($processo_id);

		redirect('ProcessoController/exibir/' . $processo_id);
	}

	public function aprovarProcessoFiscAdm($processo_id)
	{
		$this->AndamentoDAO->processoAprovadoFiscAdm($processo_id);

		redirect('ProcessoController/exibir/' . $processo_id);
	}


	public function aprovarProcessoOd($processo_id)
	{
		$this->AndamentoDAO->processoAprovadoOd($processo_id);

		redirect('ProcessoController/exibir/' . $processo_id);
	}

	public function executarProcesso($processo_id)
	{
		$this->AndamentoDAO->processoExecutado($processo_id);

		redirect('ProcessoController/exibir/' . $processo_id);
	}

	public function conformarProcesso($processo_id)
	{
		$this->AndamentoDAO->processoConformado($processo_id);

		redirect('ProcessoController/exibir/' . $processo_id);
	}

	public function arquivarProcesso($processo_id)
	{
		$this->AndamentoDAO->processoArquivar($processo_id);

		$processo = $this->ProcessoDAO->buscarPorId($processo_id);

		$processo->completo = true;

		$this->ProcessoDAO->atualizar($processo);

		redirect('ProcessoController/exibir/' . $processo_id);
	}

	public function visualizarProcesso($id)
	{
		$processo = $this->ProcessoDAO->buscarPorId($id);

		$this->load->library('ProcessoVisualizarLibrary');

		$this->load->view('index', [
			'titulo' => 'Processo: ' . $processo->tipo->nome,
			'tabela' => $this->processovisualizarlibrary->visualizar($processo),
			'pagina' => 'processo/visualizar.php',
		]);
	}

	public function imprimirCertidoes($processo_id)
	{
		$this->imprimirProcesso($processo_id, true);
	}

	public function imprimirProcesso($id, $so_certidao = false)
	{
		$processo = $this->ProcessoDAO->buscarPorId($id);
		/*
												  $html = $this->load->view('index/processo/visualizar.php', [
												  'titulo' => 'Processo: '. $processo->tipo->nome ,
												  'tabela' => $this->tabela->processo_imprimir($processo),
												  //'pagina' => 'processo/visualizar.php',
												  ]);*/

		//$this->load->library('ProcessoImprimirLibrary');

		//$html = $this->processoimprimirlibrary->imprimir($processo);

		$this->imprimir($processo, $so_certidao);

	}

	public function novo()
	{

		$usuarioAtual = $this->UsuarioDAO->buscarPorId($this->session->id);

		$lei_e_modalidade_pre_definido = 1;

		$dados = array(
			'titulo' => 'Novo Processo',
			'pagina' => 'processo/novo.php',
			'departamentos' => $this->DepartamentoDAO->options(),
			'departamento' => $usuarioAtual->departamento->id,
			'modalidades_options' => $this->ModalidadeDAO->options(),
			'tipos_options' => $this->TipoDAO->options(),
			'leis_options' => $this->LeiDAO->options($lei_e_modalidade_pre_definido),
			'lei_e_modalidade_pre_definido' => $lei_e_modalidade_pre_definido
		);

		$this->load->view('index', $dados);
	}

	public function criar()
	{

		$data_post = $this->input->post();

		$processo = new Processo(
			null,
			ucfirst($data_post['objeto']),
			$data_post['numero'],
			$data_post['data_hora'],
			$data_post['chave'],
			$this->DepartamentoDAO->buscarPorId($this->session->departamento_id),
			$this->LeiDAO->buscarPorId($data_post['lei_id']),
			$this->TipoDAO->buscarPorId($data_post['tipo_id']),
			$data_post['completo'],
			true
		);

		$processo_id = $this->ProcessoDAO->criar($processo);

		redirect("ProcessoController/exibir/{$processo_id}");
	}

	public function alterar($id)
	{

		$processo = $this->ProcessoDAO->buscarPorId($id);

		$dados = array(
			'titulo' => 'Alterar Processo',
			'pagina' => 'processo/alterar.php',
			'processo' => $processo,
			'tipos_options' => $this->TipoDAO->options(),
			'departamentos' => $this->DepartamentoDAO->options(),
			'modalidades_options' => $this->ModalidadeDAO->options(),
			'leis_options' => $this->LeiDAO->options($processo->lei->modalidade->id)
		);

		$this->load->view('index', $dados);

	}

	public function atualizar()
	{

		$data_post = $this->input->post();

		$processo = new Processo(
			$data_post['id'],
			ucfirst($data_post['objeto']),
			$data_post['numero'],
			$data_post['data_hora'],
			$data_post['chave'],
			$this->DepartamentoDAO->buscarPorId($data_post['departamento_id']),
			$this->LeiDAO->buscarPorId($data_post['lei_id']),//$this->ModalidadeDAO->buscarPorId($data_post['modalidade_id']),
			$this->TipoDAO->buscarPorId($data_post['tipo_id']),
			$data_post['completo'],
			$data_post['status']
		);

		$this->ProcessoDAO->atualizar($processo);

		redirect('ProcessoController');
	}

	public function deletar($id)
	{

		$this->ProcessoDAO->delete($id);

		redirect('ProcessoController');
	}


	/**
	 * Summary of imprimir
	 * imprimir todos os arquivos em pdf do processoem um único arquivo,
	 * com o auxilio da biblioteca PDFMerger
	 * @param mixed $processo
	 * @return void
	 * importante: os ID do Artefato deve ser o mesmo do DataBase!!!
	 */
	private function imprimir($processo, $so_certidao)
	{
		include_once 'vendor/PDFMerger/PDFMerger.php';

		$pdf = new PDFMerger;

		foreach ($processo->tipo->listaDeArtefatos as $artefato) {

			if ($so_certidao) {
				switch ($artefato->id) {
					case 55:
					case 56:
					case 57:
					case 58:
					case 59:
					case 60:
					case 61:
					case 62:
					{
						if ($artefato->arquivos != null) {

							foreach ($artefato->arquivos as $arquivo) {

								if ($arquivo->path != '' && $arquivo->path != null) {
									$pdf->addPDF($arquivo->path, 'all');
								}
							}
						}
					}
					default:
						break;
				}
			} else {
				if ($artefato->arquivos != null) {

					foreach ($artefato->arquivos as $arquivo) {

						if ($arquivo->path != '' && $arquivo->path != null) {
							$pdf->addPDF($arquivo->path, 'all');
						}
					}
				}
			}


		}

		$nomeDoArquivo = $so_certidao ? 'Certidoes do ' : '';

		$nomeDoArquivo .=
			'Processo de ' . $processo->tipo->nome .
			' Lei' . $processo->lei->toString() .
			' Numero ' . $processo->numero;

		$pdf->merge('download', $nomeDoArquivo . '.pdf');
	}

}
