<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/models/bo/Lei.php');

class LeiController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!isset($this->session->email)) {
            $this->load->view('login.php');
        } else {
            $this->listar();
        }
    }

    public function listar($indice = 1)
    {
        $indice--;

        $mostrar = 10;
        $indiceInicial = $indice * $mostrar;

        $leis = $this->LeiDAO->buscar($indiceInicial, $mostrar);

        $quantidade = $this->LeiDAO->quantidade();

        $botoes = empty($leis) ? '' : $this->botao->paginar('leiController/listar', $indice, $quantidade, $mostrar);

        $dados = array(
            'titulo' => 'Lista de leis',
            'tabela' => $this->tabela->lei($leis, $indiceInicial),
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

        $data = $this->input->post();

        $lei = new lei(
            null,
            $data['numero'],
            $data['artigo'],
            $data['inciso'],
            $data['data'],
            $data['modalidade_id'],
            $data['status']
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

        $data = $this->input->post();

        $lei = new lei(
            $data['id'],
            $data['numero'],
            $data['artigo'],
            $data['inciso'],
            $data['data'],
            $data['modalidade_id'],
            $data['status']
        );

        $this->LeiDAO->update($lei);

        redirect('leiController');
    }

    public function deletar($id)
    {

        $this->LeiDAO->update($id);

        redirect('leiController');
    }

    public function optionsPorModalidadeId()
    {

        $data = $this->input->post();

        $modalidade_id = $data['modalidade_id'];

        $listaDeLeis = $this->LeiDAO->optionsDeLeisPorModalidadeId($modalidade_id);

        $options = "<option>Selecione uma Lei</option>";

        foreach($listaDeLeis as $key => $value){
            $options .= "<option value='{$key}'>{$value}</option>";
        }

        echo $options;
    }

}