<?php

require_once 'abstract_controller/AbstractController.php';

class HierarquiaController extends AbstractController
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

	public function alterar($id)
	{
		// TODO: Implement alterar() method.
	}

	public function atualizar()
	{
		// TODO: Implement atualizar() method.
	}

	public function contarTodosOsRegistrosAonde($where)
	{
		// TODO: Implement contarTodosOsRegistrosAonde() method.
	}
}
