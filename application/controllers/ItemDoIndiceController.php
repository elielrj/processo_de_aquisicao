<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ItemDoIndiceController extends CI_Controller {

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

        $itensDoIndice = $this->ItemDoIndiceDAO->retrive($indiceInicial, $mostrar);

        $quantidade = $this->ItemDoIndiceDAO->count_rows();

        $botoes = empty($itensDoIndice) ? '' : $this->botao->paginar('ItemDoIndiceController/listar', $indice, $quantidade, $mostrar);

        $dados = array(
            'titulo' => 'Lista de Artefatos',
            'tabela' => $this->tabela->itemDoIndice($itensDoIndice, $indiceInicial),
            'pagina' => 'itemDoIndice/index.php',
            'botoes' => $botoes,
        );
        $this->load->view('index', $dados);
    }

    public function novo() {
        $this->load->view('index', [
            'titulo' => 'Novo Artefato',
            'pagina' => 'itemDoIndice/novo.php'
        ]);
    }

    public function criar() {
        $this->ItemDoIndiceDAO->create($this->input->post());
        redirect('ItemDoIndiceController');
    }

    public function alterar($id) {
        $this->load->view('index', [
            'titulo' => 'Alterar Artefato',
            'pagina' => 'itemDoIndice/alterar.php',
            'itemDoIndice' => $this->ItemDoIndiceDAO->retriveId($id)
        ]);
    }

    public function atualizar() {
        $this->ItemDoIndiceDAO->update(Artefato::fromPostToObject($this->input->post()));
        redirect('ItemDoIndiceController');
    }

    public function deletar($id) {
        $this->ItemDoIndiceDAO->delete($id);
        redirect('ItemDoIndiceController');
    }

}
