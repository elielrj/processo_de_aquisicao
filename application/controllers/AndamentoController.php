<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/models/bo/Lei.php');

class AndamentoController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dao/AndamentoDAO');
        $this->load->model('dao/LeiDAO');
        $this->load->library('LeiLibrary');
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

        $leis = $this->LeiDAO->buscarTodos($indiceInicial, $mostrar);

        $quantidade = $this->LeiDAO->contar();

        $botoes = empty($leis) ? '' : $this->botao->paginar('leiController/listar', $indice, $quantidade, $mostrar);

        $dados = array(
            'titulo' => 'Lista de leis',
            'tabela' => $this->leilibrary->listar($leis, $indiceInicial),
            'pagina' => 'lei/index.php',
            'botoes' => $botoes,
        );
        $this->load->view('index', $dados);
    }

    public function novo()
    {
        $this->load->view('index', [
            'titulo' => 'Nova lei',
            'pagina' => 'lei/novo.php'
        ]);
    }

    public function criar()
    {

        $data_post =  $this->input->post();

        $lei = new lei(
            null,
            $data_post['numero'],
            $data_post['artigo'],
            $data_post['inciso'],
            $data_post['data'],
            $data_post['modalidade_id'],
            $data_post['status']
        );

        $this->LeiDAO->create($lei);

        redirect('leiController');
    }

    public function alterar($id)
    {

        $lei = $this->LeiDAO->buscarId($id);

        $dados = [
            'titulo' => 'Alterar lei',
            'pagina' => 'lei/alterar.php',
            'lei' => $lei
        ];

        $this->load->view('index', $dados);
    }

    public function atualizar()
    {

        $data_post =  $this->input->post();

        $lei = new lei(
            $data_post['id'],
            $data_post['numero'],
            $data_post['artigo'],
            $data_post['inciso'],
            $data_post['data'],
            $data_post['modalidade_id'],
            $data_post['status']
        );

        $this->LeiDAO->update($lei);

        redirect('leiController');
    }

    public function deletar($id)
    {

        $this->LeiDAO->deletar($id);

        redirect('leiController');
    }

    public function optionsPorModalidadeId()
    {

        $data_post =  $this->input->post();

        $modalidade_id = $data_post['modalidade_id'];

        $listaDeLeis = $this->LeiDAO->optionsDeLeisPorModalidadeId($modalidade_id);

        $options = "<option>Selecione uma Lei</option>";

        foreach($listaDeLeis as $key => $value){
            $options .= "<option value='{$key}'>{$value}</option>";
        }

        echo $options;
    }

}