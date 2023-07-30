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

		$dados = array(
			'titulo' => 'Nova Seção',
			'pagina' => 'departamento/novo.php',
			'ugs' => $this->UgDAO->options()
		);

		$this->load->view('index', $dados);
	}

	public function criar()
	{
		$data_post = $this->input->post();

		$this->load->model('UgDAO');

		$departamento = new Departamento(
			null,
			$data_post['nome'],
			$data_post['sigla'],
			$this->UgDAO->buscarPorId($data_post['ug']),
			true
		);

		$this->DepartamentoDAO->criar($departamento);

		redirect('DepartamentoController');
	}

	public function alterar($id)
	{

		$departamento = $this->DepartamentoDAO->buscarPorId($id);


		$dados = array(
			'titulo' => 'Alterar Seção',
			'pagina' => 'departamento/alterar.php',
			'departamento' => $departamento,
			'ugs' => $this->UgDAO->options()
		);

		$this->load->view('index', $dados);
	}

	public function atualizar()
	{

		$data_post = $this->input->post();

		$departamento = new Departamento(
			$data_post['id'],
			$data_post['nome'],
			$data_post['sigla'],
			$this->UgDAO->buscarPorId($data_post['ug']),
			$data_post['status']
		);

		$this->DepartamentoDAO->atualizar($departamento);

		redirect('DepartamentoController');
	}

	public function deletar($id)
	{
		$this->DepartamentoDAO->deletar($id);

		redirect('DepartamentoController');
	}

	public function toObject($arrayList)
	{
		return new Departamento(
			$arrayList->id ?? ($arrayList['id'] ?? null),
			$arrayList->nome ?? ($arrayList['nome'] ?? null),
			$arrayList->sigla ?? ($arrayList['sigla'] ?? null),
			isset($arrayList->ug_id)
				? $this->UgDAO->buscarPorId($arrayList->ug_id)
				: (isset($arrayList['ug_id']) ? $this->UgDAO->buscarPorId($arrayList['ug_id']) : null),
			$arrayList->status ?? ($arrayList['status'] ?? null)
		);
	}

	public function contarRegistrosAtivos()
	{
		// TODO: Implement contarRegistrosAtivos() method.
	}

	public function contarRegistrosInativos()
	{
		// TODO: Implement contarRegistrosInativos() method.
	}

	public function contarTodosOsRegistros()
	{
		// TODO: Implement contarTodosOsRegistros() method.
	}

	public function excluirDeFormaPermanente($id)
	{
		// TODO: Implement excluirDeFormaPermanente() method.
	}

	public function excluirDeFormaLogica($id)
	{
		// TODO: Implement excluirDeFormaLogica() method.
	}

	public function options()
	{
		// TODO: Implement options() method.
	}

	public function buscarPorId($id)
	{
		// TODO: Implement buscarPorId() method.
	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		// TODO: Implement buscarTodosAtivos() method.
	}

	public function buscarTodosInativos($inicio, $fim)
	{
		// TODO: Implement buscarTodosInativos() method.
	}

	public function buscarTodosStatus($inicio, $fim)
	{
		// TODO: Implement buscarTodosStatus() method.
	}

	public function buscarAonde($where)
	{
		// TODO: Implement buscarAonde() method.
	}

	public function contarTodosOsRegistrosAonde($where)
	{
		// TODO: Implement contarTodosOsRegistrosAonde() method.
	}

	public function recuperar($id)
	{
		// TODO: Implement recuperar() method.
	}
}
