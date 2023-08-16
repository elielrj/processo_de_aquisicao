<?php

require_once 'abstract_controller/AbstractController.php';

class ArtefatoController extends AbstractController
{
	const ARTEFATO_CONTROLLER = 'ArtefatoController';

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

		$this->load->library('CriadorDeBotoes',
			arrayToCriadorDeBotoes(
				ARTEFATO_CONTROLLER . '/listar',
				$this->contarRegistrosAtivos()
			)
		);

		$this->load->view('index',
			arrayToView(
				'Lista de Artefatos',
				$this->buscarTodosAtivos($qtd_de_itens_para_exibir, $indice_no_data_base),
				'artefato/index.php',
				$this->criadordebotoes->listar($indice) ?? 0
			)
		);
	}

	public function novo()
	{
		$this->load->view(
			'index',
			[
				'titulo' => 'Novo Artefato',
				'pagina' => 'artefato/novo.php'
			]
		);
	}

	public function criar()
	{
		$this->load->model('ArtefatoDAO');

		$array =
			[
				ID => null,
				'ordem' => $this->input->post('ordem'),
				'nome' => $this->input->post('nome'),
				STATUS => true
			];

		$this->load->model('dao/ArtefatoDAO');

		$this->ArtefatoDAO->criar($array);

		redirect(self::ARTEFATO_CONTROLLER);
	}

	public function alterar($id)
	{
		$this->load->view(
			'index',
			[
				'titulo' => 'Alterar Artefato',
				'pagina' => 'artefato/alterar.php',
				'artefato' => $this->buscarPorId($id)
			]
		);
	}

	public function atualizar()
	{
		$array = [
			ID => $this->input->post(ID),
			STATUS => $this->input->post(STATUS),
			NOME => $this->input->post(NOME),
			ORDEM => $this->input->post(ORDEM),
			UG => $this->input->post(UG)
		];

		$this->load->model('dao/ArtefatoDAO');

		$this->ArtefatoDAO->atualizar($array);

		redirect(self::ARTEFATO_CONTROLLER);
	}


	public function contarRegistrosAtivos()
	{
		$this->load->model('dao/ArtefatoDAO');

		return $this->ArtefatoDAO->contarRegistrosAtivos();
	}

	public function contarRegistrosInativos()
	{
		$this->load->model('dao/ArtefatoDAO');

		return $this->ArtefatoDAO->contarRegistrosInativos();
	}

	public function contarTodosOsRegistros()
	{
		$this->load->model('dao/ArtefatoDAO');

		return $this->ArtefatoDAO->contarTodosOsRegistros();
	}

	public function excluirDeFormaPermanente($id)
	{
		$this->load->model('dao/ArtefatoDAO');

		$this->ArtefatoDAO->excluirDeFormaPermanente($id);
	}

	public function excluirDeFormaLogica($id)
	{
		$this->load->model('dao/ArtefatoDAO');

		$this->ArtefatoDAO->excluirDeFormaLogica($id);
	}

	public function options()
	{
		$this->load->model('dao/ArtefatoDAO');

		return $this->ArtefatoDAO->options();
	}

	public function buscarPorId($id)
	{
		$this->load->model('dao/ArtefatoDAO');

		$array = $this->ArtefatoDAO->BuscarPorId($id);

		return $this->toObject($array);
	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		$this->load->model('dao/ArtefatoDAO');

		$array = $this->ArtefatoDAO->buscarTodosAtivos($inicio, $fim);

		return $this->toObject($array);
	}

	public function buscarTodosInativos($inicio, $fim)
	{
		$this->load->model('dao/ArtefatoDAO');

		$array = $this->ArtefatoDAO->buscarTodosInativos($inicio, $fim);

		return $this->toObject($array);
	}

	public function buscarTodosStatus($inicio, $fim)
	{
		$this->load->model('dao/ArtefatoDAO');

		$array = $this->ArtefatoDAO->buscarTodosStatus($inicio, $fim);

		return $this->toObject($array);
	}

	public function buscarAonde($inicio, $fim, $where)
	{
		$this->load->model('dao/ArtefatoDAO');

		$array = $this->ArtefatoDAO->buscarAonde($inicio, $fim, $where);

		return $this->toObject($array);
	}

	public function contarTodosOsRegistrosAonde($where)
	{
		$this->load->model('dao/ArtefatoDAO');
		return $this->ArtefatoDAO->contarTodosOsRegistrosAonde($where);
	}

	public function recuperar($id)
	{
		$this->load->model('dao/ArtefatoDAO');

		$this->ArtefatoDAO->recuperar($id);

		redirect(self::ARTEFATO_CONTROLLER . '/listar');
	}
}
