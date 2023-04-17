<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arquivo extends CI_Controller {

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

		$arquivos = $this->Arquivo_Model->retrive($indiceInicial,$mostrar);
		
		$quantidade = $this->Arquivo_Model->quantidade();

		$botoes = empty($arquivos) ? '' : $this->botao->paginar('arquivo/listar',$indice,$quantidade,$mostrar);

		$dados = array(
			'titulo'=> 'Lista de arquivos',
			'tabela'=> $this->tabela->arquivo($arquivos,$indiceInicial),
			'pagina'=> 'arquivo/index.php',
			'botoes'=> $botoes,
		);
		
		$this->load->view('index',$dados);
	}

	public function novo(){

		$processos = $this->Processo_Model->retrive(null,null);

		

		$dados = array(
			'titulo' => 'Novo arquivo',
			'pagina' => 'arquivo/novo.php',
			'processos' => $this->options($processos),
	
		);

		$this->load->view('index', $dados); 
	}

	public function criar(){

		$data = $this->input->post();

		var_dump($data);
		//var_dump($data['arquivo']['type']);
		//var_dump($data['arquivo']['tmp_name']);
		//var_dump($data['arquivo']['error']);
		//var_dump($data['arquivo']['size']);

		$config['upload_path'] = base_url('arquivos');
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		//$config['max_size']     = (10 * 1024 * 1024);

		$this->upload->initialize($config);

		if(!$this->upload->do_upload('arquivo')){
			
			$erro = array('error' => $this->upload->display_errors());

			//todo
			var_dump($erro);

		}else{
			$data = array('upload_data' => $this->upload->data());

			//todo

			var_dump($data);

		}

		$timezone = new DateTimeZone('America/Sao_Paulo');
		$agora = new DateTime('now', $timezone);

		$arquivo = $this->Arquivo_Model->arquivo(
			null,
			$data['nome'],
			$data['path'],
			$data['nomeDoArquivo'],
			$data['dataDoUpload'],
			1 //todo
		);

		$this->Arquivo_Model->criar($arquivo);

		//$this->upload();

		redirect('arquivo');
	}

	public function alterar($id){        

		$tabela = $this->Arquivo_Model->retriveId($id);
		
		$dados = array(
			'titulo' => 'Alterar Arquivo',
			'pagina' => 'arquivo/alterar.php',
			'tabela' => $tabela
		);

		$this->load->view('index',$dados);
           
	}

	public function atualizar(){
                    
		$data = $this->input->post();		

		$arquivo = $this->Arquivo_Model->arquivo(
			$data['id'],
			$data['nome'],
			$data['path'],
			$data['nomeDoArquivo'],
			$data['dataDoUpload'],
			$data['processoId']
		);

		$this->Arquivo_Model->update($arquivo);

		redirect('arquivo');            
	}

	public function deletar($id){

		$this->Arquivo_Model->delete($id);
                
		redirect('arquivo');          
	}

	public function options($processos){

		return empty($processos) ? '' : ($this->opcao->processo($processos));         
	}

	public function upload(){

		$config['upload_path'] = 'arquivos/';
		$config['allowed_types'] = 'pdf';
		$config['max_size']     = (10 * 1024 * 1024);

		$this->upload->initialize($config);

		if(!$this->upload->do_upload('userfile')){
			
			$erro = array('error' => $this->upload->display_errors());

			//todo
			var_dump($erro);

		}else{
			$data = array('upload_data' => $this->upload->data());

			//todo

			var_dump($data);

		}
	}
}
