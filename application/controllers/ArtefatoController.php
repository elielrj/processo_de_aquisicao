<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ArtefatoController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dao/ArtefatoDAO');
        $this->load->library('ArtefatoLibrary');
    }

    public function index()
    {
        usuarioPossuiSessaoAberta() ? $this->listar() : redirecionarParaPaginaInicial();
    }

    public function listar($indice = 1)
    {
        $indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

        $artefatos = $this->ArtefatoDAO->buscarTodos($qtd_de_itens_para_exibir,$indice_no_data_base);//$qtd_de_itens_para_exibir,$indice_no_data_base

		$params = [
			'controller' => 'ArtefatoController/listar',
			'quantidade_de_registros_no_banco_de_dados' => $this->ArtefatoDAO->contar()
		];

		$this->load->library('CriadorDeBotoes', $params);


        $botoes = empty($artefatos) ? '' : $this->criadordebotoes->listar($indice);

        $dados = array(
            'titulo' => 'Lista de Artefatos',
            'tabela' => $this->artefatolibrary->listar($artefatos, $indice_no_data_base),
            'pagina' => 'artefato/index.php',
            'botoes' => $botoes,
        );
        $this->load->view('index', $dados);
    }

    public function novo()
    {
        $this->load->view('index', [
            'titulo' => 'Novo Artefato',
            'pagina' => 'artefato/novo.php'
        ]);
    }

    public function criar()
    {

        $data_post = $this->input->post();

        $artefato = new Artefato(
            null,
            $data_post['ordem'],
            $data_post['nome'],
            $data_post['status']
        );

        $this->ArtefatoDAO->create($artefato);

        redirect('ArtefatoController');
    }

    public function alterar($id)
    {

        $artefato = $this->ArtefatoDAO->buscarPorId($id);

        $dados = [
            'titulo' => 'Alterar Artefato',
            'pagina' => 'artefato/alterar.php',
            'artefato' => $artefato
        ];

        $this->load->view('index', $dados);
    }

    public function atualizar()
    {

        $data_post = $this->input->post();

        $artefato = new Artefato(
            $data_post['id'],
            $data_post['ordem'],
            $data_post['nome'],
            $data_post['status']
        );

        $this->ArtefatoDAO->atualizar($artefato);

        redirect('ArtefatoController');
    }

    public function deletar($id)
    {

        $this->ArtefatoDAO->delete($id);

        redirect('ArtefatoController');
    }

}
