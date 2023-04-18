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

		$dados = array(
			'titulo' => 'Novo arquivo',
			'pagina' => 'arquivo/novo.php',
			'processos' => $this->options()
		);

		$this->load->view('index', $dados); 
	}

	public function criar(){

		
		
		$data_post = $this->input->post();

		$arquivo = $_FILES['arquivo'];

		if(isset($arquivo) && isset($data_post)){		
			

			$tmp_name = $_FILES['arquivo']['tmp_name'];
			$nomeDoArquivo = $_FILES['arquivo']['name'];
			$novoNomeDoArquivo = uniqid();
			$extensao = strtolower(pathinfo($nomeDoArquivo,PATHINFO_EXTENSION));
			$path = 'arquivos/' . $novoNomeDoArquivo . '.' . $extensao;
			

			$arquivado = move_uploaded_file($tmp_name,$path);

			if($arquivado){

				$timezone = new DateTimeZone('America/Sao_Paulo');
				$agora = new DateTime('now', $timezone);

				$arquivo = $this->Arquivo_Model->arquivo(
					null,
					$nomeDoArquivo,
					$path,
					$novoNomeDoArquivo,
					$agora->format('Y-m-d H:m:s'),
					$data_post['processo_id'], 
					$this->session->id,
					true
				);

				$this->Arquivo_Model->criar($arquivo);

				redirect('arquivo');
			}

		}
		
	}

	public function alterar($id){        

		$tabela = $this->Arquivo_Model->retriveId($id);
		
		$dados = array(
			'titulo' => 'Alterar Arquivo',
			'pagina' => 'arquivo/alterar.php',
			'tabela' => $tabela,
			'processos' => $this->options()

		);

		$this->load->view('index',$dados);
           
	}

	public function atualizar(){
                    
		$data = $this->input->post();	
		
    	$data_hora = new DateTime($data['data_do_upload']);


		$arquivo = $this->Arquivo_Model->arquivo(
			$data['id'],
			$data['nome'],
			$data['path'],
			$data['nome_do_arquivo'],
			$data_hora->format('Y-m-d H:m:s'),
			$data['processo_id'],
			$data['usuario_id'],
			$data['status']
		);

		$this->Arquivo_Model->update($arquivo);

		redirect('arquivo');            
	}

	public function deletar($id){

		$this->Arquivo_Model->delete($id);
                
		redirect('arquivo');          
	}

	public function options(){

		$processos = $this->Processo_Model->retrive(null,null);

		if(! empty($processos)){

			$options = [];
			
			foreach($processos as $processo){
				
				$option = array($processo['id'] => $processo['objeto'] . '('. $processo['nup_nud'] . ')');

				array_push($options,$option);
			}
		}

		return $options;        
	}

	private function upload(){
/*
		$config['upload_path'] = './arquivos/';
		$config['allowed_types'] = 'pdf';
		$config['max_size'] = (10 * 1024 * 1024);
		$config['overwrite'] = uniqid();
		$config['file_ext_tolower'] = true;
		$config['max_filename'] = 250;

		$this->load->initialize($config);
		

		if ( ! $this->upload->do_upload('userfile'))
		{
			return array('error' => $this->upload->display_errors());
		}
		else
		{
			return array('upload_data' => $this->upload->data());
		}*/

		
		
		

		
	}

}
