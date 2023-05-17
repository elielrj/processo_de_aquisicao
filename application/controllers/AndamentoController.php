<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/models/bo/Andamento.php');

class AndamentoController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dao/AndamentoDAO');
        $this->load->library('AndamentoLibrary');
    }

    public function index()
    {
        if (!isset($this->session->email)) {
            header("Location:" . base_url());
        } else {
            $this->listar();
        }
    }

    public function listar($indice = 1)
    {
        $indice--;

        $mostrar = 10;
        $indiceInicial = $indice * $mostrar;

        $leis = $this->AndamentoDAO->buscarTodos($indiceInicial, $mostrar);

        $quantidade = $this->AndamentoDAO->contar();

        $botoes = empty($leis) ? '' : $this->botao->paginar('AndamentoController/listar', $indice, $quantidade, $mostrar);

        $dados = array(
            'titulo' => 'Lista de leis',
            'tabela' => $this->andamentoibrary->listar($leis, $indiceInicial),
            'pagina' => 'andamento/index.php',
            'botoes' => $botoes,
        );
        $this->load->view('index', $dados);
    }

    public function novo()
    {
        $this->load->view('index', [
            'titulo' => 'Nova andamento',
            'pagina' => 'andamento/novo.php'
        ]);
    }

    public function criar()
    {

        $data_post =  $this->input->post();

        $andamento = new Andamento(
            null,
            $data_post['status_do_andamento'],
            $data_post['data_hora']
        );

        $this->AndamentoDAO->criar($andamento);

        redirect('AndamentoController');
    }

    public function alterar($id)
    {

        $andamento = $this->AndamentoDAO->buscarId($id);

        $dados = [
            'titulo' => 'Alterar andamento',
            'pagina' => 'andamento/alterar.php',
            'andamento' => $andamento
        ];

        $this->load->view('index', $dados);
    }

    public function atualizar()
    {

        $data_post =  $this->input->post();

        $andamento = new Andamento(
            $data_post['id'],
            $data_post['status_do_andamento'],
            $data_post['data_hora']
        );

        $this->AndamentoDAO->atualizar($andamento);

        redirect('AndamentoController');
    }

    public function deletar($id)
    {

        $this->AndamentoDAO->deletar($id);

        redirect('AndamentoController');
    }
}