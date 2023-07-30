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
		$this->load->view('index', [
			'titulo' => 'Novo Artefato',
			'pagina' => 'artefato/novo.php'
		]);
	}

	public function criar()
	{

		$data_post = $this->input->post();

		$artefato = new Artefato(
			null,
			$data_post['ordem'],
			$data_post['nome'],
			$data_post['status']
		);

		$this->ArtefatoDAO->create($artefato);

		redirect('ArtefatoController');
	}

	public function alterar($id)
	{

		$artefato = $this->ArtefatoDAO->buscarPorId($id);

		$dados = [
			'titulo' => 'Alterar Artefato',
			'pagina' => 'artefato/alterar.php',
			'artefato' => $artefato
		];

		$this->load->view('index', $dados);
	}

	public function atualizar()
	{

		$data_post = $this->input->post();

		$artefato = new Artefato(
			$data_post['id'],
			$data_post['ordem'],
			$data_post['nome'],
			$data_post['status']
		);

		$this->ArtefatoDAO->atualizar($artefato);

		redirect('ArtefatoController');
	}

	public function deletar($id)
	{

		$this->ArtefatoDAO->delete($id);

		redirect('ArtefatoController');
	}

	public function toObject($arrayList)
	{
		return new Artefato(
			$arrayList->id,
			$arrayList->ordem,
			$arrayList->nome,
			null,
			$arrayList->status
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
