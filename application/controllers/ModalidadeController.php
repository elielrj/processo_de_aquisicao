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

		$modalidades = $this->ModalidadeDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base);

		$params = [
			'controller' => MODALIDADE_CONTROLLER . '/listar',
			'quantidade_de_registros_no_banco_de_dados' => $this->ModalidadeDAO->contar()
		];


		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($modalidades) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de modalidades',
			'tabela' => $modalidades,
			'pagina' => 'modalidade/index.php',
			'botoes' => $botoes,
		);
		$this->load->view('index', $dados);
	}

	public function novo()
	{
		$this->load->view('index', [
			'titulo' => 'Novo Modalidade',
			'pagina' => 'modalidade/novo.php'
		]);
	}

	public function criar()
	{

		$data_post = $this->input->post();

		$modalidade = new Modalidade(
			null,
			$data_post['nome'],
			$data_post['status']
		);

		$this->ModalidadeDAO->criar($modalidade);

		redirect('ModalidadeController');
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

}
