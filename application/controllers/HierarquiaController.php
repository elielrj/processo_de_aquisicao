<?php

require_once 'abstract_controller/AbstractController.php';

class HierarquiaController extends AbstractController
{
	const HIERARQUIA_CONTROLLER = 'HierarquiaController';

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
				HierarquiaController::HIERARQUIA_CONTROLLER . '/listar',
				$this->contarTodosOsRegistros()
			)
		);

		$this->load->view(
			'index',
			arrayToView(
				'Lista de hierarquias',
				$this->buscarTodosStatus($qtd_de_itens_para_exibir, $indice_no_data_base) ?? [],
				'funcao/index.php',
				$this->criadordebotoes->listar($indice)
			)
		);
	}

	public function novo()
	{
		$this->load->view(
			'index',
			[
				'titulo' => 'Nova Hierarquia',
				'pagina' => 'hierarquia/novo.php',
			]
		);
	}

	public function criar()
	{
		$array =
			[
				ID => null,
				'posto_ou_graducao' => $this->input->post('posto_ou_graducao'),
				'sigla' => $this->input->post('sigla'),
				STATUS => true
			];

		$this->load->model('dao/HierarquiaDAO');

		$this->HierarquiaDAO->criar($array);

		redirect(self::HIERARQUIA_CONTROLLER);
	}

	public function alterar($id)
	{
		$this->load->view(
			'index',
			[
				'titulo' => 'Alterar hierarquia',
				'pagina' => 'hierarquia/alterar.php',
				'modalidade' => $this->buscarPorId($id)
			]
		);
	}

	public function atualizar()
	{
		$array =
			[
				ID => $this->input->post(ID),
				STATUS => $this->input->post(STATUS),
				POSTO_OU_GRADUACAO => $this->input->post(POSTO_OU_GRADUACAO),
				SIGLA => $this->input->post(SIGLA)
			];

		$this->load->model('dao/HierarquiaDAO');

		$this->HierarquiaDAO->atualizar($array);

		redirect(self::HIERARQUIA_CONTROLLER);
	}



	public function contarRegistrosAtivos()
	{
		$this->load->model('dao/HierarquiaDAO');

		return $this->HierarquiaDAO->contarRegistrosAtivos();
	}

	public function contarRegistrosInativos()
	{
		$this->load->model('dao/HierarquiaDAO');

		return $this->HierarquiaDAO->contarRegistrosInativos();
	}

	public function contarTodosOsRegistros()
	{
		$this->load->model('dao/HierarquiaDAO');

		return $this->HierarquiaDAO->contarTodosOsRegistros();
	}

	public function excluirDeFormaPermanente($id)
	{
		$this->load->model('dao/HierarquiaDAO');

		$this->HierarquiaDAO->excluirDeFormaPermanente($id);	}

	public function excluirDeFormaLogica($id)
	{
		$this->load->model('dao/HierarquiaDAO');

		$this->HierarquiaDAO->excluirDeFormaLogica($id);	}

	public function options()
	{
		$this->load->model('dao/HierarquiaDAO');

		return $this->HierarquiaDAO->options();	}

	public function buscarPorId($id)
	{
		$this->load->model('dao/HierarquiaDAO');

		$array = $this->HierarquiaDAO->BuscarPorId($id);

		return $this->toObject($array);	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		$this->load->model('dao/HierarquiaDAO');

		$array = $this->HierarquiaDAO->buscarTodosAtivos($inicio, $fim);

		return $this->toObject($array);	}

	public function buscarTodosInativos($inicio, $fim)
	{
		$this->load->model('dao/HierarquiaDAO');

		$array = $this->HierarquiaDAO->buscarTodosInativos($inicio, $fim);

		return $this->toObject($array);	}

	public function buscarTodosStatus($inicio, $fim)
	{
		$this->load->model('dao/HierarquiaDAO');

		$array = $this->HierarquiaDAO->buscarTodosStatus($inicio, $fim);

		return $this->toObject($array);	}

	public function buscarAonde($inicio, $fim, $where)
	{
		$this->load->model('dao/HierarquiaDAO');

		$array = $this->HierarquiaDAO->buscarAonde($inicio, $fim, $where);

		return $this->toObject($array);
	}


	public function contarTodosOsRegistrosAonde($where)
	{
		$this->load->model('dao/HierarquiaDAO');
		return $this->HierarquiaDAO->contarTodosOsRegistrosAonde($where);	}

	public function recuperar($id)
	{
		$this->load->model('dao/HierarquiaDAO');

		$this->HierarquiaDAO->recuperar($id);

		redirect(self::HIERARQUIA_CONTROLLER . '/listar');	}
}
