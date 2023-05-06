<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/models/bo/Login.php');

class LoginDAO extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function emailExiste($email)
    {
        $where = array('email' => $email);

        $resultado = $this->db->get_where('usuario', $where);

        return ($resultado->num_rows() == 1);
    }

    public function senhaEstaCorreta($email, $senha)
    {
        $where = array('email' => $email, 'senha' => md5($senha));

        $resultado = $this->db->get_where('usuario', $where);

        return ($resultado->num_rows() == 1);
    }

    public function buscarDadosDoUsuarioLogado($email, $senha)
    {
        $where = array('email' => $email, 'senha' => md5($senha));

        $resultado = $this->db->get_where('usuario', $where);

        foreach ($resultado->result() as $linha) {

            $this->session->set_userdata(
                array(
                    'id' => $linha->id,
                    'nome' => $linha->nome,
                    'sobrenome' => $linha->sobrenome,
                    'email' => $linha->email,
                    'cpf' => $linha->cpf,
                    'senha' => md5($linha->senha),
                    'departamento_id' => $linha->departamento_id,
                    'status' => $linha->status,
                )
            );
        }
    }


}