<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use Dompdf\Dompdf;

require_once('vendor/PDFMerger/PDFMerger.php');

use PDFMerger\PDFMerger;
use helper\Tempo;

include_once 'application/models/helper/Tempo.php';

class ProcessoController extends CI_Controller
{
	const PROCESSO_CONTROLLER = 'ProcessoController';

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
	}

	public function index()
	{
		usuarioPossuiSessaoAberta() ? $this->listarPorSetorDemandante() : redirecionarParaPaginaInicial();
	}


	function listar($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		$whare = ['status' => true];

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $whare);

		$params = [
			'controller' => 'ProcessoController/listar',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contar($whare)
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

	function listarTodosExcluidos($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		$whare = ['status' => false];

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $whare);

		$params = [
			'controller' => 'ProcessoController/listarTodosExcluidos',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contar($whare)
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

		$where = array('completo' => false, 'status' => true);

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

		$where = array('completo' => true, 'status' => true);

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

		$where = array('departamento_id' => $_SESSION['departamento_id'], 'status' => true);

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $where);

		$params = [
			'controller' => 'ProcessoController/listarPorSetorDemandante',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contarProcessosPorSetorDemandante()
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos por demandante: ' . $_SESSION['departamento_nome'],
			'tabela' => $this->processolibrary->listar($processos, $indice_no_data_base),
			'pagina' => 'processo/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);

	}

	function listarPorSetorDemandanteAlmox($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		/**
		 * O ID do setor demandante do almox deve ser o mesmo do DataBase!
		 */
		$departamento_id = 1;

		$where = array('departamento_id' => $departamento_id, 'status' => true);

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $where);

		$params = [
			'controller' => 'ProcessoController/listarPorSetorDemandanteAlmox',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contarProcessosPorSetorDemandante($departamento_id)
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos por demandante: Almox',
			'tabela' => $this->processolibrary->listar($processos, $indice_no_data_base),
			'pagina' => 'processo/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);

	}

	function listarPorSetorDemandanteSalc($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		/**
		 * O ID do setor demandante do almox deve ser o mesmo do DataBase!
		 */
		$departamento_id = 2;

		$where = array('departamento_id' => $departamento_id, 'status' => true);

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $where);

		$params = [
			'controller' => 'ProcessoController/listarPorSetorDemandanteSalc',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contarProcessosPorSetorDemandante($departamento_id)
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos por demandante: SALC',
			'tabela' => $this->processolibrary->listar($processos, $indice_no_data_base),
			'pagina' => 'processo/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);

	}

	function listarPorSetorDemandanteAprov($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		/**
		 * O ID do setor demandante do Aprov deve ser o mesmo do DataBase!
		 */
		$departamento_id = 6;

		$where = array('departamento_id' => $departamento_id, 'status' => true);

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $where);

		$params = [
			'controller' => 'ProcessoController/listarPorSetorDemandanteAprov',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contarProcessosPorSetorDemandante($departamento_id)
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos por demandante: Aprov',
			'tabela' => $this->processolibrary->listar($processos, $indice_no_data_base),
			'pagina' => 'processo/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);

	}

	function listarPorSetorDemandanteSaude($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		/**
		 * O ID do setor demandante do Saúde deve ser o mesmo do DataBase!
		 */
		$departamento_id = 7;

		$where = array('departamento_id' => $departamento_id, 'status' => true);

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $where);

		$params = [
			'controller' => 'ProcessoController/listarPorSetorDemandanteSaude',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contarProcessosPorSetorDemandante($departamento_id)
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos por demandante: Saúde',
			'tabela' => $this->processolibrary->listar($processos, $indice_no_data_base),
			'pagina' => 'processo/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);

	}

	function listarPorSetorDemandanteInformatica($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		/**
		 * O ID do setor demandante do Informática deve ser o mesmo do DataBase!
		 */
		$departamento_id = 8;

		$where = array('departamento_id' => $departamento_id, 'status' => true);

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $where);

		$params = [
			'controller' => 'ProcessoController/listarPorSetorDemandanteInformatica',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contarProcessosPorSetorDemandante($departamento_id)
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos por demandante: Infomática',
			'tabela' => $this->processolibrary->listar($processos, $indice_no_data_base),
			'pagina' => 'processo/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);

	}

	function listarPorSetorDemandanteMntTransp($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		/**
		 * O ID do setor demandante do Mnt e Transp deve ser o mesmo do DataBase!
		 */
		$departamento_id = 5;

		$where = array('departamento_id' => $departamento_id, 'status' => true);

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $where);

		$params = [
			'controller' => 'ProcessoController/listarPorSetorDemandanteMntTransp',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contarProcessosPorSetorDemandante($departamento_id)
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos por demandante: Mnt e Transp',
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
			new Tempo(),
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
			new Tempo($data_post['data_hora']),
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

		$this->ProcessoDAO->deletar($id);

		redirect('ProcessoController/listar');
	}

	public function recuperar($id)
	{

		$this->ProcessoDAO->recuperar($id);

		redirect('ProcessoController/listarTodosExcluidos');
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
		//$this->load->library('ImprimirPdf');

		//$this->imprimirpdf->processo($processo);


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
									if (file_exists($arquivo->path)) {
										$pdf->addPDF($arquivo->path, 'all');
									}
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
							if (file_exists($arquivo->path)) {
								$pdf->addPDF($arquivo->path, 'all');
							}

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

		$variavel_limpa = strtolower(preg_replace("/[^a-zA-Z0-9-]/", "-", strtr(utf8_decode(trim($nomeDoArquivo)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-")));

		$pdf->merge('download', $variavel_limpa . '.pdf');
	}

}
