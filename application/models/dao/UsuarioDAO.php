<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once 'InterfaceDAO.php';

class UsuarioDAO extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('dao/DAO');
		$this->load->model('dao/DepartamentoDAO');
		$this->load->model('dao/FuncaoDAO');
		$this->load->model('dao/HierarquiaDAO');
	}

	public function criar($usuario)
	{
		$this->DAO->criar(TABLE_USUARIO, $usuario->array());
	}

	public function buscarTodos($inicial, $final)
	{
		$array = $this->DAO->buscarTodos(TABLE_USUARIO, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarTodosDesativados($inicial, $final)
	{
		$array = $this->DAO->buscarTodosDesativados(TABLE_USUARIO, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($usuarioId)
	{
		$array = $this->DAO->buscarPorId(TABLE_USUARIO, $usuarioId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(TABLE_USUARIO, array($key => $value));

		return $this->criarLista($array->result());
	}

	public function atualizar($usuario)
	{
		$this->DAO->atualizar(TABLE_USUARIO, $usuario->array());
	}


	public function deletar($usuario_id)
	{
		$usuario = $this->buscarPorId($usuario_id);

		$usuario->status = false;

		$this->DAO->atualizar(TABLE_USUARIO, $usuario->array());
	}

	public function contar()
	{
		return $this->DAO->contar(TABLE_USUARIO);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(TABLE_USUARIO);
	}

	public function toObject($arrayList)
	{
		return new Usuario(
			$arrayList->id ?? ($arrayList['id'] ?? null),
			$arrayList->nome_de_guerra ?? ($arrayList['nome_de_guerra'] ?? null),
			$arrayList->nome_completo ?? ($arrayList['nome_completo'] ?? null),
			$arrayList->email ?? ($arrayList['email'] ?? null),
			$arrayList->cpf ?? ($arrayList['cpf'] ?? null),
			$arrayList->senha ?? ($arrayList['senha'] ?? null),
			isset($arrayList->departamento_id)
				? ($this->DepartamentoDAO->buscarPorId($arrayList->departamento_id))
				: (isset($arrayList['departamento_id']) ? $this->DepartamentoDAO->buscarPorId($arrayList['departamento_id']) : null),
			$arrayList->status ?? ($arrayList['status'] ?? null),
			isset($arrayList->hierarquia_id)
				? $this->HierarquiaDAO->buscarPorId($arrayList->hierarquia_id)
				: (isset($arrayList['hierarquia_id']) ? $this->HierarquiaDAO->buscarPorId($arrayList['hierarquia_id']) : null),
			isset($arrayList->funcao_id)
				? $this->FuncaoDAO->buscarPorId($arrayList->funcao_id)
				: (isset($arrayList['funcao_id']) ? $this->FuncaoDAO->buscarPorId($arrayList['funcao_id']) : null)
		);
	}

	private function criarLista($array)
	{
		$listaDeUsuarios = array();

		foreach ($array->result() as $linha) {

			$usuario = $this->toObject($linha);

			$listaDeUsuarios[] = $usuario;
		}

		return $listaDeUsuarios;
	}

}
