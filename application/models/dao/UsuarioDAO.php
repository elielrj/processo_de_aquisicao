<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Usuario.php');

class UsuarioDAO extends CI_Model
{
	public static  $TABELA_DB = 'usuario';

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
		$this->DAO->criar(self::$TABELA_DB, $usuario->array());
	}

	public function buscarTodos($inicial, $final): array
	{
		$array = $this->DAO->buscarTodos(self::$TABELA_DB, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarTodosDesativados($inicial, $final): array
	{
		$array = $this->DAO->buscarTodosDesativados(self::$TABELA_DB, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($usuarioId): Usuario
	{
		$array = $this->DAO->buscarPorId(self::$TABELA_DB, $usuarioId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value): array
	{
		$array = $this->DAO->buscarOnde(self::$TABELA_DB, array($key => $value));

		return $this->criarLista($array->result());
	}

	public function atualizar($usuario)
	{
		$this->DAO->atualizar(self::$TABELA_DB, $usuario->array());
	}


	public function deletar($usuario_id)
	{
		$usuario = $this->buscarPorId($usuario_id);

		$usuario->status = false;

		$this->DAO->atualizar(self::$TABELA_DB, $usuario->array());
	}

	public function contar()
	{
		return $this->DAO->contar(self::$TABELA_DB);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(self::$TABELA_DB);
	}

	public function toObject($arrayList): Usuario
	{
		return new Usuario(
			$arrayList->id ?? ($arrayList['id'] ?? null),
			$arrayList->nome ?? ($arrayList['nome'] ?? null),
			$arrayList->sobrenome ?? ($arrayList['sobrenome'] ?? null),
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

	private function criarLista($array): array
	{
		$listaDeUsuarios = array();

		foreach ($array->result() as $linha) {

			$usuario = $this->toObject($linha);

			$listaDeUsuarios[] = $usuario;
		}

		return $listaDeUsuarios;
	}

}
