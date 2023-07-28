<?php

require_once 'AbstractController.php';
class TipoController  extends AbstractController
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('dao/tipoDAO');
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

		$tipos = $this->tipoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base);

		$params = [
			'controller' => 'TipoController/listar',
			'quantidade_de_registros_no_banco_de_dados' => $this->tipoDAO->contar()
		];


		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($tipos) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de Tipos De Licitacões',
			'tabela' => $tipos,
			'pagina' => 'tipo/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);
	}

	public function novo()
	{

		$dados = array(
			'titulo' => 'Novo Tipo de Licitação',
			'pagina' => 'tipo/novo.php',
		);

		$this->load->view('index', $dados);
	}

	public function criar()
	{
		$data_post = $this->input->post();

		$tipo = new Tipo(
			null,
			$data_post['nome'],
			$data_post['status']
		);

		$this->tipoDAO->create($tipo);

		redirect('TipoController');
	}

	public function alterar($id)
	{

		$tipo = $this->tipoDAO->buscarPorId($id);

		$dados = array(
			'titulo' => 'Alterar Tipo de Licitação',
			'pagina' => 'tipo/alterar.php',
			'tipo' => $tipo,
		);

		$this->load->view('index', $dados);

	}

	public function atualizar()
	{

		$data_post = $this->input->post();

		$tipo = new Tipo(
			$data_post['id'],
			$data_post['nome'],
			$data_post['status']
		);

		$this->tipoDAO->update($tipo);

		redirect('TipoController');
	}

	public function deletar($id)
	{
		$tipoDeLicitcao = $this->tipoDAO->buscarPorId($id);

		$this->tipoDAO->deletar($tipoDeLicitcao);

		redirect('TipoController');
	}
	public function array()
	{
		return array(
			'id' => $this->id ?? null,
			'nome' => $this->nome,
			'status' => $this->status
		);
	}
	private function toObject($arrayList)
	{
		return new Tipo(
			$arrayList->id ?? ($arrayList['id'] ?? null),
			$arrayList->nome ?? ($arrayList['nome'] ?? null),
			$arrayList->status ?? ($arrayList['status'] ?? null)
		);
	}
}
