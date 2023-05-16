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
        if (!isset($this->session->email)) {
            header("Location:" . base_url());
        } else {
            $this->listar();
        }
    }

    public function listar($indice = 1)
    {
        $leisTiposArtefatos = $this->LeiTipoArtefatoDAO->buscarTodos(null, null);

        $dados = array(
            'titulo' => 'Lista de Leis/Tipos/Artefatos',
            'tabela' => $this->leitipoartefatolibrary->listar($leisTiposArtefatos, 1),
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

        $this->LeiTipoArtefatoDAO->update($lei);

        redirect('LeiTipoArtefatoController');
    }


}