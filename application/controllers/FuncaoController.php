<?php

require_once 'abstract_controller/AbstractController.php';

class FuncaoController extends AbstractController
{
	const FUNCAO_CONTROLLER = 'FuncaoController';

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

		$funcoes = $this->buscarTodosStatus($qtd_de_itens_para_exibir, $indice_no_data_base);

		$this->load->library(
			'CriadorDeBotoes',
			[
				'controller' => FuncaoController::FUNCAO_CONTROLLER . '/listar',
				'quantidade_de_registros_no_banco_de_dados' => $this->contarTodosOsRegistros()
			]);

		$botoes = empty($funcoes) ? '' : $this->criadordebotoes->listar($indice);

		$this->load->view(
			'index',
			[
				'titulo' => 'Lista de andamentos',
				'tabela' => $funcoes,
				'pagina' => 'funcao/index.php',
				'botoes' => $botoes
			]);
	}

	public function novo()
	{

	}

	public function criar()
	{

	}

	private function toObject($arrayList)
	{
		return new Funcao(
			isset($arrayList->id)
				? $arrayList->id
				: (isset($arrayList['id']) ? $arrayList['id'] : null),
			isset($arrayList->nome)
				? $arrayList->nome
				: (isset($arrayList['nome']) ? $arrayList['nome'] : null),
			isset($arrayList->nivel_de_acesso)
				? Funcao::selecionarNivelDeAcesso($arrayList->nivel_de_acesso)
				: (isset($arrayList['nivel_de_acesso']) ? Funcao::selecionarNivelDeAcesso($arrayList['nivel_de_acesso']) : null),
			isset($arrayList->status)
				? $arrayList->status
				: (isset($arrayList['status']) ? $arrayList['status'] : null)
		);
	}

}
