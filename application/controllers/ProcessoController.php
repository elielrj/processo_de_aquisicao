<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';
use Dompdf\Dompdf;

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

		$botoes = empty($processos) ? '' : $this->botao->paginar('ProcessoController/listar',$indice,$quantidade,$mostrar);

		$dados = array(
			'titulo'=> 'Lista de processos',
			'tabela'=> $this->tabela->processo($processos,$indiceInicial, null),
			'pagina'=> 'processo/index.php',
			'botoes'=> $botoes,
		);
		
		$this->load->view('index',$dados);
		
	}

	public function novo(){

		$usuarioAtual = $this->UsuarioDAO->retriveId($this->session->id);

		$dados = array(
			'titulo' => 'Novo Processo',
			'pagina' => 'processo/novo.php',
			'departamentos' => $this->DepartamentoDAO->options(),
			'departamento' => $usuarioAtual->departamento->id,
		);

		$this->load->view('index', $dados); 
	}

	public function criar(){

		$data = $this->input->post();
		
		$processo = new Processo(
			null,
			$data['objeto'],
			$data['nup_nud'],
			$data['data_do_processo'],
			$data['chave_de_acesso'],			
			$this->DepartamentoDAO->retriveId($data['departamento_id']),
			$data['status']
		);

		$this->ProcessoDAO->create($processo);

		redirect('ProcessoController');
	}

	public function alterar($id){        

		$processo = $this->ProcessoDAO->retriveId($id);		
		
		$dados = array(
			'titulo' => 'Alterar Processo',
			'pagina' => 'processo/alterar.php',
			'processo' => $processo,
			'departamentos' => $this->DepartamentoDAO->options(),
		);

		$this->load->view('index',$dados);
           
	}

	public function atualizar(){
                    
		$data = $this->input->post();		

		$processo = new Processo(
			$data['id'],
			$data['objeto'],
			$data['nup_nud'],
			$data['data_do_processo'],
			$data['chave_de_acesso'],
			$this->DepartamentoDAO->retriveId($data['departamento_id']),
			$data['status']
		);

		$this->ProcessoDAO->update($processo);

		redirect('ProcessoController');            
	}

	public function deletar($id){

		$this->ProcessoDAO->delete($id);
                
		redirect('ProcessoController');          
	}

	public function imprimir(){
		
		$dompdf = new Dompdf();

		/*
		$dados = [
			'tabela' => $this->tabela->processo(null, null),
			'titulo' => 'Lista de Processos',
			'botoes' => []

		];*/

		//$pagina_html = $this->load->view('processo/index.php',$dados);

		$dompdf->loadHtml('teste');

		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream();
	}
	
}
