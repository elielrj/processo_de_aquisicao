<?php

require_once 'abstract_controller/AbstractController.php';

class TipoController extends AbstractController
{
	const TIPO_CONTROLLER = 'TipoController';

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
