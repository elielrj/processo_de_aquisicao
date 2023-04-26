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

        $botoes = empty($processos) ? '' : $this->botao->paginar('PregaoController/listar', $indice, $quantidade, $mostrar);

        $dados = array(
            'titulo' => 'Lista de Processos de Pregão',
            'tabela' => $this->tabela->pregao($processos, $indiceInicial),
            'pagina' => 'pregao/index.php',
            'botoes' => $botoes,
        );

        $this->load->view('index', $dados);
    }

    public function listarProcesso($processoId)
    {
        $processo = $this->ProcessoDAO->retriveId($processoId);

        $processo->arquivos = $this->ProcessoDAO->buscarArquivosDoProcesso($processoId);      

        $dados = array(
            'titulo' => 'Lista de Processos de Pregão',
            'tabela' => $this->tabela->processoDePregao($processo),
            'pagina' => 'pregao/listar_processo/listar.php'
        );

        $this->load->view('index', $dados);
    }



}