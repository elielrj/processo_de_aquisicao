<?php

require_once 'abstract_controller/AbstractController.php';
include_once 'application/models/bo/Usuario.php';

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

		$this->load->library('CriadorDeBotoes',
			array_to_criador_de_botoes_helper(
				self::USUARIO_CONTROLLER . '/listar',
				$this->contarRegistrosAtivos() ?? 0
			)
		);

		$dados = array(
			'titulo' => 'Lista de Usuários',
			'tabela' => $this->buscarTodosAtivos($indice_no_data_base, $qtd_de_itens_para_exibir),
			'pagina' => 'usuario/index.php',
			'botoes' => $this->criadordebotoes->listar($indice),
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



	public function buscarDadosDoUsuarioLogado()
	{
		if (isset($_SESSION[SESSION_EMAIL], $_SESSION[SESSION_SENHA])) {

			$where = array(
				EMAIL => $_SESSION[SESSION_EMAIL],
				SENHA => $_SESSION[SESSION_SENHA]
			);

			$this->load->model('dao/UsuarioDAO');

			$array = $this->UsuarioDAO->buscarAonde($where);

			$usuario = $this->toObject($array->result()[0]);

			$this->session->set_userdata(
				array(
					SESSION_ID => $usuario->id,
					SESSION_NOME_DE_GUERRA => $usuario->nomeDeGuerra,
					SESSION_NOME_COMPLETO => $usuario->nomeCompleto,
					SESSION_EMAIL => $usuario->email,
					SESSION_CPF => $usuario->cpf,
					SESSION_SENHA => (md5($usuario->senha)),
					SESSION_DEPARTAMENTO_ID => $usuario->departamento->id,
					SESSION_DEPARTAMENTO_NOME => ($this->departamento->sigla),
					SESSION_STATUS => $usuario->status,
					SESSION_HIERARQUIA_ID => $usuario->hierarquia->id,
					SESSION_FUNCAO_ID => $usuario->funcao->id,
					SESSION_HIERARQUIA_SIGLA => ($this->hierarquia->sigla),
					SESSION_FUNCAO_NIVEL_DE_ACESSO => ($this->funcao->nome()),
				)
			);
var_dump($_SESSION);
			redirect(ProcessoController::PROCESSO_CONTROLLER);
		} else {
			redirect('LoginController');
		}

	}

	public function contarRegistrosAtivos()
	{
		$this->load->model('dao/UsuarioDAO');

		return $this->UsuarioDAO->contarRegistrosAtivos();
	}

	public function contarRegistrosInativos()
	{
		$this->load->model('dao/UsuarioDAO');

		return $this->UsuarioDAO->contarRegistrosInativos();
	}

	public function contarTodosOsRegistros()
	{
		$this->load->model('dao/UsuarioDAO');

		return $this->UsuarioDAO->contarTodosOsRegistros();
	}

	public function contarTodosOsRegistrosAonde($where)
	{
		$this->load->model('dao/UsuarioDAO');
		return $this->UsuarioDAO->contarTodosOsRegistrosAonde($where);
	}

	public function excluirDeFormaPermanente($id)
	{
		$this->load->model('dao/UsuarioDAO');

		$this->UsuarioDAO->excluirDeFormaPermanente($id);
	}

	public function excluirDeFormaLogica($id)
	{
		$this->load->model('dao/UsuarioDAO');

		$this->UsuarioDAO->excluirDeFormaLogica($id);
	}

	public function options()
	{
		$this->load->model('dao/UsuarioDAO');

		return $this->UsuarioDAO->options();
	}

	public function recuperar($id)
	{
		$this->load->model('dao/UsuarioDAO');

		$this->UsuarioDAO->recuperar($id);

		redirect(self::USUARIO_CONTROLLER . '/listar');
	}

	public function buscarPorId($id)
	{
		$this->load->model('dao/UsuarioDAO');

		$array = $this->UsuarioDAO->buscarPorId($id);

		return $this->toObject($array->result()[0]);
	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		$this->load->model('dao/UsuarioDAO');

		$array = $this->UsuarioDAO->buscarTodosAtivos($inicio, $fim);

		return $this->toObject($array->result()[0]);
	}

	public function buscarTodosInativos($inicio, $fim)
	{
		$this->load->model('dao/UsuarioDAO');

		$array = $this->UsuarioDAO->buscarTodosInativos($inicio, $fim);

		return $this->toObject($array->result()[0]);
	}

	public function buscarTodosStatus($inicio, $fim)
	{
		$this->load->model('dao/UsuarioDAO');

		$array = $this->UsuarioDAO->buscarTodosStatus($inicio, $fim);

		return $this->toObject($array->result()[0]);
	}

	public function buscarAonde($where)
	{
		$this->load->model('dao/UsuarioDAO');

		$array = $this->UsuarioDAO->buscarAonde($where);

		return $this->toObject($array->result()[0]);
	}

	public function buscarAondeComInicioEFim($whare, $inicio, $fim)
	{
		$this->load->model('dao/UsuarioDAO');

		$array = $this->UsuarioDAO->buscarAondeComInicioEFim($whare, $inicio, $fim);

		return $this->toObject($array->result()[0]);
	}

}
