<?php

require_once 'abstract_controller/AbstractController.php';

class ModalidadeController extends AbstractController
{
	const MODALIDADE_CONTROLLER = 'ModalidadeController';

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
				self::MODALIDADE_CONTROLLER . '/listar',
				$this->contarRegistrosAtivos()
			)
		);

		$this->load->view('index',
			arrayToView(
				'Lista de modalidades',
				$this->buscarTodosAtivos($qtd_de_itens_para_exibir, $indice_no_data_base) ?? [],
				'modalidade/index.php',
				$this->criadordebotoes->listar($indice) ?? 0
			)
		);
	}

	public function novo()
	{
		$this->load->view(
			'index',
			[
				'titulo' => 'Novo Modalidade',
				'pagina' => 'modalidade/novo.php'
			]
		);
	}

	public function criar()
	{
		$array =
			[
				ID => true,
				NOME => $this->input->post('nome'),
				STATUS => $this->input->post('status')
			];
		$this->load->model('dao/ModalidadeDAO');

		$this->ModalidadeDAO->criar($array);

		redirect(self::MODALIDADE_CONTROLLER);
	}

	public function alterar($id)
	{
		$this->load->view(
			'index',
			[
				'titulo' => 'Alterar modalidade',
				'pagina' => 'modalidade/alterar.php',
				'modalidade' => $this->buscarPorId($id)
			]
		);
	}

	public function atualizar()
	{
		$array =
			[
				ID => $this->input->post(ID),
				NOME => $this->input->post(NOME),
				STATUS => $this->input->post(STATUS)
			];

		$this->ModalidadeDAO->atualizar($array);

		redirect(self::MODALIDADE_CONTROLLER);
	}



	public function contarRegistrosAtivos()
	{
		$this->load->model('dao/ModalidadeDAO');

		return $this->ModalidadeDAO->contarRegistrosAtivos();
	}

	public function contarRegistrosInativos()
	{
		$this->load->model('dao/ModalidadeDAO');

		return $this->ModalidadeDAO->contarRegistrosInativos();
	}

	public function contarTodosOsRegistros()
	{
		$this->load->model('dao/ModalidadeDAO');

		return $this->ModalidadeDAO->contarTodosOsRegistros();
	}

	public function excluirDeFormaPermanente($id)
	{
		$this->load->model('dao/ModalidadeDAO');

		$this->ModalidadeDAO->excluirDeFormaPermanente($id);
	}

	public function excluirDeFormaLogica($id)
	{
		$this->load->model('dao/ModalidadeDAO');

		$this->ModalidadeDAO->excluirDeFormaLogica($id);	}

	public function options()
	{
		$this->load->model('dao/ModalidadeDAO');

		return $this->ModalidadeDAO->options();	}

	public function buscarPorId($id)
	{
		$this->load->model('dao/ModalidadeDAO');

		$array = $this->ModalidadeDAO->BuscarPorId($id);

		return $this->toObject($array);	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		$this->load->model('dao/ModalidadeDAO');

		$array = $this->ModalidadeDAO->buscarTodosAtivos($inicio, $fim);

		return $this->toObject($array);	}

	public function buscarTodosInativos($inicio, $fim)
	{
		$this->load->model('dao/ModalidadeDAO');

		$array = $this->ModalidadeDAO->buscarTodosInativos($inicio, $fim);

		return $this->toObject($array);	}

	public function buscarTodosStatus($inicio, $fim)
	{
		$this->load->model('dao/ModalidadeDAO');

		$array = $this->ModalidadeDAO->buscarTodosStatus($inicio, $fim);

		return $this->toObject($array);	}

	public function buscarAonde($inicio, $fim, $where)
	{
		$this->load->model('dao/ModalidadeDAO');

		$array = $this->ModalidadeDAO->buscarAonde($inicio, $fim, $where);

		return $this->toObject($array);
	}

	public function contarTodosOsRegistrosAonde($where)
	{
		$this->load->model('dao/ModalidadeDAO');
		return $this->ModalidadeDAO->contarTodosOsRegistrosAonde($where);	}

	public function recuperar($id)
	{
		$this->load->model('dao/ModalidadeDAO');

		$this->ModalidadeDAO->recuperar($id);

		redirect(self::MODALIDADE_CONTROLLER . '/listar');	}
}
