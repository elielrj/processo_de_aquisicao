<?php

require_once 'abstract_controller/AbstractController.php';

class UgController extends AbstractController
{
	const UG_CONTROLLER = 'UgController';

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

		$ugs = $this->UgDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base);

		$params = [
			'controller' => 'UgController/listar',
			'quantidade_de_registros_no_banco_de_dados' => $this->UgDAO->contar()
		];


		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($ugs) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de UG',
			'tabela' => $ugs,
			'pagina' => 'ug/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);
	}

	public function novo()
	{
		$dados = array(
			'titulo' => 'Nova UG',
			'pagina' => 'ug/novo.php'
		);

		$this->load->view('index', $dados);
	}

	public function criar()
	{
		$ug = new Ug(
			null,
			$this->input->post('numero'),
			$this->input->post('nome'),
			$this->input->post('sigla'),
			$this->input->post('status')
		);

		$this->UgDAO->criar($ug);

		redirect('UgController');
	}

	public function toObject($arrayList)
	{
		return new Ug(
			$arrayList->id ?? ($arrayList['id'] ?? null),
			$arrayList->numero ?? ($arrayList['numero'] ?? null),
			$arrayList->nome ?? ($arrayList['nome'] ?? null),
			$arrayList->sigla ?? ($arrayList['sigla'] ?? null),
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

	public function alterar($id)
	{
		// TODO: Implement alterar() method.
	}

	public function atualizar()
	{
		// TODO: Implement atualizar() method.
	}
}
