<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModalidadeController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('dao/ModalidadeDAO');
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

        $modalidades = $this->ModalidadeDAO->buscarTodos($indiceInicial, $mostrar);

        $quantidade = $this->ModalidadeDAO->contar();

        $botoes = empty($modalidades) ? '' : $this->botao->paginar('ModalidadeController/listar', $indice, $quantidade, $mostrar);

        $dados = array(
            'titulo' => 'Lista de modalidades',
            'tabela' => $this->tabela->artefato($modalidades, $indiceInicial),
            'pagina' => 'artefato/index.php',
            'botoes' => $botoes,
        );
        $this->load->view('index', $dados);
    }

    public function novo() {
        $this->load->view('index', [
            'titulo' => 'Novo Artefato',
            'pagina' => 'artefato/novo.php'
        ]);
    }

    public function criar() {

        $data_post =  $this->input->post();

        $artefato = new Artefato(
                null,
                $data_post['nome'],
                $data_post['status']
        );

        $this->ModalidadeDAO->create($artefato);

        redirect('ModalidadeController');
    }

    public function alterar($id) {

        $artefato = $this->ModalidadeDAO->buscarId($id);

        $dados = [
            'titulo' => 'Alterar modalidade',
            'pagina' => 'artefato/alterar.php',
            'artefato' => $artefato
        ];

        $this->load->view('index', $dados);
    }

    public function atualizar() {

        $data_post =  $this->input->post();

        $artefato = new Artefato(
                $data_post['id'],
                $data_post['nome'],
                $data_post['status']
        );

        $this->ModalidadeDAO->update($artefato);

        redirect('ModalidadeController');
    }

    public function deletar($id) {

        $this->ModalidadeDAO->delete($id);

        redirect('ModalidadeController');
    }

}
