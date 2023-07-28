<?php

class UgController extends CI_Controller
{

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

	public function array()
	{
		return array(
			'id' => $this->id,
			'nome' => $this->nome,
			'nivel_de_acesso' => $this->nivelDeAcesso->nome(),
			'status' => $this->status
		);
	}
}
