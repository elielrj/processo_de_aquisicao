<?php

require_once 'abstract_controller/AbstractController.php';

class UsuarioController extends AbstractController
{
	const USUARIO_CONTROLLER = 'UsuarioController';

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		is_session_senha_helper() ? $this->buscarDadosDoUsuarioLogado() : redirect_login_helper();
	}

	public function listar($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		$this->load->library('CriadorDeBotoes',
			array_to_criador_de_botoes_helper(
				self::USUARIO_CONTROLLER . '/listar',
				$this->contarTodosOsRegistros() ?? 0
			)
		);

		$this->load->view('index',
			array_to_view_helper(
				'Lista de Usuários',
				$this->buscarTodosStatus($qtd_de_itens_para_exibir, $indice_no_data_base) ?? [],
				'usuario/index.php',
				$this->criadordebotoes->listar($indice) ?? ''
			)
		);
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
		$this->load->model('dao/UsuarioDAO');

		$array =
			[
				ID => null,
				'nome_de_guerra' => $this->input->post('nome_de_guerra'),
				'nome_completo' => $this->input->post('nome_completo'),
				EMAIL => $this->input->post('email'),
				CPF => $this->input->post('cpf'),
				SENHA => md5($this->input->post('senha')),
				DEPARTAMENTO_ID => $this->input->post('departamento_id'),
				STATUS => $this->input->post('status'),
				HIERARQUI_ID => $this->input->post('hierarquia_id'),
				FUNCAO_ID => $this->input->post('funcao_id')
			];

		$this->UsuarioDAO->criar($array);

		redirect(self::USUARIO_CONTROLLER);
	}

	public function alterar($id)
	{

		$usuario = $this->buscarPorId($id);

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




	public function alterarUsuario()
	{

		$usuario = $this->UsuarioDAO->buscarPorId($_SESSION['id']);

		$usuario->senha = '';

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


	public function toObject($arrayList)
	{
		return new Usuario(
			$arrayList->id ?? ($arrayList['id'] ?? null),
			$arrayList->nome_de_guerra ?? ($arrayList['nome_de_guerra'] ?? null),
			$arrayList->nome_completo ?? ($arrayList['nome_completo'] ?? null),
			$arrayList->email ?? ($arrayList['email'] ?? null),
			$arrayList->cpf ?? ($arrayList['cpf'] ?? null),
			$arrayList->senha ?? ($arrayList['senha'] ?? null),
			isset($arrayList->departamento_id)
				? ($this->DepartamentoDAO->buscarPorId($arrayList->departamento_id))
				: (isset($arrayList['departamento_id']) ? $this->DepartamentoDAO->buscarPorId($arrayList['departamento_id']) : null),
			$arrayList->status ?? ($arrayList['status'] ?? null),
			isset($arrayList->hierarquia_id)
				? $this->HierarquiaDAO->buscarPorId($arrayList->hierarquia_id)
				: (isset($arrayList['hierarquia_id']) ? $this->HierarquiaDAO->buscarPorId($arrayList['hierarquia_id']) : null),
			isset($arrayList->funcao_id)
				? $this->FuncaoDAO->buscarPorId($arrayList->funcao_id)
				: (isset($arrayList['funcao_id']) ? $this->FuncaoDAO->buscarPorId($arrayList['funcao_id']) : null)
		);
	}

	public function buscarDadosDoUsuarioLogado()
	{
		$where = array(
			EMAIL => $_SESSION[SESSION_EMAIL],
			SENHA => $_SESSION[SESSION_SENHA]
		);

		$this->load->model('dao/UsuarioDAO');
		$this->load->model('dao/DepartamentoDAO');
		$this->load->model('dao/HierarquiaDAO');
		$this->load->model('dao/FuncaoDAO');

		$array = $this->UsuarioDAO->buscarOnde(TABLE_USUARIO, $where);

		foreach ($array->result() as $linha) {

			$this->session->set_userdata(
				array(
					SESSION_ID => $linha->id,
					SESSION_NOME_DE_GUERRA => $linha->nome_de_guerra,
					SESSION_NOME_COMPLETO => $linha->nome_completo,
					SESSION_EMAIL => $linha->email,
					SESSION_CPF => $linha->cpf,
					SESSION_SENHA => $linha->senha,
					SESSION_DEPARTAMENTO_ID => $linha->departamento_id,
					SESSION_DEPARTAMENTO_NOME => ($this->DepartamentoDAO->buscarPorId($linha->departamento_id))->sigla,
					SESSION_STATUS => $linha->status,
					SESSION_HIERARQUIA_ID => $linha->hierarquia_id,
					SESSION_FUNCAO_ID => $linha->funcao_id,
					SESSION_HIERARQUIA_SIGLA => ($this->HierarquiaDAO->buscarPorId($linha->hierarquia_id)->sigla),
					SESSION_FUNCAO_NIVEL_DE_ACESSO => ($this->FuncaoDAO->buscarPorId($linha->funcao_id)->nivelDeAcesso->nome()),
				)
			);
		}

		redirect('ProcessoController');
	}

}
