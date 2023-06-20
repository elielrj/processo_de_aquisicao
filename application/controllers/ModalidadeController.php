<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ModalidadeController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dao/ModalidadeDAO');
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

        $modalidades = $this->ModalidadeDAO->buscarTodos($qtd_de_itens_para_exibir,$indice_no_data_base);

		$params = [
			'controller' => 'ArquivoController',
			'quantidade_de_registros_no_banco_de_dados' => $this->ModalidadeDAO->contar()
		];


		$this->load->library('CriadorDeBotoes', $params);

        $botoes = empty($modalidades) ? '' : $this->criadordebotoes->listar($indice);

        $dados = array(
            'titulo' => 'Lista de modalidades',
            'tabela' => $this->artefatolibrary->listar($modalidades, $indice_no_data_base),
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
            $data_post['nome'],
            $data_post['status']
        );

        $this->ModalidadeDAO->criar($artefato);

        redirect('ModalidadeController');
    }

    public function alterar($id)
    {

        $artefato = $this->ModalidadeDAO->buscarId($id);

        $dados = [
            'titulo' => 'Alterar modalidade',
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
            $data_post['nome'],
            $data_post['status']
        );

        $this->ModalidadeDAO->atualizar($artefato);

        redirect('ModalidadeController');
    }

    public function deletar($id)
    {

        $this->ModalidadeDAO->deletar($id);

        redirect('ModalidadeController');
    }

}
