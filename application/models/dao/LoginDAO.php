<?php

defined('BASEPATH') or exit('No direct script access allowed');


class LoginDAO extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('dao/DAO');
		$this->load->model('dao/HierarquiaDAO');
		$this->load->model('dao/FuncaoDAO');
		$this->load->model('dao/DepartamentoDAO');
	}

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


}
