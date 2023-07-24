<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use Dompdf\Dompdf;

require_once('vendor/PDFMerger/PDFMerger.php');

use PDFMerger\PDFMerger;
use helper\Tempo;

class ProcessoController extends CI_Controller
{

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

		$whare = [STATUS => true];

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $whare);

		$this->load->library(
			'CriadorDeBotoes',
			[
				'controller' => PROCESSO_CONTROLLER . '/listar',
				'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contar($whare)
			]);

		$this->load->view(
			'index',
			[
				'titulo' => 'Processos',
				'tabela' => $processos,
				'pagina' => 'processo/index.php',
				'botoes' => (empty($processos) ? '' : $this->criadordebotoes->listar($indice))
			]
		);

	}

	function listarTodosExcluidos($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		$whare = [STATUS => false];

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $whare);

		$params = [
			'controller' => PROCESSO_CONTROLLER . '/listarTodosExcluidos',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contar($whare)
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos',
			'tabela' => $processos,
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

		$where = array(COMPLETO => false, STATUS => true);

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $where);

		$params = [
			'controller' => PROCESSO_CONTROLLER . '/listarTodosProcessosIncompleto',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contar($where)
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos',
			'tabela' => $processos,
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

		$where = array(COMPLETO => true, STATUS => true);

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $where);

		$params = [
			'controller' => PROCESSO_CONTROLLER . '/listarTodosProcessosCompleto',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contar($where)
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos',
			'tabela' => $processos,
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

		$where = array(DEPARTAMENTO_ID => $_SESSION[DEPARTAMENTO_ID], STATUS => true);

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $where);

		$params = [
			'controller' => PROCESSO_CONTROLLER . '/listarPorSetorDemandante',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contarProcessosPorSetorDemandante()
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos por demandante: ' . $_SESSION['departamento_nome'],
			'tabela' => $processos,
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

		$where = array(DEPARTAMENTO_ID => $departamento_id, STATUS => true);

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $where);

		$params = [
			'controller' => PROCESSO_CONTROLLER . '/listarPorSetorDemandanteAlmox',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contarProcessosPorSetorDemandante($departamento_id)
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos por demandante: Almox',
			'tabela' => $processos,
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

		$where = array(DEPARTAMENTO_ID => $departamento_id, STATUS => true);

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $where);

		$params = [
			'controller' => PROCESSO_CONTROLLER . '/listarPorSetorDemandanteSalc',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contarProcessosPorSetorDemandante($departamento_id)
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos por demandante: SALC',
			'tabela' => $processos,
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

		$where = array(DEPARTAMENTO_ID => $departamento_id, STATUS => true);

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $where);

		$params = [
			'controller' => PROCESSO_CONTROLLER . '/listarPorSetorDemandanteAprov',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contarProcessosPorSetorDemandante($departamento_id)
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos por demandante: Aprov',
			'tabela' => $processos,
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

		$where = array(DEPARTAMENTO_ID => $departamento_id, STATUS => true);

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $where);

		$params = [
			'controller' => PROCESSO_CONTROLLER . '/listarPorSetorDemandanteSaude',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contarProcessosPorSetorDemandante($departamento_id)
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos por demandante: Saúde',
			'tabela' => $processos,
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

		$where = array(DEPARTAMENTO_ID => $departamento_id, STATUS => true);

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $where);

		$params = [
			'controller' => PROCESSO_CONTROLLER . '/listarPorSetorDemandanteInformatica',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contarProcessosPorSetorDemandante($departamento_id)
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos por demandante: Infomática',
			'tabela' => $processos,
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

		$where = array(DEPARTAMENTO_ID => $departamento_id, STATUS => true);

		$processos = $this->ProcessoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base, $where);

		$params = [
			'controller' => PROCESSO_CONTROLLER . '/listarPorSetorDemandanteMntTransp',
			'quantidade_de_registros_no_banco_de_dados' => $this->ProcessoDAO->contarProcessosPorSetorDemandante($departamento_id)
		];

		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($processos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de processos por demandante: Mnt e Transp',
			'tabela' => $processos,
			'pagina' => 'processo/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);

	}

	public function exibir($id)
	{
		$processo = $this->ProcessoDAO->buscarPorId($id);

		$this->load->view(
			'index',
			[
				'titulo' => 'Processo: ' . $processo->tipo->nome,
				'processo' => $processo,
				'pagina' => 'processo/exibir.php'
			]);
	}

	public function exibirArtefatos($processoId)
	{
		$processo = $this->ProcessoDAO->buscarPorId($processoId);

		$this->load->view(
			'index',
			[
				'titulo' => 'Processo: ' . $processo->tipo->nome,
				'processo' => $processo,
				'pagina' => 'processo/exibir_artefatos.php'
			]);
	}

	public function enviarProcesso($processo_id)
	{
		$this->AndamentoDAO->processoEnviado($processo_id);

		redirect(PROCESSO_CONTROLLER . '/exibir/' . $processo_id);
	}

	public function aprovarProcessoFiscAdm($processo_id)
	{
		$this->AndamentoDAO->processoAprovadoFiscAdm($processo_id);

		redirect(PROCESSO_CONTROLLER . '/exibir/' . $processo_id);
	}


	public function aprovarProcessoOd($processo_id)
	{
		$this->AndamentoDAO->processoAprovadoOd($processo_id);

		redirect(PROCESSO_CONTROLLER . '/exibir/' . $processo_id);
	}

	public function executarProcesso($processo_id)
	{
		$this->AndamentoDAO->processoExecutado($processo_id);

		redirect(PROCESSO_CONTROLLER . '/exibir/' . $processo_id);
	}

	public function conformarProcesso($processo_id)
	{
		$this->AndamentoDAO->processoConformado($processo_id);

		redirect(PROCESSO_CONTROLLER . '/exibir/' . $processo_id);
	}

	public function arquivarProcesso($processo_id)
	{
		$this->AndamentoDAO->processoArquivar($processo_id);

		$processo = $this->ProcessoDAO->buscarPorId($processo_id);

		$processo->completo = true;

		$this->ProcessoDAO->atualizar($processo);

		redirect(PROCESSO_CONTROLLER . '/exibir/' . $processo_id);
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


	public function novo()
	{
		$lei_e_modalidade_pre_definido = 1;

		$dados = array(
			'titulo' => 'Novo Processo',
			'pagina' => 'processo/novo.php',
			'departamentos' => $this->DepartamentoDAO->options(),
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

		$this->load->library('DataHora');

		$processo = new Processo(
			null,
			ucfirst($data_post[OBJETO]),
			$data_post[NUMERO],
			$this->datahora->formatoDoMySQL(),
			$data_post[CHAVE],
			$this->DepartamentoDAO->buscarPorId($_SESSION[SESSION_DEPARTAMENTO_ID]),
			$this->LeiDAO->buscarPorId($data_post[LEI_ID]),
			$this->TipoDAO->buscarPorId($data_post[TIPO_ID]),
			$data_post[COMPLETO],
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

		$this->load->library('DataHora', $data_post[DATA_HORA]);

		$processo = new Processo(
			$data_post[ID],
			ucfirst($data_post[OBJETO]),
			$data_post[NUMERO],
			$this->datahora->formatoDoMySQL(),
			$data_post[CHAVE],
			$this->DepartamentoDAO->buscarPorId($data_post[DEPARTAMENTO_ID]),
			$this->LeiDAO->buscarPorId($data_post[LEI_ID]),
			$this->TipoDAO->buscarPorId($data_post[TIPO_ID]),
			$data_post[COMPLETO],
			$data_post[STATUS]
		);

		$this->ProcessoDAO->atualizar($processo);

		redirect(PROCESSO_CONTROLLER);
	}

	public function deletar($id)
	{
		$this->ProcessoDAO->deletar($id);
		redirect(PROCESSO_CONTROLLER . '/listar');
	}

	public function recuperar($id)
	{
		$this->ProcessoDAO->recuperar($id);
		redirect(PROCESSO_CONTROLLER . '/listarTodosExcluidos');
	}

	public function imprimir($processoId)
	{
		$processo = $this->ProcessoDAO->buscarPorId($processoId);
		$this->imprimirProcesso($processo);
	}

	private function imprimirProcesso($processo)
	{
		$listaDePath = [];

		foreach ($processo->tipo->listaDeArtefatos as $artefato) {

			if ($artefato->arquivos != array()) {

				foreach ($artefato->arquivos as $arquivo) {

					if (file_exists($arquivo->path)) {
						$listaDePath[] = $arquivo->path;
					}
				}
			}
		}

		$this->load->library('Pdf');
		$this->pdf->imprimir($listaDePath, $processo->toString());
	}

	public function imprimirCertidoes($processoId)
	{
		$processo = $this->ProcessoDAO->buscarPorId($processoId);

		$listaDePath = [];

		foreach ($processo->tipo->listaDeArtefatos as $artefato) {
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
					if ($artefato->arquivos != array()) {
						foreach ($artefato->arquivos as $arquivo) {
							if (file_exists($arquivo->path)) {

								$listaDePath[] = $arquivo->path;
								break;
							}
						}
					}
				}
				default:
				{
					break;
				}
			}
		}
		$this->load->library('Pdf');
		$this->pdf->imprimir($listaDePath, $processo->toString());
	}
}
