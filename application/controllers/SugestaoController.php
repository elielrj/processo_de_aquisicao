<?php

require_once 'abstract_controller/AbstractController.php';

class SugestaoController extends AbstractController
{
	const SUGESTAO_CONTROLLER = 'SugestaoController';

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

		$sugestoes = $this->SugestaoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base);

		$params = [
			'controller' => SUGESTAO_CONTROLLER . '/listar',
			'quantidade_de_registros_no_banco_de_dados' => $this->SugestaoDAO->contar()
		];


		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($sugestoes) ? '' : $this->criadordebotoes->listar($indice);


		$dados = array(
			'titulo' => 'Lista de Sugestões',
			'tabela' => $sugestoes,
			'pagina' => 'sugestao/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);
	}

	public function novo()
	{
		$dados = array(
			'titulo' => 'Sugestão para o sistema',
			'pagina' => 'sugestao/novo.php',
		);

		$this->load->view('index', $dados);
	}

	public function criar()
	{
		$data_post = $this->input->post();

		$sugestao = new Sugestao(
			null,
			$data_post['mensagem'],
			false,
			$_SESSION['id']
		);

		$this->SugestaoDAO->criar($sugestao);

		redirect('processo-listar');
	}

	public function alterar($id)
	{

		$sugestao = $this->SugestaoDAO->buscarPorId($id);

		$dados = array(
			'titulo' => 'Alterar Tipo de Licitação',
			'pagina' => 'sugestao/alterar.php',
			'sugestao' => $sugestao,
		);

		$this->load->view('index', $dados);

	}

	public function atualizar()
	{

		$data_post = $this->input->post();

		$sugestao = new Sugestao(
			$data_post['id'],
			$data_post['mensagem'],
			$data_post['status'],
			$data_post['usuario_id']
		);

		$this->SugestaoDAO->update($sugestao);

		redirect(SugestaoController::$controller);
	}

	public function deletar($id)
	{
		$sugestaoDeLicitcao = $this->SugestaoDAO->buscarPorId($id);

		$this->SugestaoDAO->deletar($sugestaoDeLicitcao);

		redirect(SugestaoController::$controller);
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

	public function contarTodosOsRegistrosAonde($where)
	{
		// TODO: Implement contarTodosOsRegistrosAonde() method.
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

	public function recuperar($id)
	{
		// TODO: Implement recuperar() method.
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

	public function buscarAonde($inicio, $fim, $where)
	{
		// TODO: Implement buscarAonde() method.
	}
}
