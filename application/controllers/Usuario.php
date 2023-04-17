<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

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

		$usuarios = $this->Usuario_Model->retrive($indiceInicial,$mostrar);
		
		$quantidade = $this->Usuario_Model->quantidade();

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

		$usuario = $this->Usuario_Model->usuario(
			null,
			$data['email'],
			$data['cpf'],
			md5($data['senha']),
			true
		);

		$this->Usuario_Model->criar($usuario);
		redirect('usuario');
	}

	public function alterar($id){        

		$tabela = $this->Usuario_Model->retriveId($id);
		
		$dados = array(
			'titulo' => 'Alterar Usuário',
			'pagina' => 'usuario/alterar.php',
			'tabela' => $tabela
		);

		$this->load->view('index',$dados);
           
	}

	public function atualizar(){
                    
		$data = $this->input->post();		

		$usuario = $this->Usuario_Model->usuario(
			null,
			$data['email'],
			$data['cpf'],
			md5($data['senha']),
			true
		);

		$this->Usuario_Model->update($usuario);

		redirect('usuario');            
	}

	public function deletar($id){

		$this->Usuario_Model->delete($id);
                
		redirect('usuario');          
	}

	public function logar(){

		if($this->verificarEmail()){
		
			if($this->verificarSenha()){

				$this->criarSessao();
				
				redirect('processo');
			}

		}

		redirect(base_url());
	}

	public function verificarEmail(){

		$email = $this->input->post('email');

		$where = array('email' => $email);

		
		$resultado = $this->Usuario_Model->verificarEmail($where); 


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

		$resultado = $this->Usuario_Model->verificarSenha($where);

		if(isset($resultado[0])){

			$this->session->set_userdata('senha_valida',true);

		}else{
			$this->session->set_userdata('senha_valida',false);
		}

		return isset($resultado[0]);
	}

	public function criarSessao(){

		$email = $this->input->post('email');            
		
		$usuario = $this->Usuario_Model->retriveEmail($email);
	
		$data = array(
			'id' => $usuario[0]['id'],
			'email' => $usuario[0]['email'],
			'status' => $usuario[0]['status'],
			'cpf' => $usuario[0]['cpf']
		); 

		$this->Sessao_Model->criar($data);          
	}

	public function retriveEmail($email){
            
		$resultado = 
		$this->db->get_where(
			self::$TABELA_DB,
			array('email'=> $email)
		);   
		
		return $this->Usuario_Model->montarObjetoUsuario($resultado->result());
	}

	public function sair()
	{
		$this->Sessao_Model->remover();

		redirect(base_url());
	}
}
