<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ArquivoController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (!isset($this->session->email)) {

			$this->load->view('login.php');

		} else {
			$this->listar();
		}
	}


	public function listar($indice = 1)
	{
		$indice--;

		$mostrar = 10;
		$indiceInicial = $indice * $mostrar;

		$arquivos = $this->ArquivoDAO->retrive($indiceInicial, $mostrar);

		$quantidade = $this->ArquivoDAO->count_rows();

		$botoes = empty($arquivos) ? '' : $this->botao->paginar('arquivo/listar', $indice, $quantidade, $mostrar);

		$dados = array(
			'titulo' => 'Lista de arquivos',
			'tabela' => $this->tabela->arquivo($arquivos, $indiceInicial),
			'pagina' => 'arquivo/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);
	}

	public function novo()
	{

		$dados = array(
			'titulo' => 'Novo arquivo',
			'pagina' => 'arquivo/novo.php',
			'processos' => $this->ProcessoDAO->options()
		);

		$this->load->view('index', $dados);
	}

	public function criar()
	{
		$data_post = $this->input->post();

		$arquivo = $_FILES['arquivo'];

		if (isset($arquivo) && isset($data_post)) {

			$tmp_name = $_FILES['arquivo']['tmp_name'];
			$nomeDoArquivo = $_FILES['arquivo']['name'];
			$novoNomeDoArquivo = uniqid();
			$extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
			$path = 'arquivos/' . $novoNomeDoArquivo . '.' . $extensao;


			$arquivado = move_uploaded_file($tmp_name, $path);

			if ($arquivado) {

				$timezone = new DateTimeZone('America/Sao_Paulo');
				$agora = new DateTime('now', $timezone);

				$arquivo = new Arquivo(
					null,
					$this->ArtefatoDAO->retriveId($data_post['artefatoId']),
					$path,
					$nomeDoArquivo,
					$agora->format('Y-m-d H:m:s'),
					$this->ProcessoDAO->retriveId($data_post['processo_id']),
					$data_post['status']
				);

				$this->ArquivoDAO->create($arquivo);

				redirect('ArquivoController');
			}

		}

	}

	public function alterar($id)
	{

		$arquivo = $this->ArquivoDAO->retriveId($id);

		$dados = array(
			'titulo' => 'Alterar Arquivo',
			'pagina' => 'arquivo/alterar.php',
			'arquivo' => $arquivo,
			'processos' => $this->ProcessoDAO->options()

		);

		$this->load->view('index', $dados);

	}

	public function atualizar()
	{

		$data = $this->input->post();

		$data_hora = new DateTime($data['data_do_upload']);


		$arquivo = new Arquivo(
			$data['id'],
			$this->ArtefatoDAO->retriveId($data['artefatoId']),
			$data['path'],
			$data['nome_do_arquivo'],
			$data_hora->format('Y-m-d H:m:s'),
			$this->ProcessoDAO->retriveId($data['processo_id']),
			$data['status']
		);

		$this->ArquivoDAO->update($arquivo);

		redirect('ArquivoController');
	}

	public function deletar($id)
	{

		$this->ArquivoDAO->delete($id);

		redirect('ArquivoController');
	}

}