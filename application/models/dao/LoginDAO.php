<?php

defined('BASEPATH') or exit('No direct script access allowed');


class LoginDAO extends CI_Model
{

    public static $TABELA_DB = 'usuario';

    public function __construct()
    {
       // parent::__construct();
        $this->load->model('dao/DAO');
    }

    public function emailExiste($email)
    {
        $array = $this->DAO->buscarOnde(LoginDAO::$TABELA_DB, array('email' => $email));

        return ($array->num_rows() == 1);
    }

    public function senhaEstaCorreta($email,$senha)
    {
        $array = $this->DAO->buscarOnde(LoginDAO::$TABELA_DB, array('email' => $email, 'senha' => $senha));

        return ($array->num_rows() == 1);
    }

    public function buscarDadosDoUsuarioLogado($email, $senha)
    {
        $where = array('email' => $email, 'senha' => $senha);

        $array = $this->DAO->buscarOnde(LoginDAO::$TABELA_DB, $where);

        foreach ($array->result() as $linha) {

            $this->session->set_userdata(
                array(
                    'id' => $linha->id,
                    'nome' => $linha->nome,
                    'sobrenome' => $linha->sobrenome,
                    'email' => $linha->email,
                    'cpf' => $linha->cpf,
                    'senha' => $linha->senha,
                    'departamento_id' => $linha->departamento_id,
                    'status' => $linha->status,
                )
            );
        }
    }


}