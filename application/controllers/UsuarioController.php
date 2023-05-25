<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UsuarioController extends CI_Controller
{

    private $usuarioDAO;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('dao/UsuarioDAO');
        $this->load->model('dao/DepartamentoDAO');
        $this->load->model('dao/FuncaoDAO');
        $this->load->model('dao/HierarquiaDAO');
        $this->load->library('UsuarioLibrary');
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

        $usuarios = $this->UsuarioDAO->buscarTodos($indiceInicial, $mostrar);

        $quantidade = $this->UsuarioDAO->contar();

        $botoes = empty($usuarios) ? '' : $this->botao->paginar('usuario/listar', $indice, $quantidade, $mostrar);

        $dados = array(
            'titulo' => 'Lista de Usuários',
            'tabela' => $this->usuariolibrary->listar($usuarios, $indiceInicial),
            'pagina' => 'usuario/index.php',
            'botoes' => $botoes,
        );

        $this->load->view('index', $dados);
    }

    public function listarAtivos($indice = 1)
    {
        $indice--;

        $mostrar = 10;
        $indiceInicial = $indice * $mostrar;

        $usuarios = $this->UsuarioDAO->buscarTodos($indiceInicial, $mostrar);

        $quantidade = $this->UsuarioDAO->quantidadeAtivos();

        $botoes = empty($usuarios) ? '' : $this->botao->paginar('usuario/listar', $indice, $quantidade, $mostrar);

        $dados = array(
            'titulo' => 'Lista de Usuários',
            'tabela' => $this->tabela->usuario($usuarios, $indiceInicial),
            'pagina' => 'usuario/index.php',
            'botoes' => $botoes,
        );

        $this->load->view('index', $dados);
    }

    public function listarDesativados($indice = 1)
    {
        $indice--;

        $mostrar = 10;
        $indiceInicial = $indice * $mostrar;

        $usuarios = $this->UsuarioDAO->buscarTodosDesativados($indiceInicial, $mostrar);

        $quantidade = $this->UsuarioDAO->contarDesativados();

        $botoes = empty($usuarios) ? '' : $this->botao->paginar('usuario/listar', $indice, $quantidade, $mostrar);

        $dados = array(
            'titulo' => 'Lista de Usuários',
            'tabela' => $this->tabela->usuario($usuarios, $indiceInicial),
            'pagina' => 'usuario/index.php',
            'botoes' => $botoes,
        );

        $this->load->view('index', $dados);
    }

    public function novo()
    {

        $dados = array(
            'titulo' => 'Novo Usuário',
            'pagina' => 'usuario/novo.php',
            'departamentos' => $this->DepartamentoDAO->options(),
            'hierarquias' => $this->HierarquiaDAO->options(),
            'funcoes' => $this->FuncaoDAO->options()
        );

        $this->load->view('index', $dados);
    }

    public function criar()
    {

        $data_post = $this->input->post();

        $usuario = new Usuario(
            null,
            $data_post['nome'],
            $data_post['sobrenome'],
            $data_post['email'],
            $data_post['cpf'],
            md5($data_post['senha']),
            $this->DepartamentoDAO->buscarPorId($data_post['departamento_id']),
            $data_post['status'],
            $this->HierarquiaDAO->buscarPorId($data_post['hierarquia_id']),
            $this->FuncaoDAO->buscarPorId($data_post['funcao_id'])
        );

        $this->UsuarioDAO->criar($usuario);

        redirect('UsuarioController');
    }

    public function alterar($id)
    {

        $usuario = $this->UsuarioDAO->buscarPorId($id);

        $dados = array(
            'titulo' => 'Alterar Usuário',
            'pagina' => 'usuario/alterar.php',
            'usuario' => $usuario,
            'departamentos' => $this->DepartamentoDAO->options(),
            'hierarquias' => $this->HierarquiaDAO->options(),
            'funcoes' => $this->FuncaoDAO->options()
        );

        $this->load->view('index', $dados);
    }
    public function alterarUsuario($id)
    {

        $usuario = $this->UsuarioDAO->buscarPorId($id);

        $options = $this->HierarquiaDAO->options();

        $dados = array(
            'titulo' => 'Atualizar dados do usuário: ' . $_SESSION['nome'],
            'pagina' => 'usuario/alterar_usuario.php',
            'usuario' => $usuario,
            'departamentos' => $this->DepartamentoDAO->options(),
            'hierarquias' => $options,
            'funcoes' => $this->FuncaoDAO->options()
        );

        $this->load->view('index', $dados);
    }

    public function atualizar()
    {

        $data_post = $this->input->post();

        $usuario = new Usuario(
            $data_post['id'],
            $data_post['nome'],
            $data_post['sobrenome'],
            $data_post['email'],
            $data_post['cpf'],
            md5($data_post['senha']),
            $this->DepartamentoDAO->buscarPorId($data_post['departamento_id']),
            $data_post['status'], 
            $this->HierarquiaDAO->buscarPorId($data_post['hierarquia_id']),
            $this->FuncaoDAO->buscarPorId($data_post['funcao_id'])
        );

        $this->UsuarioDAO->atualizar($usuario);

        redirect('UsuarioController');
    }
    public function atualizarUsuario()
    {

        $data_post = $this->input->post();

        $usuario = new Usuario(
            $data_post['id'],
            $data_post['nome'],
            $data_post['sobrenome'],
            $data_post['email'],
            $data_post['cpf'],
            md5($data_post['senha']),
            $this->DepartamentoDAO->buscarPorId($data_post['departamento_id']),
            $data_post['status'],
            $this->HierarquiaDAO->buscarPorId($data_post['hierarquia_id']),
            $this->FuncaoDAO->buscarPorId($data_post['funcao_id'])
        );

        $this->UsuarioDAO->atualizar($usuario);

        redirect('ProcessoController');
    }

    public function ativar($id)
    {

        $this->UsuarioDAO->ativar($id);

        redirect('UsuarioController');
    }

    public function desativar($id)
    {

        $this->UsuarioDAO->desativar($id);

        redirect('UsuarioController');
    }



}