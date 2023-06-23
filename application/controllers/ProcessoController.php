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

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir,$indice_no_data_base);

		$params = [
			'controller' => 'ProcessoController',
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

		redirect('ProcessoController/exibir/'.$processo_id);
	}

	public function aprovarProcesso($processo_id)
	{
		$this->AndamentoDAO->processoAprovado($processo_id);

		 redirect('ProcessoController/exibir/'.$processo_id);
	}

	public function executarProcesso($processo_id)
	{
		$this->AndamentoDAO->processoExecutado($processo_id);

		redirect('ProcessoController/exibir/'.$processo_id);
	}

	public function conformarProcesso($processo_id)
	{
		$this->AndamentoDAO->processoConformado($processo_id);

		redirect('ProcessoController/exibir/'.$processo_id);
	}
	public function arquivarProcesso($processo_id)
	{
		$this->AndamentoDAO->processoArquivar($processo_id);

		$processo = $this->ProcessoDAO->buscarPorId($processo_id);

		$processo->completo = true;

		$this->ProcessoDAO->atualizar($processo);

		redirect('ProcessoController/exibir/'.$processo_id);
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

	public function imprimirProcesso($id)
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

		$this->imprimir($processo);

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
			'modalidades' => $this->ModalidadeDAO->options(),
			'tipos' => $this->TipoDAO->options(),
			'leis' => $this->LeiDAO->options($lei_e_modalidade_pre_definido),
			'lei_e_modalidade_pre_definido' => $lei_e_modalidade_pre_definido
		);

		$this->load->view('index', $dados);
	}

	public function criar()
	{

		$data_post = $this->input->post();

		$processo = new Processo(
			null,
			$data_post['objeto'],
			$data_post['numero'],
			DataLibrary::dataHoraMySQL(),
			uniqid(),
			$this->DepartamentoDAO->buscarPorId($this->session->departamento_id),
			$this->LeiDAO->buscarPorId($data_post['lei_id']),
			$this->TipoDAO->buscarPorId($data_post['tipo_id']),
			$data_post['completo'],
			true,
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
			'departamentos' => $this->DepartamentoDAO->options(),
			'modalidades' => $this->ModalidadeDAO->options(),

		);

		$this->load->view('index', $dados);

	}

	public function atualizar()
	{

		$data_post = $this->input->post();

		$processo = new Processo(
			$data_post['id'],
			$data_post['objeto'],
			$data_post['numero'],
			$this->data->dataHoraMySQL(),
			$data_post['chave'],
			$this->DepartamentoDAO->buscarPorId($data_post['departamento_id']),
			$this->ModalidadeDAO->buscarPorId($data_post['modalidade_id']),
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
	 */
	private function imprimir($processo)
	{
		include_once 'vendor/PDFMerger/PDFMerger.php';

		$pdf = new PDFMerger;

		foreach ($processo->tipo->listaDeArtefatos as $artefato) {

			if ($artefato->arquivos != null) {

				foreach ($artefato->arquivos as $arquivo) {

					if ($arquivo->path != '' && $arquivo->path != null) {
						$pdf->addPDF($arquivo->path, 'all');

					}
				}
			}
		}

		$nomeDoArquivo =
			'Processo de ' . $processo->tipo->nome .
			' Lei' . $processo->lei->toString() .
			' Numero ' . $processo->numero;

		$pdf->merge('download', $nomeDoArquivo . '.pdf');
	}
}
