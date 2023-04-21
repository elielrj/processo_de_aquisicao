<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class ProcessoController extends CI_Controller {

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


	function listar($indice = 1)
	{
		$indice--;                

		$mostrar = 10;
		$indiceInicial  = $indice * $mostrar;

		$processos = $this->ProcessoDAO->retrive($indiceInicial,$mostrar);
		
		$quantidade = $this->ProcessoDAO->count_rows();

		$botoes = empty($processos) ? '' : $this->botao->paginar('processo/listar',$indice,$quantidade,$mostrar);

		$dados = array(
			'titulo'=> 'Lista de processos',
			'tabela'=> $this->tabela->processo($processos,$indiceInicial),
			'pagina'=> 'processo/index.php',
			'botoes'=> $botoes,
		);
		
		$this->load->view('index',$dados);
	}

	public function pregrao($indice = 1)
	{
		$indice--;                

		$mostrar = 10;
		$indiceInicial  = $indice * $mostrar;

		$processos = $this->ProcessoDAO->retrive($indiceInicial,$mostrar);
		
		$quantidade = $this->ProcessoDAO->count_rows();

		$botoes = empty($processos) ? '' : $this->botao->paginar('processo/listarPregoes',$indice,$quantidade,$mostrar);

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

	public function novoPregao(){
		$this->load->view(
			'index',
			[
				'titulo' => 'Novo Processo de Pregão',
				'pagina' => 'processo/novo_pregao.php',
			]
		);
	}
	public function criar(){

		$data = $this->input->post();

		$timezone = new DateTimeZone('America/Sao_Paulo');
		$agora = new DateTime('now', $timezone);

		$processo = new Processo(
			null,
			$data['objeto'],
			$data['nup_nud'],
			$agora->format('Y-m-d H:m:s'),
			uniqid(),
			$this->session->id,
			true
		);

		$this->ProcessoDAO->criar($processo);
		redirect('ProcessoController');
	}

	public function criarPregao(){

		$data = $this->input->post();

		$timezone = new DateTimeZone('America/Sao_Paulo');
		$agora = new DateTime('now', $timezone);

		$processo = new Processo(
			null,
			$data['objeto'],
			$data['nup_nud'],
			$agora->format('Y-m-d H:m:s'),
			uniqid(),
			$this->session->id,
			true
		);

		$this->ProcessoDAO->criar($processo);
		redirect('ProcessoController');
	}

	public function alterar($id){        

		$processo = $this->ProcessoDAO->retriveId($id);
		$processos = $this->ProcessoDAO->retrive(null,null);
		
		
		$dados = array(
			'titulo' => 'Alterar Processo',
			'pagina' => 'processo/alterar.php',
			'processo' => $processo,
			'processos' => $this->Opcao->processo($processos),
		);

		$this->load->view('index',$dados);
           
	}

	public function atualizar(){
                    
		$data = $this->input->post();		

		$processo = new Processo(
			$data['id'],
			$data['objeto'],
			$data['nup_nud'],
			null,
			null,
			$this->session->id,
			null
		);

		$this->ProcessoDAO->update($processo);

		redirect('ProcessoController');            
	}

	public function deletar($id){

		$this->ProcessoDAO->delete($id);
                
		redirect('ProcessoController');          
	}
	
}
