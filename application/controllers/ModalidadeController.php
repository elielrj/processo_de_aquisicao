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

		$this->ModalidadeDAO->criar($array);

		redirect(self::MODALIDADE_CONTROLLER);
	}

	public function alterar($id)
	{

		$modalidade = $this->ModalidadeDAO->buscarId($id);

		$dados = [
			'titulo' => 'Alterar modalidade',
			'pagina' => 'modalidade/alterar.php',
			'modalidade' => $modalidade
		];

		$this->load->view('index', $dados);
	}

	public function atualizar()
	{

		$data_post = $this->input->post();

		$modalidade = new Modalidade(
			$data_post['id'],
			$data_post['nome'],
			$data_post['status']
		);

		$this->ModalidadeDAO->atualizar($modalidade);

		redirect('ModalidadeController');
	}

	public function deletar($id)
	{

		$this->ModalidadeDAO->deletar($id);

		redirect('ModalidadeController');
	}

	private function toObject($arrayList)
	{
		return new Modalidade(
			$arrayList->id ?? ($arrayList['id'] ?? null),
			$arrayList->nome ?? ($arrayList['nome'] ?? null),
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
