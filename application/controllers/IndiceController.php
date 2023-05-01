<?php

defined('BASEPATH') or exit('No direct script access allowed');

class IndiceController extends CI_Controller {

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

        $listaDeIndices = $this->IndiceDAO->retrive($indiceInicial, $mostrar);

        $quantidade = $this->IndiceDAO->count_rows();

        $botoes = empty($listaDeIndices) ? '' : $this->botao->paginar('IndiceController/listar', $indice, $quantidade, $mostrar);

        $dados = array(
            'titulo' => 'Lista de Indices',
            'tabela' => $this->tabela->indice($listaDeIndices, $indiceInicial),
            'pagina' => 'indice/index.php',
            'botoes' => $botoes,
        );
        $this->load->view('index', $dados);
    }

    public function novo() {
        $this->load->view('index', [
            'titulo' => 'Novo Indice',
            'pagina' => 'indice/novo.php',
            'tiposDeLicitacao' => $this->TipoDeLicitacaoDAO->options()
        ]);
    }

    public function criar() {

        $data = $this->input->post();

        $object = new Indice(
                $data['id'],
                $this->TipoDeLicitacaoDAO->retriveId($data['tipo_de_licitacao_id']),
                $data['status']
        );

        $this->IndiceDAO->create($object);

        redirect('IndiceController');
    }

    public function alterar($id) {
        $this->load->view('index', [
            'titulo' => 'Alterar Indice',
            'pagina' => 'indice/alterar.php',
            'indice' => $this->IndiceDAO->retriveId($id),
            'tiposDeLicitacao' => $this->TipoDeLicitacaoDAO->options()
        ]);
    }

    public function atualizar() {

        $data = $this->input->post();

        $object = new Indice(
                $data['id'],
                $this->TipoDeLicitacaoDAO->retriveId($data['tipo_de_licitacao_id']),
                $data['status']
        );

        $this->IndiceDAO->update($object);

        redirect('IndiceController');
    }

    public function deletar($id) {

        $this->IndiceDAO->delete($id);

        redirect('IndiceController');
    }

}
