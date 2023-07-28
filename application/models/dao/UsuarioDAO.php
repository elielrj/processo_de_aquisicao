<?php

require_once 'AbstractDAO.php';

class UsuarioDAO  extends AbstractDAO
{
	const TABELA_USUARIO = 'usuario';

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
		$this->DAO->criar(UsuarioDAO::TABELA_USUARIO, $usuario->array());
	}

	public function buscarTodos($inicial, $final)
	{
		$array = $this->DAO->buscarTodos(UsuarioDAO::TABELA_USUARIO, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarTodosDesativados($inicial, $final)
	{
		$array = $this->DAO->buscarTodosDesativados(UsuarioDAO::TABELA_USUARIO, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($usuarioId)
	{
		$array = $this->DAO->buscarPorId(UsuarioDAO::TABELA_USUARIO, $usuarioId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(UsuarioDAO::TABELA_USUARIO, array($key => $value));

		return $this->criarLista($array->result());
	}

	public function atualizar($usuario)
	{
		$this->DAO->atualizar(UsuarioDAO::TABELA_USUARIO, $usuario->array());
	}


	public function deletar($usuario_id)
	{
		$usuario = $this->buscarPorId($usuario_id);

		$usuario->status = false;

		$this->DAO->atualizar(UsuarioDAO::TABELA_USUARIO, $usuario->array());
	}

	public function contar()
	{
		return $this->DAO->contar(TABELA_USUARIO);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(TABELA_USUARIO);
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
		$array = $this->DAO->buscarOnde(UsuarioDAO::TABELA_USUARIO, array(EMAIL => $email));

		return ($array->num_rows() == 1);
	}

	public function senhaEstaCorreta($email, $senha)
	{
		$array = $this->DAO->buscarOnde(UsuarioDAO::TABELA_USUARIO, array(EMAIL => $email, SENHA => $senha));

		return ($array->num_rows() == 1);
	}

	public function buscarDadosDoUsuarioLogado($email, $senha)
	{
		$where = array(EMAIL => $email, SENHA => $senha);

		$array = $this->DAO->buscarOnde(UsuarioDAO::TABELA_USUARIO, $where);

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



}
