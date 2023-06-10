<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UgController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dao/UgDAO');
        $this->load->library('UgLibrary');
    }

    public function index()
    {
        usuarioPossuiSessaoAberta() ? $this->listar() : redirecionarParaPaginaInicial();
    }

    public function listar($indice = 1)
    {
        $indice--;

        $mostrar = 10;
        $indiceInicial = $indice * $mostrar;

        $listaDeUg = $this->UgDAO->buscarTodos($indiceInicial, $mostrar);

        $quantidade = $this->UgDAO->contar();

        $botoes = empty($listaDeUg) ? '' : $this->botao->paginar('UgController/listar', $indice, $quantidade, $mostrar);

        $dados = array(
            'titulo' => 'Lista de UG',
            'tabela' => $this->uglibrary->listar($listaDeUg, $indiceInicial),
            'pagina' => 'ug/index.php',
            'botoes' => $botoes,
        );
        $this->load->view('index', $dados);
    }

}