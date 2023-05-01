<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UgController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if (!isset($this->session->email)) {
            $this->load->view('login.php');
        } else {
            $this->listar();
        }
    }

    public function listar($indice = 1) {
        $indice--;

        $mostrar = 10;
        $indiceInicial = $indice * $mostrar;

        $listaDeUg = $this->UgDAO->retrive($indiceInicial, $mostrar);

        $quantidade = $this->UgDAO->count_rows();

        $botoes = empty($listaDeUg) ? '' : $this->botao->paginar('UgController/listar', $indice, $quantidade, $mostrar);

        $dados = array(
            'titulo' => 'Lista de UG',
            'tabela' => $this->tabela->ug($listaDeUg, $indiceInicial),
            'pagina' => 'ug/index.php',
            'botoes' => $botoes,
        );
        $this->load->view('index', $dados);
    }

}
