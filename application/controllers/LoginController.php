<?php


class LoginController extends CI_Controller
{
	const EMAIL = 'email';
	const SENHA = 'senha';
	const TABELA_USUARIO = 'usuario';
	const EMAIL_VALIDO = 'email_valido';
	const SENHA_VALIDA = 'senha_valida';

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->isSessionEmail() ? $this->logarComSessao() : $this->loadViewLogin();
	}

	private function isSessionEmail()
	{
		return is_session_email_helper();
	}

	private function isSessionSenha()
	{
		return isset($_SESSION[SESSION_SENHA]);
	}

	private function redirectUsuarioController()
	{
		redirect('UsuarioController');
	}

	private function loadViewLogin()
	{
		$this->load->view('login.php');
	}

	private function logarComSessao()
	{
		if ($this->isSessionSenha() && $this->isSessionEmail()) {

			$this->login($_SESSION[self::EMAIL], $_SESSION[self::SENHA]);

		} else {
			$this->loadViewLogin();
		}
	}

	function logar()
	{
		$this->limparValidacao();

		$email = $this->input->post(self::EMAIL);
		$senha = $this->input->post(self::SENHA);


		if ($this->emailExiste($email)) {

			if ($this->senhaEstaCorreta($email, md5($senha))) {

				$this->redirectUsuarioController();

			} else {

				$this->loadViewLogin();
			}
		} else {

			$this->loadViewLogin();
		}
	}

	private
	function login($email, $senha)
	{
		$this->load->model('dao/UsuarioDAO');

		$where = [self::EMAIL => $email];

		$arrayLinha = $this->UsuarioDAO->buscarAonde($where);

		$arrayLinha->num_rows() === 1
			? $this->redirectUsuarioController()
			: $this->loadViewLogin();
	}

	private function emailExiste($email)
	{
		$this->load->model('dao/UsuarioDAO');

		$where = [self::EMAIL => $email];

		$arrayLinha = $this->UsuarioDAO->buscarAonde($where);

		if ($arrayLinha->num_rows() === 1) {

			$this->emailExiste(true);

			return true;

		} else {

			$this->emailExiste(false);

			return false;
		}
	}

	private function senhaEstaCorreta($email, $senha)
	{
		$this->load->model('dao/UsuarioDAO');

		$where = [
			self::EMAIL => $email,
			self::SENHA => $senha
		];

		$arrayLinha = $this->UsuarioDAO->buscarAonde($where);

		if ($arrayLinha->num_rows() === 1) {

			$this->senhaEstaValida(true);

			return true;

		} else {

			$this->senhaEstaValida(false);

			return false;
		}
	}

	private function emailEstaValido($validade)
	{
		$this->session->set_userdata(self::EMAIL_VALIDO, $validade);
	}

	private function senhaEstaValida($validade)
	{
		$this->session->set_userdata(self::SENHA_VALIDA, $validade);
	}

	public function sair()
	{
		session_destroy();

		$this->loadViewLogin();
	}

	private function limparValidacao()
	{
		$this->session->unset_userdata(
			'email_valido',
			'senha_valida',
			'numero_valido',
			'chave_valida'
		);
	}
}
