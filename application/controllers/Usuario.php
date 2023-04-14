<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
		$this->listar();
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
			md5($data['senha'])
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
			md5($data['senha'])
		);

		$this->Usuario_Model->update($usuario);

		redirect('usuario');            
	}

	public function deletar($id){

		$this->Usuario_Model->delete($id);
                
		redirect('usuario');          
	}
}
