<?php
defined('BASEPATH') or exit('No direct script access allowed');


class AndamentoController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('dao/AndamentoDAO');
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

		$andamentos = $this->AndamentoDAO->buscarTodosStatus($qtd_de_itens_para_exibir, $indice_no_data_base);

		$this->load->library(
			'CriadorDeBotoes',
			[
				'controller' => ANDAMENTO_CONTROLLER . '/listar',
				'quantidade_de_registros_no_banco_de_dados' => $this->AndamentoDAO->contarTodosOsRegistros()
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

	public function criar()
	{
		$andamento = new Andamento(
			null,
			$this->input->post(STATUS_DO_ANDAMENTO),
			$this->input->post(DATA_HORA),
			$this->input->post(PROCESSO_ID),
			$_SESSION[ID],
			true//todo
		);

		$this->AndamentoDAO->criar($andamento);

		redirect(ANDAMENTO_CONTROLLER);
	}

	public function atualizar()
	{
		$andamento = new Andamento(
			$this->input->post(ID),
			$this->input->post(STATUS_DO_ANDAMENTO),
			new Tempo($this->input->post(DATA_HORA)),
			$this->input->post(PROCESSO_ID),
			$_SESSION[ID],
			true//todo
		);

		$this->AndamentoDAO->atualizar($andamento);

		redirect(ANDAMENTO_CONTROLLER);
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
	public function toObject($linhaDoArrayList)
	{
		$id = $linhaDoArrayList->id ?? $linhaDoArrayList[ID] ?? null;
		$statusDoAndamento = $linhaDoArrayList->status_do_andamento ?? $linhaDoArrayList[STATUS_DO_ANDAMENTO] ?? null;
		$data_hora = $linhaDoArrayList->data_hora ?? $linhaDoArrayList[DATA_HORA] ?? null;
		$processo_id = $linhaDoArrayList->processo_id ?? $linhaDoArrayList[PROCESSO_ID] ?? null;
		$usuario_id = $linhaDoArrayList->usuario_id ?? $linhaDoArrayList[USUARIO_ID] ?? null;
		$status = $linhaDoArrayList->status ?? $linhaDoArrayList[STATUS] ?? null;

		$this->load->library('DataHora', $data_hora);

		$this->load->model('dao/UsuarioDAO');

		return
			new Andamento(
				$id,
				Andamento::selecionarStatus($statusDoAndamento),
				$this->datahora,
				$processo_id,
				$this->UsuarioDAO->buscarPorId($usuario_id),
				$status
			);
	}

	public function toArray($objeto)
	{
		return
			array(
				ID => $objeto->id ?? null,
				STATUS_DO_ANDAMENTO => $objeto->statusDoAndamento->nome(),
				DATA_HORA => $objeto->dataHora,
				PROCESSO_ID => $objeto->processo_id,
				USUARIO_ID => $objeto->usuario->id,
				STATUS => $objeto->status,
			);
	}
}
