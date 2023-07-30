<?php

require_once 'abstract_controller/AbstractController.php';

class AndamentoController extends AbstractController
{
	const  ANDAMENTO_CONTROLLER = 'AndamentoController';

	public function __construct()
	{
		parent::__construct();
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

		$this->load->library(
			'CriadorDeBotoes',
			arrayToCriadorDeBotoes(
				self::ANDAMENTO_CONTROLLER . '/listar',
				$this->contarTodosOsRegistros() ?? 0
			)
		);

		$this->load->view(
			'index',
			arrayToView(
				'Lista de Andamentos',
				$this->buscarTodosStatus($qtd_de_itens_para_exibir, $indice_no_data_base) ?? [],
				'andamento/index.php',
				$this->criadordebotoes->listar($indice) ?? ''
			)
		);
	}

	public function novo()
	{
		$dados = array(
			'titulo' => 'Novo Andamento',
			'pagina' => 'andamento/novo.php',
		);

		$this->load->view('index', $dados);
	}

	/**
	 * @return void
	 * @input STATUS_DO_ANDAMENTO
	 * @input PROCESSO_ID
	 * @input USUARIO_ID
	 */
	public function criar()
	{
		$this->load->library('DataHora');

		$array =
			[
				ID => null,
				STATUS_DO_ANDAMENTO => $this->input->post(STATUS_DO_ANDAMENTO),
				DATA_HORA => $this->datahora->formatoDoMySQL(),
				PROCESSO_ID => $this->input->post(PROCESSO_ID),
				USUARIO_ID => $this->input->post(USUARIO_ID),
				STATUS => true
			];

		$this->load->model('dao/AndamentoDAO');

		$this->AndamentoDAO->criar($array);

		redirect(self::ANDAMENTO_CONTROLLER);
	}

	public function alterar($id)
	{

		$andamento = $this->buscarPorId($id);

		$dados = array(
			'titulo' => 'Alterar Tipo de Licitação',
			'pagina' => 'andamento/alterar.php',
			'sugestao' => $andamento,
		);

		$this->load->view('index', $dados);

	}


	public function listarPorProcesso($proceso_id)
	{
		$this->load->view(
			'index',
			arrayToView(
				'Histórico de movimentos do processo',
				$this->buscarAonde(['processo_id' => $proceso_id]) ?? [],
				'andamento/andamento_de_um_processo.php',
				''
			)
		);
	}

	public function processoEnviado($processo_id)
	{
		$this->load->library('DataHora');

		$array =
			[
				ID => null,
				STATUS_DO_ANDAMENTO => Enviado::NOME,
				DATA_HORA => $this->datahora->formatoDoMySQL(),
				PROCESSO_ID => $processo_id,
				USUARIO_ID => $_SESSION[ID],
				STATUS => true
			];

		$this->load->model('dao/AndamentoDAO');

		$this->AndamentoDAO->criar($array);
	}

	public function processoAprovadoFiscAdm($processo_id)
	{
		$this->load->library('DataHora');

		$array =
			[
				ID => null,
				STATUS_DO_ANDAMENTO => AprovadoFiscAdm::NOME,
				DATA_HORA => $this->datahora->formatoDoMySQL(),
				PROCESSO_ID => $processo_id,
				USUARIO_ID => $_SESSION[ID],
				STATUS => true
			];

		$this->load->model('dao/AndamentoDAO');

		$this->AndamentoDAO->criar($array);
	}

	public function processoAprovadoOd($processo_id)
	{
		$this->load->library('DataHora');

		$array =
			[
				ID => null,
				STATUS_DO_ANDAMENTO => AprovadoOd::NOME,
				DATA_HORA => $this->datahora->formatoDoMySQL(),
				PROCESSO_ID => $processo_id,
				USUARIO_ID => $_SESSION[ID],
				STATUS => true
			];

		$this->load->model('dao/AndamentoDAO');

		$this->AndamentoDAO->criar($array);
	}

	public function processoExecutado($processo_id)
	{
		$this->load->library('DataHora');

		$array =
			[
				ID => null,
				STATUS_DO_ANDAMENTO => Executado::NOME,
				DATA_HORA => $this->datahora->formatoDoMySQL(),
				PROCESSO_ID => $processo_id,
				USUARIO_ID => $_SESSION[ID],
				STATUS => true
			];

		$this->load->model('dao/AndamentoDAO');

		$this->AndamentoDAO->criar($array);
	}

	public function processoConformado($processo_id)
	{
		$this->load->library('DataHora');

		$array =
			[
				ID => null,
				STATUS => true,
				STATUS_DO_ANDAMENTO => Conformado::NOME,
				DATA_HORA => $this->datahora->formatoDoMySQL(),
				PROCESSO_ID => $processo_id,
				USUARIO_ID => $_SESSION[ID],
			];

		$this->load->model('dao/AndamentoDAO');

		$this->AndamentoDAO->criar($array);
	}

	public function processoArquivar($processo_id)
	{
		$this->load->library('DataHora');

		$array =
			[
				ID => null,
				STATUS_DO_ANDAMENTO => Arquivado::NOME,
				DATA_HORA => $this->datahora->formatoDoMySQL(),
				PROCESSO_ID => $processo_id,
				USUARIO_ID => $_SESSION[ID],
				STATUS => true
			];

		$this->load->model('dao/AndamentoDAO');

		$this->AndamentoDAO->criar($array);
	}

