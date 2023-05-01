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

        $listaDeItemDeIndices = $this->ItemDoIndiceDAO->retrive($indiceInicial, $mostrar);

        $quantidade = $this->ItemDoIndiceDAO->count_rows();

        $botoes = empty($listaDeItemDeIndices) ? '' : $this->botao->paginar('ItemDoIndiceController/listar', $indice, $quantidade, $mostrar);



        $dados = array(
            'titulo' => 'Lista de Itens do Índice',
            'tabela' => $this->tabela->itemDoIndice($listaDeItemDeIndices, $indiceInicial),
            'pagina' => 'itemDoIndice/index.php',
            'botoes' => $botoes
        );
        $this->load->view('index', $dados);
    }
    public function listarItensDoIndice($indice_id) {
        
        $indiceInicial = 0;
        $indice = $this->IndiceDAO->retriveId($indice_id);
        $itensDoIndice = $this->ItemDoIndiceDAO->retriveIndiceId($indice_id);

        $dados = array(
            'titulo' => 'Lista de Itens do Índice de ' . $indice->tipoDeLicitacao->nome,
            'tabela' => $this->tabela->itemDoIndice($itensDoIndice, $indiceInicial),
            'pagina' => 'itemDoIndice/listarItensDoIndice.php'
        );
        $this->load->view('index', $dados);
    }

    public function novo() {
        $this->load->view('index', [
            'titulo' => 'Novo Item do Índice',
            'pagina' => 'itemDoIndice/novo.php'
        ]);
    }

    public function criar() {
        
        $data = $this->input->post();
        
        $itemDoIndice = new ItemDoIndice(
                null,
                $data['ordem'],
                $data['artefato_id'],
                $data['status']
        );
        
        $this->ItemDoIndiceDAO->create($itemDoIndice,$data['indice_id']);
        
        redirect('ItemDoIndiceController');
    }

    public function alterar($id) {
        /*
        $this->load->view('index', [
            'titulo' => 'Alterar Item do Índice',
            'pagina' => 'itemDoIndice/alterar.php',
            'itemDoIndice' => $this->ItemDoIndiceDAO->retriveId($id)
        ]);*/
    }

    public function atualizar() {
  //      $this->ItemDoIndiceDAO->update(Artefato::fromPostToObject($this->input->post()));
     //   redirect('ItemDoIndiceController');
    }

    public function deletar($id) {
        $this->ItemDoIndiceDAO->delete($id);
        redirect('ItemDoIndiceController');
    }

}
