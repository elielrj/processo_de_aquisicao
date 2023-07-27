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

	/**
	 * Login
	 */
	public function emailExiste($email)
	{
		$array = $this->DAO->buscarOnde(TABLE_USUARIO, array(EMAIL => $email));

		return ($array->num_rows() == 1);
	}

	public function senhaEstaCorreta($email, $senha)
	{
		$array = $this->DAO->buscarOnde(TABLE_USUARIO, array(EMAIL => $email, SENHA => $senha));

		return ($array->num_rows() == 1);
	}

	public function buscarDadosDoUsuarioLogado($email, $senha)
	{
		$where = array(EMAIL => $email, SENHA => $senha);

		$array = $this->DAO->buscarOnde(TABLE_USUARIO, $where);

		foreach ($array->result() as $linha) {

			$this->session->set_userdata(
				array(
					SESSION_ID => $linha->id,
					SESSION_NOME_DE_GUERRA => $linha->nome_de_guerra,
					SESSION_NOME_COMPLETO => $linha->nome_completo,
					SESSION_EMAIL => $linha->email,
					SESSION_CPF => $linha->cpf,
					SESSION_SENHA => $linha->senha,
					SESSION_DEPARTAMENTO_ID => $linha->departamento_id,
					SESSION_DEPARTAMENTO_NOME => ($this->DepartamentoDAO->buscarPorId($linha->departamento_id))->sigla,
					SESSION_STATUS => $linha->status,
					SESSION_HIERARQUIA_ID => $linha->hierarquia_id,
					SESSION_FUNCAO_ID => $linha->funcao_id,
					SESSION_HIERARQUIA_SIGLA => ($this->HierarquiaDAO->buscarPorId($linha->hierarquia_id)->sigla),
					SESSION_FUNCAO_NIVEL_DE_ACESSO => ($this->FuncaoDAO->buscarPorId($linha->funcao_id)->nivelDeAcesso->nome()),
				)
			);
		}
	}


	public function array()
	{
		return array(
			'id' => $this->id ?? null,
			'nome_de_guerra' => $this->nomeDeGuerra,
			'nome_completo' => $this->nomeCompleto,
			'email' => $this->email,
			'cpf' => $this->cpf,
			'senha' => $this->senha,
			'departamento_id' => $this->departamento->id,
			'status' => $this->status,
			'hierarquia_id' => $this->hierarquia->id,
			'funcao_id' => $this->funcao->id,
		);
	}
}
