<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dao/LoginDAO');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('login.php');
    }

    public function logar()
    {
        $this->limparValidacao();

        $data_post = $this->input->post();

        $email = $data_post['email'];
        $senha = md5($data_post['senha']);

        $this->emailExiste($email)
            ? ($this->senhaEstaCorreta($email, $senha)
                ? $this->login($email, $senha)
                : redirect(base_url()))
            : redirect(base_url());
    }

    private function login($email, $senha)
    {
        $this->LoginDAO->buscarDadosDoUsuarioLogado($email, $senha);

        redirect('processo-listar');
    }

    private function emailExiste($email)
    {
        if ($this->LoginDAO->emailExiste($email)) {
            $this->emailValido();
            return true;
        } else {
            $this->emailInvalido();
            return false;
        }
    }

    /**
     * Summary of senhaEstaCorreta
     * email é not null no banco de dados, 
     * assim, tem que ser passado o email e a 
     * senha para ser pesquisado a senha somente no email
     * 
     * @param mixed $email
     * @param mixed $senha
     * @return bool
     */
    private function senhaEstaCorreta($email, $senha)
    {
        if ($this->LoginDAO->senhaEstaCorreta($email, $senha)) {
            $this->senhaValida();
            return true;
        } else {
            $this->senhaInvalida();
            return false;
        }
    }

    private function emailValido()
    {
        $this->session->set_userdata('email_valido', true);
    }

    private function emailInvalido()
    {
        $this->session->set_userdata('email_valido', false);
    }

    private function senhaValida()
    {
        $this->session->set_userdata('senha_valida', true);
    }

    private function senhaInvalida()
    {
        $this->session->set_userdata('senha_valida', false);
    }

    public function sair()
    {
        session_destroy();

        redirect(base_url());
    }

    private function limparValidacao()
    {
        $this->session->unset_userdata('email_valido', 'senha_valida', 'numero_valido', 'chave_valida');
    }
}
