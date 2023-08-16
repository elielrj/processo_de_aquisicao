<?php

require_once 'abstract_controller/AbstractController.php';

class FuncaoController extends AbstractController
{
	const FUNCAO_CONTROLLER = 'FuncaoController';

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
				FuncaoController::FUNCAO_CONTROLLER . '/listar',
				$this->contarTodosOsRegistros()
			)
		);

		$this->load->view(
			'index',
			arrayToView(
				'Lista de andamentos',
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
				'titulo' => 'Nova Função',
				'pagina' => 'funcao/novo.php',
			]
		);
	}

	public function criar()
	{
		$array =
			[
				ID => null,
				'descricao' => $this->input->post('descricao'),
				'nivel_de_acesso' => $this->input->post('nivel_de_acesso'),
				STATUS => true
			];

		$this->load->model('dao/FuncaoDAO');

		$this->FuncaoDAO->criar($array);

		redirect(self::FUNCAO_CONTROLLER);
	}

	public function alterar($id)
	{
		$this->load->view(
			'index',
			[
				'titulo' => 'Alterar função',
				'pagina' => 'funcao/alterar.php',
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
				DESCRICAO => $this->input->post(DESCRICAO),
				NIVEL_DE_ACESSO => $this->input->post(NIVEL_DE_ACESSO)
			];

		$this->load->model('dao/FuncaoDAO');

		$this->FuncaoDAO->atualizar($array);

		redirect(self::FUNCAO_CONTROLLER);
	}



	public function contarRegistrosAtivos()
	{
		$this->load->model('dao/FuncaoDAO');

		return $this->FuncaoDAO->contarRegistrosAtivos();
	}

	public function contarRegistrosInativos()
	{
		$this->load->model('dao/FuncaoDAO');

		return $this->FuncaoDAO->contarRegistrosInativos();
	}

	public function contarTodosOsRegistros()
	{
		$this->load->model('dao/FuncaoDAO');

		return $this->FuncaoDAO->contarTodosOsRegistros();
	}

	public function excluirDeFormaPermanente($id)
	{
		$this->load->model('dao/FuncaoDAO');

		$this->FuncaoDAO->excluirDeFormaPermanente($id);	}

	public function excluirDeFormaLogica($id)
	{
		$this->load->model('dao/FuncaoDAO');

		$this->FuncaoDAO->excluirDeFormaLogica($id);	}

	public function options()
	{
		$this->load->model('dao/FuncaoDAO');

		return $this->FuncaoDAO->options();	}

	public function buscarPorId($id)
	{
		$this->load->model('dao/FuncaoDAO');

		$array = $this->FuncaoDAO->BuscarPorId($id);

		return $this->toObject($array);	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		$this->load->model('dao/FuncaoDAO');

		$array = $this->FuncaoDAO->buscarTodosAtivos($inicio, $fim);

		return $this->toObject($array);	}

	public function buscarTodosInativos($inicio, $fim)
	{
		$this->load->model('dao/FuncaoDAO');

		$array = $this->FuncaoDAO->buscarTodosInativos($inicio, $fim);

		return $this->toObject($array);	}

	public function buscarTodosStatus($inicio, $fim)
	{
		$this->load->model('dao/FuncaoDAO');

		$array = $this->FuncaoDAO->buscarTodosStatus($inicio, $fim);

		return $this->toObject($array);	}

	public function buscarAonde($inicio, $fim, $where)
	{
		$this->load->model('dao/FuncaoDAO');

		$array = $this->FuncaoDAO->buscarAonde($inicio, $fim, $where);

		return $this->toObject($array);
	}


	public function contarTodosOsRegistrosAonde($where)
	{
		$this->load->model('dao/FuncaoDAO');
		return $this->FuncaoDAO->contarTodosOsRegistrosAonde($where);	}

	public function recuperar($id)
	{
		$this->load->model('dao/FuncaoDAO');

		$this->FuncaoDAO->recuperar($id);

		redirect(self::FUNCAO_CONTROLLER . '/listar');	}
}
