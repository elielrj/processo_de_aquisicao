<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UsuarioController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//$this->load->library('session');
		$this->load->model('dao/UsuarioDAO');
		$this->load->model('dao/DepartamentoDAO');
		$this->load->model('dao/FuncaoDAO');
		$this->load->model('dao/HierarquiaDAO');
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

		$usuarios = $this->UsuarioDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base);

		$params = [
			'controller' => USUARIO_CONTROLLER . '/listar',
			'quantidade_de_registros_no_banco_de_dados' => $this->UsuarioDAO->contar()
		];


		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($usuarios) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de Usuários',
			'tabela' => $usuarios,
			'pagina' => 'usuario/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);
	}

	public function listarAtivos($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		$usuarios = $this->UsuarioDAO->buscarTodos($indice_no_data_base, $qtd_de_itens_para_exibir);

		$params = [
			'controller' => 'UsuarioController',
			'quantidade_de_registros_no_banco_de_dados' => $this->UsuarioDAO->quantidadeAtivos()
		];

		$this->load->library('CriadorDeBotoes', $params);


		$botoes = empty($usuarios) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de Usuários',
			'tabela' => $this->tabela->usuario($usuarios, $indice_no_data_base),
			'pagina' => 'usuario/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);
	}

	public function listarDesativados($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		$usuarios = $this->UsuarioDAO->buscarTodosDesativados($indice_no_data_base, $qtd_de_itens_para_exibir);

		$quantidade = $this->UsuarioDAO->contarDesativados();

		$botoes = empty($usuarios) ? '' : $this->botao->paginar('usuario/listar', $indice, $quantidade, $qtd_de_itens_para_exibir);

		$dados = array(
			'titulo' => 'Lista de Usuários',
			'tabela' => $this->tabela->usuario($usuarios, $indice_no_data_base),
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
			$data_post['nome_de_guerra'],
			$data_post['nome_completo'],
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

		$this->removerSenha($usuario);

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

	public function alterarUsuario()
	{

		$usuario = $this->UsuarioDAO->buscarPorId($_SESSION['id']);

		$this->removerSenha($usuario);

		$options = $this->HierarquiaDAO->options();

		$dados = array(
			'titulo' => 'Atualizar dados do usuário: ' . $_SESSION['nome_de_guerra'],
			'pagina' => 'usuario/alterar_usuario.php',
			'usuario' => $usuario,
			'departamentos' => $this->DepartamentoDAO->options(),
			'hierarquias' => $options,
		);

		$this->load->view('index', $dados);
	}

	public function atualizar()
	{

		$data_post = $this->input->post();

		$senha = $data_post['senha'] === ''
			? $_SESSION['senha']
			: md5($data_post['senha']);

		$usuario = new Usuario(
			$data_post['id'],
			$data_post['nome_de_guerra'],
			$data_post['nome_completo'],
			$data_post['email'],
			$data_post['cpf'],
			$senha,
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

		$senha = $data_post['senha'] === ''
			? $_SESSION['senha']
			: md5($data_post['senha']);

		$usuario = new Usuario(
			$data_post['id'],
			$data_post['nome_de_guerra'],
			$data_post['nome_completo'],
			$data_post['email'],
			$data_post['cpf'],
			$senha,
			$this->DepartamentoDAO->buscarPorId($data_post['departamento_id']),
			$data_post['status'],
			$this->HierarquiaDAO->buscarPorId($data_post['hierarquia_id']),
			$this->FuncaoDAO->buscarPorId($data_post['funcao_id'])
		);

		$this->UsuarioDAO->atualizar($usuario);

		$this->load->model('dao/LoginDAO');
		$this->LoginDAO->buscarDadosDoUsuarioLogado($usuario->email, $usuario->senha);

		header("Location:" . base_url('index.php/ProcessoController'));
	}

	public function ativar($id)
	{

		$this->UsuarioDAO->ativar($id);

		redirect('UsuarioController');
	}

	public function deletar($id)
	{

		$this->UsuarioDAO->deletar($id);

		redirect('UsuarioController');
	}

	private function removerSenha($usuario)
	{
		$usuario->senha = '';
	}


}
