<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/libraries/DataLibrary.php');
include_once('application/models/bo/Arquivo.php');

class ArquivoController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('ArquivoLibrary');
        
        $this->load->model('dao/ArquivoDAO');
        $this->load->model('dao/ProcessoDAO');
        $this->load->model('dao/ArtefatoDAO');
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

        $arquivos = $this->ArquivoDAO->buscarTodos($indiceInicial, $mostrar);

        $quantidade = $this->ArquivoDAO->contar();

        $botoes = empty($arquivos) ? '' : $this->botao->paginar('arquivo/listar', $indice, $quantidade, $mostrar);

        $dados = array(
            'titulo' => 'Lista de arquivos',
            'tabela' => $this->arquivolibrary->listar($arquivos, $indiceInicial),
            'pagina' => 'arquivo/index.php',
            'botoes' => $botoes,
        );

        $this->load->view('index', $dados);
    }

    public function novo()
    {

        $dados = array(
            'titulo' => 'Novo arquivo',
            'pagina' => 'arquivo/novo.php',
            'processos' => $this->ProcessoDAO->options(),
            'artefatos' => $this->ArtefatoDAO->options()
        );

        $this->load->view('index', $dados);
    }

    public function criar()
    {

        $data_post = $this->input->post();

        $file = $_FILES['arquivo'];

        if (isset($file) && isset($data_post)) {

            $arquivo = $this->moverArquivo($data_post);

            if (isset($arquivo)) {

                $this->ArquivoDAO->criar($arquivo);

                redirect('ArquivoController');
            } else {
                //todo tratar erro 
            }
        }
    }

    public function criarApartirDeUmProcesso()
    {

        $data_post = $this->input->post();

        $file = $_FILES['arquivo'];

        if (isset($file) && isset($data_post)) {
            
            $arquivo = $this->moverArquivo($data_post);
            var_dump($arquivo);
            if (isset($arquivo)) {
               
                $this->ArquivoDAO->criar($arquivo);
                
                redirect('ProcessoController/exibir/' . $data_post['processo_id']);
                
            } else {
                //todo tratar erro 
                var_dump('caiu no else');
            }
        }
    }


    public function alterar($id)
    {

        $arquivo = $this->ArquivoDAO->buscarPorId($id);

        $dados = array(
            'titulo' => 'Alterar Arquivo',
            'pagina' => 'arquivo/alterar.php',
            'arquivo' => $arquivo,
            'processos' => $this->ProcessoDAO->options(),
            'artefatos' => $this->ArtefatoDAO->options()
        );

        $this->load->view('index', $dados);
    }

    public function atualizar()
    {

        $data_post = $this->input->post();

        $file = $_FILES['arquivo'];

        if (isset($file) && isset($data_post)) {

            $arquivo = $this->moverArquivo($data_post);

            if (isset($arquivo)) {

                $this->ArquivoDAO->criar($arquivo);

                redirect('ArquivoController');
            } else {
                //todo tratar erro 
            }
        }
    }

    public function atualizarApartirDeUmProcesso()
    {

        $data_post = $this->input->post();

        $file = $_FILES['arquivo'];

        if (isset($file) && isset($data_post)) {
            
            $arquivo = $this->moverArquivo($data_post);
            
            if (isset($arquivo)) {
                
                $this->ArquivoDAO->atualizar($arquivo);
                
                redirect('ProcessoController/exibir/' . $data_post['processo_id']);
                
            } else {
                //todo tratar erro                 
            }
        }
    }

    public function deletar($id)
    {
        $this->ArquivoDAO->deletar($$this->ArquivoDAO->buscarPorId($id));

        redirect('ArquivoController');
    }

    private function toObject($data_post, $path)
    {
        

        return new Arquivo(
            isset($data_post['id']) ? $data_post['id'] : null,
            $path,
           DataLibrary::dataHoraBr(),
            $_SESSION['id'],
            $data_post['artefato_id'],
            $data_post['processo_id'],
            $data_post['arquivo_status']
        );
    }

    private function moverArquivo($data_post)
    {
        $tmp_name = $_FILES['arquivo']['tmp_name'];
        
        if (empty($data_post['arquivo_path'])) {

            $nome_do_arquivo = $_FILES['arquivo']['name'];

            $extensao = strtolower(pathinfo($nome_do_arquivo, PATHINFO_EXTENSION));

            $path = 'arquivos/' . $data_post['artefato_id'] . '/' . uniqid() . '.' . $extensao;

        } else {

            $path = $data_post['arquivo_path'];

        }

        //$arquivado = move_uploaded_file($tmp_name, $path);
        $arquivado = false;

        $config['upload_path'] = $path;
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 10000;

        $this->load->library('upload', $config);

        if(! $this->upload->do_upload('arquivo'))
        {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('arquivo/upload_error', $error);

            $arquivado = false;
        }else{
            $arquivado = true;
        }

       
        if ($arquivado) {

            return $this->toObject($data_post, $path);

        } else {
            return null;
        }
    }

}