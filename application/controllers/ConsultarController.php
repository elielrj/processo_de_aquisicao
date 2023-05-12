<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ConsultarController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dao/ConsultarDAO');
        $this->load->library('session');
    }

    public function consultar()
    {
        $this->limparValidacao();

        $data = $this->input->post();

        $numero = $data['numero'];
        $chave = $data['chave'];

        $this->numeroExiste($numero)
            ? ($this->chaveEstaCorreta($chave)
                ? $this->exibir($numero, $chave)
                : redirect(base_url()))
            : redirect(base_url());
    }

    private function exibir($numero, $chave)
    {
        $processo = $this->ConsultarDAO->buscarPorNumeroChave($numero, $chave);

        $data = array(
            'titulo' => 'Processo: ' . $processo->tipo->nome,
            'tabela' => $this->tabela->processo_imprimir($processo),
            'pagina' => 'consultar/exibir.php',
        );
        $this->load->view('index', $data);
    }

    private function numeroExiste($numero)
    {
        if ($this->ConsultarDAO->numeroExiste($numero)) {
            $this->numeroValido();
            return true;
        } else {
            $this->numeroInvalido();
            return false;
        }
    }

    private function chaveEstaCorreta($chave)
    {
        if ($this->ConsultarDAO->chaveEstaCorreta($chave)) {
            $this->chaveValida();
            return true;
        } else {
            $this->chaveInvalida();
            return false;
        }
    }

    private function numeroValido()
    {
        $this->session->set_userdata('numero_valido', true);
    }

    private function numeroInvalido()
    {
        $this->session->set_userdata('numero_valido', false);
    }

    private function chaveValida()
    {
        $this->session->set_userdata('chave_valida', true);
    }

    private function chaveInvalida()
    {
        $this->session->set_userdata('chave_valida', false);
    }

    private function limparValidacao()
    {
        $this->session->unset_userdata('email_valido', 'senha_valida', 'numero_valido', 'chave_valida');
    }
}