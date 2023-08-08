<?php

require_once 'abstract_controller/AbstractController.php';

class ProcessoController extends AbstractController
{
	const PROCESSO_CONTROLLER = 'ProcessoController';

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		is_session_email_helper() ? $this->listarPorSetorDemandante() : redirecionarParaPaginaInicial();
	}

	public function novo()
	{
		$lei_e_modalidade_pre_definido = 1;

		$this->load->model('dao/DepartamentoDAO');
		$this->load->model('dao/ModalidadeDAO');
		$this->load->model('dao/TipoDAO');
		$this->load->model('dao/LeiDAO');

		$this->load->view('index', [
			'titulo' => 'Novo Processo',
			'pagina' => 'processo/novo.php',
			'departamentos' => $this->DepartamentoDAO->options(),
			'modalidades_options' => $this->ModalidadeDAO->options(),
			'tipos_options' => $this->TipoDAO->options(),
			'leis_options' => $this->LeiDAO->options($lei_e_modalidade_pre_definido),
			'lei_e_modalidade_pre_definido' => $lei_e_modalidade_pre_definido
		]);
	}

	function listar($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		$this->load->library(
			'CriadorDeBotoes',
			arrayToCriadorDeBotoes(
				self::PROCESSO_CONTROLLER . '/listar',
				$this->contarRegistrosAtivos() ?? 0
			)
		);

		$this->load->view(
			'index',
			arrayToView(
				'Processos',
				$this->buscarTodosAtivos($qtd_de_itens_para_exibir, $indice_no_data_base) ?? [],
				'processo/index.php',
				$this->criadordebotoes->listar($indice) ?? ''
			)
		);
	}

	function listarTodosExcluidos($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		$this->load->library('CriadorDeBotoes',
			arrayToCriadorDeBotoes(
				self::PROCESSO_CONTROLLER . '/listarTodosExcluidos',
				$this->contarRegistrosInativos() ?? 0
			)
		);

		$this->load->view('index',
			arrayToView(
				'Lista de processos',
				$this->buscarTodosInativos($qtd_de_itens_para_exibir, $indice_no_data_base) ?? [],
				'processo/index.php',
				$this->criadordebotoes->listar($indice) ?? 0
			)
		);
	}

	function listarTodosProcessosIncompleto($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		$where = array(COMPLETO => false, STATUS => true);

		$this->load->library('CriadorDeBotoes',
			arrayToCriadorDeBotoes(
				self::PROCESSO_CONTROLLER . '/listarTodosProcessosIncompleto',
				$this->contarTodosOsRegistrosAonde($where)
			)
		);

		$this->load->view('index',
			arrayToView(
				'Lista de processos',
				$this->buscarAonde($qtd_de_itens_para_exibir, $indice_no_data_base, $where) ?? [],
				'processo/index.php',
				$this->criadordebotoes->listar($indice) ?? []
			)
		);

	}

	function listarTodosProcessosCompleto($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		$where = array(COMPLETO => true, STATUS => true);

		$this->load->library('CriadorDeBotoes',
			arrayToCriadorDeBotoes(
				self::PROCESSO_CONTROLLER . '/listarTodosProcessosCompleto',
				$this->contarTodosOsRegistrosAonde($where) ?? 0
			)
		);

		$this->load->view('index',
			arrayToView(
				'Lista de processos',
				$this->buscarAonde($qtd_de_itens_para_exibir, $indice_no_data_base, $where) ?? [],
				'processo/index.php',
				$this->criadordebotoes->listar($indice) ?? 0
			)
		);
	}

	function listarPorSetorDemandante($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		$where = array(DEPARTAMENTO_ID => $_SESSION[DEPARTAMENTO_ID], STATUS => true);

		$this->load->library('CriadorDeBotoes',
			arrayToCriadorDeBotoes(
				self::PROCESSO_CONTROLLER . '/listarPorSetorDemandante',
				$this->contarTodosOsRegistrosAonde($where) ?? 0
			)
		);

		$this->load->view('index',
			arrayToView(
				'Lista de processos por demandante: ' . $_SESSION['departamento_nome'],
				$this->buscarAonde($qtd_de_itens_para_exibir, $indice_no_data_base, $where) ?? [],
				'processo/index.php',
				$this->criadordebotoes->listar($indice) ?? []
			)
		);
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

		$this->load->library('CriadorDeBotoes',
			arrayToCriadorDeBotoes(
				self::PROCESSO_CONTROLLER . '/listarPorSetorDemandanteAlmox',
				$this->ProcessoDAO->contarProcessosPorSetorDemandante($departamento_id) ?? []
			)
		);

		$this->load->view('index',
			arrayToView(
				'Lista de processos por demandante: Almox',
				$this->buscarAonde($qtd_de_itens_para_exibir, $indice_no_data_base, $where) ?? [],
				'processo/index.php',
				$this->criadordebotoes->listar($indice) ?? ''
			)
		);
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

		$this->load->library('CriadorDeBotoes',
			arrayToCriadorDeBotoes(
				self::PROCESSO_CONTROLLER . '/listarPorSetorDemandanteAlmox',
				$this->ProcessoDAO->contarProcessosPorSetorDemandante($departamento_id) ?? []
			)
		);

		$this->load->view('index',
			arrayToView(
				'Lista de processos por demandante: Almox',
				$this->buscarAonde($qtd_de_itens_para_exibir, $indice_no_data_base, $where) ?? [],
				'processo/index.php',
				$this->criadordebotoes->listar($indice) ?? ''
			)
		);
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

		$this->load->library('CriadorDeBotoes',
			arrayToCriadorDeBotoes(
				self::PROCESSO_CONTROLLER . '/listarPorSetorDemandanteAlmox',
				$this->ProcessoDAO->contarProcessosPorSetorDemandante($departamento_id) ?? []
			)
		);

		$this->load->view('index',
			arrayToView(
				'Lista de processos por demandante: Almox',
				$this->buscarAonde($qtd_de_itens_para_exibir, $indice_no_data_base, $where) ?? [],
				'processo/index.php',
				$this->criadordebotoes->listar($indice) ?? ''
			)
		);
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

		$this->load->library('CriadorDeBotoes',
			arrayToCriadorDeBotoes(
				self::PROCESSO_CONTROLLER . '/listarPorSetorDemandanteAlmox',
				$this->ProcessoDAO->contarProcessosPorSetorDemandante($departamento_id) ?? []
			)
		);

		$this->load->view('index',
			arrayToView(
				'Lista de processos por demandante: Almox',
				$this->buscarAonde($qtd_de_itens_para_exibir, $indice_no_data_base, $where) ?? [],
				'processo/index.php',
				$this->criadordebotoes->listar($indice) ?? ''
			)
		);
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

		$this->load->library('CriadorDeBotoes',
			arrayToCriadorDeBotoes(
				self::PROCESSO_CONTROLLER . '/listarPorSetorDemandanteAlmox',
				$this->ProcessoDAO->contarProcessosPorSetorDemandante($departamento_id) ?? []
			)
		);

		$this->load->view('index',
			arrayToView(
				'Lista de processos por demandante: Almox',
				$this->buscarAonde($qtd_de_itens_para_exibir, $indice_no_data_base, $where) ?? [],
				'processo/index.php',
				$this->criadordebotoes->listar($indice) ?? ''
			)
		);
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

		$this->load->library('CriadorDeBotoes',
			arrayToCriadorDeBotoes(
				self::PROCESSO_CONTROLLER . '/listarPorSetorDemandanteAlmox',
				$this->ProcessoDAO->contarProcessosPorSetorDemandante($departamento_id) ?? []
			)
		);

		$this->load->view('index',
			arrayToView(
				'Lista de processos por demandante: Almox',
				$this->buscarAonde($qtd_de_itens_para_exibir, $indice_no_data_base, $where) ?? [],
				'processo/index.php',
				$this->criadordebotoes->listar($indice) ?? ''
			)
		);
	}

	public function exibir($id)
	{
		$this->load->view(
			'index',
			[
				'titulo' => 'Processo',
				'processo' => $this->buscarPorId($id),
				'pagina' => 'processo/exibir.php'
			]);
	}

	public function exibirArtefatos($id)
	{
		$this->load->view(
			'index',
			[
				'titulo' => 'Processo',
				'processo' => $this->buscarPorId($id),
				'pagina' => 'processo/exibir_artefatos.php'
			]);
	}

	public function enviarProcesso($processo_id)
	{
		redirect(AndamentoController::ANDAMENTO_CONTROLLER . '/processoEnviado/' . $processo_id);
	}

	public function aprovarProcessoFiscAdm($processo_id)
	{
		redirect(AndamentoController::ANDAMENTO_CONTROLLER . '/processoAprovadoFiscAdm/' . $processo_id);
	}


	public function aprovarProcessoOd($processo_id)
	{
		redirect(AndamentoController::ANDAMENTO_CONTROLLER . '/processoAprovadoOd/' . $processo_id);
	}

	public function executarProcesso($processo_id)
	{
		redirect(AndamentoController::ANDAMENTO_CONTROLLER . '/processoExecutado/' . $processo_id);
	}

	public function conformarProcesso($processo_id)
	{
		redirect(AndamentoController::ANDAMENTO_CONTROLLER . '/processoConformado/' . $processo_id);
	}

	public function arquivarProcesso($processo_id)
	{
		redirect(AndamentoController::ANDAMENTO_CONTROLLER . '/processoArquivar/' . $processo_id);
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


	public function criar()
	{
		$this->load->library('DataHora');

		$array = [
			ID => null,
			OBJETO => $this->input->post(OBJETO),
			NUMERO => $this->input->post(NUMERO),
			DATA_HORA => $this->datahora->formatoDoMySQL(),
			CHAVE => uniqid('', true),
			DEPARTAMENTO_ID => $_SESSION[SESSION_DEPARTAMENTO_ID],
			LEI_ID => $this->input->post(LEI_ID),
			TIPO_ID => $this->input->post(TIPO_ID),
			COMPLETO => false,
		];

		$this->load->model('dao/ProcesssoDAO');

		$this->ProcessoDAO->criar($array);

		$processo = $this->buscarAonde($array);

		redirect("ProcessoController/exibir/" . $processo->id);
	}

	public function alterar($id)
	{
		$this->load->model('dao/TipoDAO');
		$this->load->model('dao/DepartamentoDAO');
		$this->load->model('dao/ModalidadeDAO');
		$this->load->model('dao/LeiDAO');

		$processo = $this->buscarPorId($id);

		$this->load->view('index',
			[
				'titulo' => 'Alterar Processo',
				'pagina' => 'processo/alterar.php',
				'processo' => $processo,
				'tipos_options' => $this->TipoDAO->options(),
				'departamentos' => $this->DepartamentoDAO->options(),
				'modalidades_options' => $this->ModalidadeDAO->options(),
				'leis_options' => $this->LeiDAO->options($processo->lei->modalidade->id)
			]
		);
	}

	public function atualizar()
	{
		$this->load->library('DataHora', $this->input->post(DATA_HORA));

		$array = [
			ID => $this->input->post(ID),
			OBJETO => $this->input->post(OBJETO),
			NUMERO => $this->input->post(NUMERO),
			DATA_HORA => $this->datahora->formatoDoMySQL(),
			CHAVE => $this->input->post(CHAVE),
			DEPARTAMENTO_ID => $this->input->post(DEPARTAMENTO_ID),
			LEI_ID => $this->input->post(LEI_ID),
			TIPO_ID => $this->input->post(TIPO_ID),
			COMPLETO => $this->input->post(COMPLETO),
		];

		$this->load->model('dao/ProcessoDAO');

		$this->ProcessoDAO->atualizar($array);

		redirect(self::PROCESSO_CONTROLLER . '/exibir/' . $array[ID]);
	}

	public function recuperar($id)
	{
		$this->load->model('dao/ProcessoDAO');

		$this->ProcessoDAO->recuperar($id);

		redirect(self::PROCESSO_CONTROLLER . '/exibir/' . $id);
	}

	public function imprimir($id)
	{
		$this->imprimirProcesso($this->buscarPorId($id));
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

	public function toObject($listaDeArray)
	{
		$listaDeProcessos = [];

		foreach ($listaDeArray as $linha) {
			$id = $linha->id ?? ($linha['id'] ?? null);
			$status = $linha->status ?? $linha['status'] ?? null;
			$objeto = $linha->objeto ?? $linha['objeto'] ?? null;
			$numero = $linha->numero ?? $linha['numero'] ?? null;
			$data_hora = $linha->data_hora ?? $linha['data_hora'] ?? null;
			$chave = $linha->chave ?? $linha['chave'] ?? null;
			$completo = $linha->completo ?? $linha['completo'] ?? null;
			$lei_id = $linha->lei_id ?? $linha['lei_id'] ?? null;
			$departamento_id = $linha->departamento_id ?? $linha['departamento_id'] ?? null;
			$tipo_id = $linha->tipo_id ?? $linha['tipo_id'] ?? null;

			$listaDeArtefatosId =
				$this->db
					->where([
						TIPO_ID => $id,
						LEI_ID => $lei_id])
					->order_by(ID, DIRECTIONS_ASC)
					->get('lei_tipo_artefato');

			$this->load->library('DataHora', $data_hora);

			$listaDeArtefatos = [];

			foreach ($listaDeArtefatosId as $artefatoId) {
				$listaDeArtefatos[] = $this->ArtefatoDAO->buscarPorId($artefatoId);
			}

			$this->load->model('dao/AndamentoDAO');
			$listaDeAndamentos = $this->AndamentoDAO->buscarAonde([PROCESSO_ID => $id]);

			$this->load->model('dao/LeiDAO');
			$this->load->model('dao/DepartamentoDAO');
			$this->load->model('dao/TipoDAO');

			$processo = new Processo(
				$id ?? null,
				$status ?? null,
				$objeto ?? null,
				$numero ?? null,
				$this->datahora ?? null,
				$chave ?? null,
				$completo ?? null,
				$this->LeiDAO->buscarPorId($lei_id) ?? null,
				$this->DepartamentoDAO->buscarPorId($departamento_id) ?? null,
				$listaDeArtefatos ?? null,
				$this->TipoDAO->buscarPorId($tipo_id) ?? null,
				$listaDeAndamentos ?? null
			);
			$listaDeProcessos[] = $processo;
		}

		return $listaDeProcessos;
	}

	public function contarRegistrosAtivos()
	{
		$this->load->model('dao/ProcessoDAO');
		$this->ProcessoDAO->contarRegistrosAtivos();
	}

	public function contarRegistrosInativos()
	{
		$this->load->model('dao/ProcessoDAO');
		$this->ProcessoDAO->contarRegistrosInativos();
	}

	public function contarTodosOsRegistros()
	{
		$this->load->model('dao/ProcessoDAO');
		$this->ProcessoDAO->contarTodosOsRegistros();
	}

	public function excluirDeFormaPermanente($id)
	{
		$this->load->model('dao/ProcessoDAO');
		$this->ProcessoDAO->excluirDeFormaPermanente($id);
	}

	public function excluirDeFormaLogica($id)
	{
		$this->load->model('dao/ProcessoDAO');
		$this->ProcessoDAO->excluirDeFormaLogica($id);
	}

	public function options()
	{
		$this->load->model('dao/ProcessoDAO');
		return $this->ProcessoDAO->options();
	}

	public function buscarPorId($id)
	{
		$this->load->model('dao/ProcessoDAO');
		return $this->ProcessoDAO->buscarPorId($id);
	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		$this->load->model('dao/ProcessoDAO');
		return $this->ProcessoDAO->buscarTodosAtivos($inicio, $fim);
	}

	public function buscarTodosInativos($inicio, $fim)
	{
		$this->load->model('dao/ProcessoDAO');
		return $this->ProcessoDAO->buscarTodosInativos($inicio, $fim);
	}

	public function buscarTodosStatus($inicio, $fim)
	{
		$this->load->model('dao/ProcessoDAO');
		return $this->ProcessoDAO->buscarTodosStatus($inicio, $fim);
	}

	public function buscarAonde($inicio, $fim, $where)
	{
		$this->load->model('dao/ProcessoDAO');
		return $this->ProcessoDAO->buscarAonde($inicio, $fim,$where);
	}

	public function contarTodosOsRegistrosAonde($where)
	{
		$this->load->model('dao/ProcessoDAO');
		return $this->ProcessoDAO->contarTodosOsRegistrosAonde($where);
	}
}
