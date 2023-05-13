<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DepartamentoController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('dao/DepartamentoDAO');
    }

    public function index() {
        if (!isset($this->session->email)) {

            header("Location:" . base_url());
            
        } else {
            $this->listar();
        }
    }

    public function listar($indice = 1) {
        $indice--;

        $mostrar = 10;
        $indiceInicial = $indice * $mostrar;

        $departamentos = $this->DepartamentoDAO->buscar($indiceInicial, $mostrar);

        $quantidade = $this->DepartamentoDAO->quantidade();

        $botoes = empty($departamentos) ? '' : $this->botao->paginar('DepartamentoController/listar', $indice, $quantidade, $mostrar);

        $dados = array(
            'titulo' => 'Lista de Departamentos',
            'tabela' => $this->tabela->departamento($departamentos, $indiceInicial),
            'pagina' => 'departamento/index.php',
            'botoes' => $botoes,
        );

        $this->load->view('index', $dados);
    }

    public function novo() {

        $dados = array(
            'titulo' => 'Nova Seção',
            'pagina' => 'departamento/novo.php',
        );

        $this->load->view('index', $dados);
    }

    public function criar() {
        $data_post =  $this->input->post();

        $departamento = new Departamento(
                null,
                $data_post['nome'],
                $data_post['sigla'],
                $data_post['status']
        );

        $this->DepartamentoDAO->create($departamento);

        redirect('DepartamentoController');
    }

    public function alterar($id) {

        $departamento = $this->DepartamentoDAO->buscarPorId($id);

        $dados = array(
            'titulo' => 'Alterar Seção',
            'pagina' => 'departamento/alterar.php',
            'departamento' => $departamento,
        );

        $this->load->view('index', $dados);
    }

    public function atualizar() {

        $data_post =  $this->input->post();

        $departamento = new Departamento(
                $data_post['id'],
                $data_post['nome'],
                $data_post['sigla'],
                $data_post['status']
        );

        $this->DepartamentoDAO->update($departamento);

        redirect('DepartamentoController');
    }

    public function deletar($id) {
        $this->DepartamentoDAO->delete($id);

        redirect('DepartamentoController');
    }

}
