<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dao/LoginDAO');
    }

    public function index()
    {
        $this->load->view('login.php');
    }

    public function logar()
    {
        $data = $this->input->post();

        $email = $data['email'];
        $senha = $data['senha'];

        $this->emailExiste($email)
            ? ($this->senhaEstaCorreta($email, $senha)
                ? $this->login($email, $senha)
                : redirect(base_url()))
            : redirect(base_url());
    }

    private function login($email, $senha)
    {
        $this->LoginDAO->buscarDadosDoUsuarioLogado($email, $senha);

        redirect('processos');
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
        $this->session->set_userdata('email_validado', true);
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
}