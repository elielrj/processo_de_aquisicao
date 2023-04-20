<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Controller extends CI_Controller {



	public function index()
	{
		if(!isset($this->session->email)){

			$this->load->view('login.php');

		}else{
			$this->listar();
		}
	}


	public function listar($indice = 1)
	{
		$indice--;                

		$mostrar = 10;
		$indiceInicial  = $indice * $mostrar;

		$usuarios = $this->UsuarioDAO->retrive($indiceInicial,$mostrar);
		
		$quantidade = $this->UsuarioDAO->quantidade();

		$botoes = empty($usuarios) ? '' : $this->botao->paginar('usuario/listar',$indice,$quantidade,$mostrar);

		$dados = array(
			'titulo'=> 'Lista de Usuários',
			'tabela'=> $this->tabela->usuario($usuarios,$indiceInicial),
			'pagina'=> 'usuario/index.php',
			'botoes'=> $botoes,
		);
		
		$this->load->view('index',$dados);
	}

	public function novo(){

		$dados = array(
			'titulo' => 'Novo Usuário',
			'pagina' => 'usuario/novo.php',
		);

		$this->load->view('index', $dados); 
	}

	public function criar(){

		$data = $this->input->post();

		$timezone = new DateTimeZone('America/Sao_Paulo');
		$agora = new DateTime('now', $timezone);

		$usuario = $this->UsuarioDAO->usuario(
			null,
			$data['email'],
			$data['cpf'],
			md5($data['senha']),
			true
		);

		$this->UsuarioDAO->create($usuario);
		redirect('usuario');
	}

	public function alterar($id){        

		$tabela = $this->UsuarioDAO->retriveId($id);
		
		$dados = array(
			'titulo' => 'Alterar Usuário',
			'pagina' => 'usuario/alterar.php',
			'tabela' => $tabela
		);

		$this->load->view('index',$dados);
           
	}

	public function atualizar(){
                    
		$data = $this->input->post();		

		$usuario = $this->UsuarioDAO->usuario(
			null,
			$data['email'],
			$data['cpf'],
			md5($data['senha']),
			true
		);

		$this->UsuarioDAO->update($usuario);

		redirect('usuario');            
	}

	public function deletar($id){

		$this->UsuarioDAO->delete($id);
                
		redirect('usuario');          
	}

	public function logar(){

		if($this->verificarEmail()){
		
			if($this->verificarSenha()){

				$this->criarSessao();
				
				redirect('Processo_Controller');
			}

		}

		redirect(base_url());
	}

	public function verificarEmail(){

		$email = $this->input->post('email');

		$where = array('email' => $email);

		
		$resultado = $this->UsuarioDAO->verificarEmail($where); 


		if(isset($resultado[0])){

			$this->session->set_userdata('email_valido',true);

		}else{
			$this->session->set_userdata('email_valido',false);
		}

		return isset($resultado[0]);

	}

	public function verificarSenha(){

		$senha = md5($this->input->post('senha'));

		$where = array('senha' => $senha);

		$resultado = $this->UsuarioDAO->verificarSenha($where);

		if(isset($resultado[0])){

			$this->session->set_userdata('senha_valida',true);

		}else{
			$this->session->set_userdata('senha_valida',false);
		}

		return isset($resultado[0]);
	}

	public function criarSessao(){

		$email = $this->input->post('email');            
		
		$usuario = $this->UsuarioDAO->retriveEmail($email);
	
		$data = array(
			'id' => $usuario->id,
			'email' => $usuario->email,
			'status' => $usuario->status,
			'cpf' => $usuario->cpf
		); 

		$this->Sessao_Model->criar($data);          
	}

	public function retriveEmail($email){
            
		$resultado = 
		$this->db->get_where(
			self::$TABELA_DB,
			array('email'=> $email)
		);   
		
		return $this->UsuarioDAO->montarObjetoUsuario($resultado->result());
	}

	public function sair()
	{
		$this->Sessao_Model->remover();

		redirect(base_url());
	}
}
