<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PregaoController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!isset($this->session->email)) {

            $this->load->view('login.php');

        } else {
            $this->listar();
        }
    }


    public function listar($indice = 1)
    {
        $indice--;

        $mostrar = 10;
        $indiceInicial = $indice * $mostrar;

        $processos = $this->ProcessoDAO->retrive($indiceInicial, $mostrar);

        $quantidade = $this->ProcessoDAO->count_rows();

        $botoes = empty($processos) ? '' : $this->botao->paginar('arquivo/listar', $indice, $quantidade, $mostrar);

        $data = [];

        $dados = array(
            'titulo' => 'Lista de Processos de Pregão',
            'tabela' => $this->tabela->processo($processos, $indiceInicial, $data),
            'pagina' => 'pregao/index.php',
            'botoes' => $botoes,
        );

        $this->load->view('index', $dados);
    }

    public function listarProcesso($indice)
    {
        $indice--;

        $mostrar = 10;
        $indiceInicial = $indice * $mostrar;

        $processos = $this->ProcessoDAO->retrive($indiceInicial, $mostrar);

        $quantidade = $this->ProcessoDAO->count_rows();

        $botoes = empty($processos) ? '' : $this->botao->paginar('arquivo/listar', $indice, $quantidade, $mostrar);

        $processo_completo = $this->ProcessoDAO->buscarArquivosDoProcesso($indice);

        $data = array(
            'processo_selecionado' => $processo_completo,
            'processo_id' => $indice,
        );

        $dados = array(
            'titulo' => 'Lista de Processos de Pregão',
            'tabela' => $this->tabela->processo($processos, $indiceInicial, $data),
            'pagina' => 'pregao/index.php',
            'botoes' => $botoes,
        );

        $this->load->view('index', $dados);
    }



}