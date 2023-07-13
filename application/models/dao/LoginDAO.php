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
		$array = $this->DAO->buscarOnde(TABLE_USUARIO, array('email' => $email));

		return ($array->num_rows() == 1);
	}

	public function senhaEstaCorreta($email, $senha)
	{
		$array = $this->DAO->buscarOnde(TABLE_USUARIO, array('email' => $email, 'senha' => $senha));

		return ($array->num_rows() == 1);
	}

	public function buscarDadosDoUsuarioLogado($email, $senha)
	{
		$where = array('email' => $email, 'senha' => $senha);

		$array = $this->DAO->buscarOnde(TABLE_USUARIO, $where);

		foreach ($array->result() as $linha) {

			$this->session->set_userdata(
				array(
					'id' => $linha->id,
					'nome_de_guerra' => $linha->nome_de_guerra,
					'nome_completo' => $linha->nome_completo,
					'email' => $linha->email,
					'cpf' => $linha->cpf,
					'senha' => $linha->senha,
					'departamento_id' => $linha->departamento_id,
					'departamento_nome' => ($this->DepartamentoDAO->buscarPorId($linha->departamento_id))->sigla,
					'status' => $linha->status,
					'hierarquia_id' => $linha->hierarquia_id,
					'funcao_id' => $linha->funcao_id,
					'hierarquia_sigla' => ($this->HierarquiaDAO->buscarPorId($linha->hierarquia_id)->sigla),
					'funcao_nivel_de_acesso' => ($this->FuncaoDAO->buscarPorId($linha->funcao_id)->nivelDeAcesso->nome()),
				)
			);
		}
	}


}
