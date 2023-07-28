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
		return new Hierarquia(
			isset($arrayList->id)
				? $arrayList->id
				: (isset($arrayList['id']) ? $arrayList['id'] : null),
			isset($arrayList->posto_ou_graduacao)
				? $arrayList->posto_ou_graduacao
				: (isset($arrayList['posto_ou_graduacao']) ? $arrayList['posto_ou_graduacao'] : null),
			isset($arrayList->sigla)
				? $arrayList->sigla
				: (isset($arrayList['sigla']) ? $arrayList['sigla'] : null),
			isset($arrayList->status)
				? $arrayList->status
				: (isset($arrayList['status']) ? $arrayList['status'] : null)
		);
	}
}
