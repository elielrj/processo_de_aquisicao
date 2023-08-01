<?php

require_once 'abstract_controller/AbstractController.php';

class DepartamentoController extends AbstractController
{
	const DEPARTAMENTO_CONTROLLER = 'DepartamentoController';

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
				DEPARTAMENTO_CONTROLLER . '/listar',
				$this->contarRegistrosAtivos() ?? 0
			));

		$this->load->view('index',
			[
				arrayToView(
					'Lista de Departamentos',
					$this->buscarTodosAtivos($qtd_de_itens_para_exibir, $indice_no_data_base) ?? [],
					'departamento/index.php',
					$this->criadordebotoes->listar($indice) ?? 0
				)
			]);
	}

	public function novo()
	{
		$this->load->model('dao/UgDAO');

		$dados = array(
			'titulo' => 'Nova Seção',
			'pagina' => 'departamento/novo.php',
			'ugs' => $this->UgDAO->options()
		);

		$this->load->view('index', $dados);
	}

	public function criar()
	{
		$this->load->model('UgDAO');

		$array =
			[
				ID => null,
				'nome' => $this->input->post('nome'),
				'sigla' => $this->input->post('sigla'),
				'ug' => $this->input->post('ug'),
				STATUS => true
			];

		$this->load->model('dao/DepartamentoDAO');

		$this->DepartamentoDAO->criar($array);

		redirect(self::DEPARTAMENTO_CONTROLLER);
	}

	public function alterar($id)
	{
		$this->load->model('dao/UgDAO');

		$this->load->view(
			'index',
			[
				'titulo' => 'Alterar Seção',
				'pagina' => 'departamento/alterar.php',
				'departamento' => $this->buscarPorId($id),
				'ugs' => $this->UgDAO->options()
			]
		);
	}

	public function atualizar()
	{
		$array = [
			ID => $this->input->post(ID),
			STATUS => $this->input->post(STATUS),
			NOME => $this->input->post(NOME),
			SIGLA => $this->input->post(SIGLA),
			UG => $this->input->post(UG)
		];

		$this->load->model('dao/DepartamentoDAO');

		$this->DepartamentoDAO->atualizar($array);

		redirect(self::DEPARTAMENTO_CONTROLLER);
	}

	public function toObject($arrayList)
	{
		$ug_id = $arrayList->ug ?? ($arrayList['ug'] ?? null);

		$this->load->model('dao/UgDAO');

		$ug = $this->UgDAO->buscarPorId($ug_id);

		return new Departamento(
			$arrayList->id ?? ($arrayList['id'] ?? null),
			$arrayList->status ?? ($arrayList['status'] ?? null),
			$arrayList->nome ?? ($arrayList['nome'] ?? null),
			$arrayList->sigla ?? ($arrayList['sigla'] ?? null),
			$ug ?? null
		);
	}

	public function contarRegistrosAtivos()
	{
		$this->load->model('dao/DepartamentoDAO');

		return $this->DepartamentoDAO->contarRegistrosAtivos();
	}

	public function contarRegistrosInativos()
	{
		$this->load->model('dao/DepartamentoDAO');

		return $this->DepartamentoDAO->contarRegistrosInativos();
	}

	public function contarTodosOsRegistros()
	{
		$this->load->model('dao/DepartamentoDAO');

		return $this->DepartamentoDAO->contarTodosOsRegistros();
	}

	public function excluirDeFormaPermanente($id)
	{
		$this->load->model('dao/DepartamentoDAO');

		$this->DepartamentoDAO->excluirDeFormaPermanente($id);
	}

	public function excluirDeFormaLogica($id)
	{
		$this->load->model('dao/DepartamentoDAO');

		$this->DepartamentoDAO->excluirDeFormaLogica($id);
	}

	public function options()
	{
		$this->load->model('dao/DepartamentoDAO');

		return $this->DepartamentoDAO->options();
	}

	public function buscarPorId($id)
	{
		$this->load->model('dao/DepartamentoDAO');

		$array = $this->DepartamentoDAO->BuscarPorId($id);

		return $this->toObject($array);
	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		$this->load->model('dao/DepartamentoDAO');

		$array = $this->DepartamentoDAO->buscarTodosAtivos($inicio, $fim);

		return $this->toObject($array);
	}

	public function buscarTodosInativos($inicio, $fim)
	{
		$this->load->model('dao/DepartamentoDAO');

		$array = $this->DepartamentoDAO->buscarTodosInativos($inicio, $fim);

		return $this->toObject($array);
	}

	public function buscarTodosStatus($inicio, $fim)
	{
		$this->load->model('dao/DepartamentoDAO');

		$array = $this->DepartamentoDAO->buscarTodosStatus($inicio, $fim);

		return $this->toObject($array);
	}

	public function buscarAonde($inicio, $fim, $where)
	{
		$this->load->model('dao/DepartamentoDAO');

		$array = $this->DepartamentoDAO->buscarAonde($inicio, $fim, $where);

		return $this->toObject($array);
	}

	public function contarTodosOsRegistrosAonde($where)
	{
		$this->load->model('dao/DepartamentoDAO');
		return $this->DepartamentoDAO->contarTodosOsRegistrosAonde($where);
	}

	public function recuperar($id)
	{
		$this->load->model('dao/DepartamentoDAO');

		$this->DepartamentoDAO->recuperar($id);

		redirect(self::DEPARTAMENTO_CONTROLLER . '/listar');
	}
}
