<?php

defined('BASEPATH') or exit('No direct script access allowed');


class LeiTipoArtefatoController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dao/LeiTipoArtefatoDAO');
        $this->load->library('LeiTipoArtefatoLibrary');
    }

    public function index()
    {
        usuarioPossuiSessaoAberta() ? $this->listar() : redirecionarParaPaginaInicial();
    }

    public function listar()
    {
        $leisTiposArtefatos = $this->LeiTipoArtefatoDAO->buscarTodos(null, null);

        $dados = array(
            'titulo' => 'Lista de Leis/Tipos/Artefatos',
            'tabela' => $this->leitipoartefatolibrary->listar($leisTiposArtefatos),
            'pagina' => 'leis_tipos_artefatos/index.php',
        );
        $this->load->view('index', $dados);
    }

    public function atualizar()
    {

        $data_post = $this->input->post();

        $whare = array(
            $data_post['id'],
            $data_post['lei_id'],
            $data_post['tipo_id'],
            $data_post['artefato_id'],
            $data_post['status']
        );

        $this->LeiTipoArtefatoDAO->atualizar($whare);

        redirect('LeiTipoArtefatoController');
    }


}