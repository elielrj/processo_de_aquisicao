<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UsuarioController extends CI_Controller {

    private $usuarioDAO;

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
    
    public function listarAtivos($indice = 1) {
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

    public function listarDesativados($indice = 1) {
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

    public function novo() {

        $dados = array(
            'titulo' => 'Novo Usuário',
            'pagina' => 'usuario/novo.php',
            'departamentos' => $this->DepartamentoDAO->options(),
        );

        $this->load->view('index', $dados);
    }

    public function criar() {

        $data = $this->input->post();

        $usuario = new Usuario(
                null,
                $data['email'],
                $data['cpf'],
                md5($data['senha']),
                $this->DepartamentoDAO->buscarPorId($data['departamento_id']),
                $data['status']
        );

        $this->UsuarioDAO->criar($usuario);

        redirect('UsuarioController');
    }

    public function alterar($id) {

        $usuario = $this->UsuarioDAO->retriveId($id);

        $dados = array(
            'titulo' => 'Alterar Usuário',
            'pagina' => 'usuario/alterar.php',
            'usuario' => $usuario,
            'departamentos' => $this->DepartamentoDAO->options(),
        );

        $this->load->view('index', $dados);
    }

    public function atualizar() {

        $data = $this->input->post();

        $usuario = new Usuario(
                $data['id'],
                $data['email'],
                $data['cpf'],
                md5($data['senha']),
                $this->DepartamentoDAO->retriveId($data['departamento_id']),
                $data['status']
        );

        $this->UsuarioDAO->update($usuario);

        redirect('UsuarioController');
    }

    public function ativar($id) {

        $this->UsuarioDAO->ativar($id);

        redirect('UsuarioController');
    }
    
    public function desativar($id) {

        $this->UsuarioDAO->desativar($id);

        redirect('UsuarioController');
    }

    public function logar() {

        if ($this->verificarEmail()) {

            if ($this->verificarSenha()) {

                $email = $this->input->post('email');

                $usuario = $this->UsuarioDAO->buscarPeloEmail($email);

                $data = array(
                    'id' => $usuario->id,
                    'email' => $usuario->email,
                    'cpf' => $usuario->cpf,
                    'senha' => $usuario->senha,
                    'departamento_id' => $usuario->departamento->id,
                    'status' => $usuario->status,
                );

                $this->session->set_userdata($data);

                redirect('ProcessoController');
            }
        }

        redirect(base_url());
    }

    public function verificarEmail() {

        $email = $this->input->post('email');

        $where = array('email' => $email);

        $resultado = $this->UsuarioDAO->verificarEmail($where);

        if (isset($resultado[0])) {

            $this->session->set_userdata('email_valido', true);
        } else {
            $this->session->set_userdata('email_valido', false);
        }

        return isset($resultado[0]);
    }

    public function verificarSenha() {

        $senha = md5($this->input->post('senha'));

        $where = array('senha' => $senha);

        $resultado = $this->UsuarioDAO->verificarSenha($where);

        if (isset($resultado[0])) {

            $this->session->set_userdata('senha_valida', true);
        } else {
            $this->session->set_userdata('senha_valida', false);
        }

        return isset($resultado[0]);
    }

}