	/**
	 * @param $listaDeArray
	 * @return array
	 */
	public function toObject($listaDeArray)
	{
		$listaDeAndamentos = [];

		foreach ($listaDeArray as $linha) {
			$id = $linha->id ?? $linha[ID] ?? null;
			$statusDoAndamento = $linha->status_do_andamento ?? $linha[STATUS_DO_ANDAMENTO] ?? null;
			$data_hora = $linha->data_hora ?? $linha[DATA_HORA] ?? null;
			$usuario_id = $linha->usuario_id ?? $linha[USUARIO_ID] ?? null;
			$status = $linha->status ?? $linha[STATUS] ?? null;

			$this->load->library('DataHora', $data_hora);

			$this->load->model('dao/UsuarioDAO');

			$andamento =
				new Andamento(
					$id,
					$status,
					$this->selecionarStatus($statusDoAndamento),
					$this->datahora,
					$this->UsuarioDAO->buscarPorId($usuario_id)
				);
			$listaDeAndamentos[] = $andamento;
		}

		return $listaDeAndamentos;
	}


	/**
	 * @param $nome
	 * @return AprovadoFiscAdm|AprovadoOd|Arquivado|Conformado|Criado|Enviado|Executado|void
	 */
	public static function selecionarStatus($nome)
	{
		switch ($nome) {
			case Criado::NOME:
				return new Criado();
			case Enviado::NOME:
				return new Enviado();
			case AprovadoFiscAdm::NOME:
				return new AprovadoFiscAdm();
			case AprovadoOd::NOME:
				return new AprovadoOd();
			case Executado::NOME:
				return new Executado();
			case Conformado::NOME:
				return new Conformado();
			case Arquivado::NOME:
				return new Arquivado();
		}
	}

	/**
	 * Banco de dados
	 */


	/**
	 * @return void
	 * @input ID
	 * @input STATUS_DO_ANDAMENTO
	 * @input DATA_HORA
	 * @input PROCESSO_ID
	 * @input USUARIO_ID
	 */
	public function atualizar()
	{
		$this->load->library(
			'DataHora',
			$this->input->post(DATA_HORA)
		);

		$array =
			[
				ID => $this->input->post(ID),
				STATUS_DO_ANDAMENTO => $this->input->post(STATUS_DO_ANDAMENTO),
				DATA_HORA => $this->datahora->formatoDoMySQL(),
				PROCESSO_ID => $this->input->post(PROCESSO_ID),
				USUARIO_ID => $this->input->post(USUARIO_ID),
				STATUS => true
			];

		$this->load->model('dao/AndamentoDAO');

		$this->AndamentoDAO->atualizar($array);

		redirect(self::ANDAMENTO_CONTROLLER);
	}

	/**
	 * @param $id
	 * @return array
	 */
	public function buscarPorId($id)
	{
		$this->load->model('dao/AndamentoDAO');

		$array = $this->AndamentoDAO->BuscarPorId($id);

		return $this->toObject($array);
	}

	/**
	 * @param $inicio
	 * @param $fim
	 * @return array
	 */
	public function buscarTodosAtivos($inicio, $fim)
	{
		$this->load->model('dao/AndamentoDAO');

		$array = $this->AndamentoDAO->buscarTodosAtivos($inicio, $fim);

		return $this->toObject($array);
	}

	/**
	 * @param $inicio
	 * @param $fim
	 * @return array
	 */
	public function buscarTodosInativos($inicio, $fim)
	{
		$this->load->model('dao/AndamentoDAO');

		$array = $this->AndamentoDAO->buscarTodosInativos($inicio, $fim);

		return $this->toObject($array);
	}

	/**
	 * @param $inicio
	 * @param $fim
	 * @return array
	 */
	public function buscarTodosStatus($inicio, $fim)
	{
		$this->load->model('dao/AndamentoDAO');

		$array = $this->AndamentoDAO->buscarTodosStatus($inicio, $fim);

		return $this->toObject($array);
	}

	/**
	 * @param $inicio
	 * @param $fim
	 * @return array
	 */
	public function buscarAonde($where)
	{
		$this->load->model('dao/AndamentoDAO');

		$array = $this->AndamentoDAO->buscarAonde($where);

		return $this->toObject($array);
	}

	/**
	 * @param $id
	 * @return void
	 */
	public function excluirDeFormaPermanente($id)
	{
		$this->load->model('dao/AndamentoDAO');

		$this->AndamentoDAO->excluirDeFormaPermanente($id);
	}

	/**
	 * @param $id
	 * @return void
	 */
	public function excluirDeFormaLogica($id)
	{
		$this->load->model('dao/AndamentoDAO');

		$this->AndamentoDAO->excluirDeFormaLogica($id);
	}

	/**
	 * @return int
	 */
	public function contarRegistrosAtivos()
	{
		$this->load->model('dao/AndamentoDAO');

		return $this->AndamentoDAO->contarRegistrosAtivos();
	}


	/**
	 * @return int
	 */
	public function contarRegistrosInativos()
	{
		$this->load->model('dao/AndamentoDAO');

		return $this->AndamentoDAO->contarRegistrosInativos();
	}


	/**
	 * @return int
	 */
	public function contarTodosOsRegistros()
	{
		$this->load->model('dao/AndamentoDAO');

		return $this->AndamentoDAO->contarTodosOsRegistros();
	}

	/**
	 * @return array
	 */
	public function options()
	{
		$this->load->model('dao/AndamentoDAO');

		return $this->AndamentoDAO->options();
	}
}
