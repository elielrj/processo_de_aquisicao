<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Processo_Controller extends CI_Controller {

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

		$processos = $this->Processo_Model->retrive($indiceInicial,$mostrar);
		
		$quantidade = $this->Processo_Model->quantidade();

		$botoes = empty($processos) ? '' : $this->botao->paginar('processo/listar',$indice,$quantidade,$mostrar);

		$dados = array(
			'titulo'=> 'Lista de processos',
			'tabela'=> $this->tabela->processo($processos,$indiceInicial),
			'pagina'=> 'processo/index.php',
			'botoes'=> $botoes,
		);
		
		$this->load->view('index',$dados);
	}

	public function novo(){

		$dados = array(
			'titulo' => 'Novo Processo',
			'pagina' => 'processo/novo.php',
		);

		$this->load->view('index', $dados); 
	}

	public function criar(){

		$data = $this->input->post();

		$timezone = new DateTimeZone('America/Sao_Paulo');
		$agora = new DateTime('now', $timezone);

		$processo = $this->Processo_Model->processo(
			null,
			$data['objeto'],
			$data['nup_nud'],
			$agora->format('Y-m-d H:m:s'),
			uniqid(),
			1,
			true
		);

		$this->Processo_Model->criar($processo);
		redirect('processo');
	}

	public function alterar($id){        

		$tabela = $this->Processo_Model->retriveId($id);
		
		$dados = array(
			'titulo' => 'Alterar Processo',
			'pagina' => 'processo/alterar.php',
			'tabela' => $tabela
		);

		$this->load->view('index',$dados);
           
	}

	public function atualizar(){
                    
		$data = $this->input->post();		

		$processo = $this->Processo_Model->processo(
			$data['id'],
			$data['objeto'],
			$data['nup_nud'],
			null,
			null,
			null,
			null
		);

		$this->Processo_Model->update($processo);

		redirect('processo');            
	}

	public function deletar($id){

		$this->Processo_Model->delete($id);
                
		redirect('processo');          
	}

	
}
