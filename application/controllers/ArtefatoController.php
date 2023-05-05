<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ArtefatoController extends CI_Controller {

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

        $artefatos = $this->ArtefatoDAO->buscar($indiceInicial, $mostrar);

        $quantidade = $this->ArtefatoDAO->count_rows();

        $botoes = empty($artefatos) ? '' : $this->botao->paginar('ArtefatoController/listar', $indice, $quantidade, $mostrar);

        $dados = array(
            'titulo' => 'Lista de Artefatos',
            'tabela' => $this->tabela->artefato($artefatos, $indiceInicial),
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

        $data = $this->input->post();

        $artefato = new Artefato(
                null,
                $data['nome'],
                $data['status']
        );

        $this->ArtefatoDAO->create($artefato);

        redirect('ArtefatoController');
    }

    public function alterar($id) {

        $artefato = $this->ArtefatoDAO->buscarId($id);

        $dados = [
            'titulo' => 'Alterar Artefato',
            'pagina' => 'artefato/alterar.php',
            'artefato' => $artefato
        ];

        $this->load->view('index', $dados);
    }

    public function atualizar() {

        $data = $this->input->post();

        $artefato = new Artefato(
                $data['id'],
                $data['nome'],
                $data['status']
        );

        $this->ArtefatoDAO->update($artefato);

        redirect('ArtefatoController');
    }

    public function deletar($id) {

        $this->ArtefatoDAO->delete($id);

        redirect('ArtefatoController');
    }

}
