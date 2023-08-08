<?php


class LoginController extends CI_Controller
{
	const EMAIL = 'email';
	const SENHA = 'senha';
	const EMAIL_VALIDO = 'email_valido';
	const SENHA_VALIDA = 'senha_valida';

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('login.php');
	}

	function logar()
	{
		$this->session->unset_userdata(
			'email_valido',
			'senha_valida',
			'numero_valido',
			'chave_valida'
		);

		$email = $this->input->post(self::EMAIL);
		$senha = $this->input->post(self::SENHA);

		$this->load->model('dao/UsuarioDAO');

		$where = [self::EMAIL => $email];

		$arrayLinha = $this->UsuarioDAO->buscarAonde($where);

		if ($arrayLinha->num_rows() === 1) {

			$this->session->set_userdata(self::EMAIL_VALIDO, true);

			$where = [
				self::EMAIL => $email,
				self::SENHA => md5($senha)
			];

			$arrayLinha = $this->UsuarioDAO->buscarAonde($where);

			if ($arrayLinha->num_rows() === 1) {

				$this->session->set_userdata(self::SENHA_VALIDA, true);

				$this->session->set_userdata(
					array(
						self::EMAIL => $email,
						self::SENHA => md5($senha)
					)
				);

				redirect('UsuarioController/buscarDadosDoUsuarioLogado');

			} else {

				$this->session->set_userdata(self::SENHA_VALIDA, false);

				$this->load->view('login.php');
			}
		} else {

			$this->session->set_userdata(self::EMAIL_VALIDO, false);

			$this->load->view('login.php');
		}
	}

	public function sair()
	{
		session_destroy();

		$this->load->view('login.php');
	}
}
