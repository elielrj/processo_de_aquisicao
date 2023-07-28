<?php

require_once 'AbstractController.php';

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

		$andamentos = $this->buscarTodosStatus($qtd_de_itens_para_exibir, $indice_no_data_base);

		$this->load->library(
			'CriadorDeBotoes',
			[
				'controller' => AndamentoController::ANDAMENTO_CONTROLLER . '/listar',
				'quantidade_de_registros_no_banco_de_dados' => $this->contarTodosOsRegistros()
			]);

		$botoes = empty($andamentos) ? '' : $this->criadordebotoes->listar($indice);

		$this->load->view(
			'index',
			[
				'titulo' => 'Lista de andamentos',
				'tabela' => $andamentos,
				'pagina' => 'andamento/index.php',
				'botoes' => $botoes
			]);
	}


	public function listarPorProcesso($proceso_id)
	{
		$andamentos = $this->AndamentoDAO->buscarTodosOsAndamentosDeUmProcesso($proceso_id);

		$this->load->model('dao/ProcessoDAO');

		$processo = $this->ProcessoDAO->buscarPorId($proceso_id);

		$this->load->view(
			'index',
			[
				'titulo' => 'Histórico de movimentos do processo de ' . $processo->tipo->nome,
				'tabela' => $andamentos,
				'pagina' => 'andamento/andamento_de_um_processo.php'
			]);
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
				STATUS_DO_ANDAMENTO => Conformado::NOME,
				DATA_HORA => $this->datahora->formatoDoMySQL(),
				PROCESSO_ID => $processo_id,
				USUARIO_ID => $_SESSION[ID],
				STATUS => true
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
	 * @param $listaDeObjetos
	 * @return array
	 */
	public function toArray($listaDeObjetos)
	{
		$listaDeArray = [];

		foreach ($listaDeObjetos as $objeto) {

			$linha =
				array(
					ID => $objeto->id ?? null,
					STATUS_DO_ANDAMENTO => $objeto->statusDoAndamento->nome(),
					DATA_HORA => $objeto->dataHora,
					PROCESSO_ID => $objeto->processo_id,
					USUARIO_ID => $objeto->usuario->id,
					STATUS => $objeto->status,
				);

			$listaDeArray[] = $linha;
		}
		return $listaDeArray;
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

		redirect(AndamentoController::ANDAMENTO_CONTROLLER);
	}

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

		redirect(AndamentoController::ANDAMENTO_CONTROLLER);
	}

	/**
	 * @param $id
	 * @return Andamento
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
	 * @return Andamento
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
