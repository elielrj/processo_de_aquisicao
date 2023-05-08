<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UsuarioController extends CI_Controller
{

    private $usuarioDAO;

    public function __construct()
    {
        parent::__construct();
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

        $usuarios = $this->UsuarioDAO->buscar($indiceInicial, $mostrar);

        $quantidade = $this->UsuarioDAO->quantidade();

        $botoes = empty($usuarios) ? '' : $this->botao->paginar('usuario/listar', $indice, $quantidade, $mostrar);

        $dados = array(
            'titulo' => 'Lista de Usuários',
            'tabela' => $this->tabela->usuario($usuarios, $indiceInicial),
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

        $usuarios = $this->UsuarioDAO->buscarPorUsuariosAtivos($indiceInicial, $mostrar);

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

        $usuarios = $this->UsuarioDAO->buscarPorUsuariosDesativados($indiceInicial, $mostrar);

        $quantidade = $this->UsuarioDAO->quantidadeDesativados();

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
        );

        $this->load->view('index', $dados);
    }

    public function criar()
    {

        $data = $this->input->post();

        $usuario = new Usuario(
            null,
            $data['nome'],
            $data['sobrenome'],
            $data['email'],
            $data['cpf'],
            md5($data['senha']),
            $this->DepartamentoDAO->buscarPorId($data['departamento_id']),
            $data['status']
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
        );

        $this->load->view('index', $dados);
    }
    public function alterarUsuario($id)
    {

        $usuario = $this->UsuarioDAO->buscarPorId($id);

        $dados = array(
            'titulo' => 'Atualizar dados do usuário: ' . $_SESSION['nome'],
            'pagina' => 'usuario/alterar_usuario.php',
            'usuario' => $usuario,
            'departamentos' => $this->DepartamentoDAO->options(),
        );

        $this->load->view('index', $dados);
    }

    public function atualizar()
    {

        $data = $this->input->post();

        $usuario = new Usuario(
            $data['id'],
            $data['nome'],
            $data['sobrenome'],
            $data['email'],
            $data['cpf'],
            $data['senha'],
            $this->DepartamentoDAO->buscarPorId($data['departamento_id']),
            $data['status']
        );

        $this->UsuarioDAO->atualizar($usuario);

        redirect('UsuarioController');
    }
    public function atualizarUsuario()
    {

        $data = $this->input->post();

        $usuario = new Usuario(
            $data['id'],
            $data['nome'],
            $data['sobrenome'],
            $data['email'],
            $data['cpf'],
            $data['senha'],
            $this->DepartamentoDAO->buscarPorId($data['departamento_id']),
            $data['status']
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