<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';
use Dompdf\Dompdf;

require_once('PDFMerger/PDFMerger.php');
use PDFMerger\PDFMerger;


class ProcessoController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dao/ProcessoDAO');
		$this->load->model('dao/DepartamentoDAO');
		$this->load->model('dao/ModalidadeDAO');
		$this->load->model('dao/TipoDAO');
		$this->load->model('dao/LeiDAO');
		$this->load->model('dao/UsuarioDAO');
		$this->load->model('dao/AndamentoDAO');
		$this->load->library('ProcessoLibrary');
		$this->load->library('session');
		$this->load->library('DataLibrary');
	}

	public function index()
	{
		if (!isset($this->session->email)) {
			header("Location:" . base_url());
		} else {
			$this->listar();
		}
	}


	function listar($indice = 1)
	{
		$indice--;

		$mostrar = 10;
		$indiceInicial = $indice * $mostrar;

		$processos = $this->ProcessoDAO->buscarTodos($indiceInicial, $mostrar);

		$quantidade = $this->ProcessoDAO->contar();

		$botoes = empty($processos) ? '' : $this->botao->paginar('processos', $indice, $quantidade, $mostrar);

		$dados = array(
			'titulo' => 'Lista de processos',
			'tabela' => $this->processolibrary->listar($processos, $indiceInicial),
			'pagina' => 'processo/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);

	}

	public function exibir($id)
	{
		$processo = $this->ProcessoDAO->buscarPorId($id);

		$this->load->library('ProcessoExibirLibrary');

		$this->load->view('index', [
			'titulo' => 'Processo: ' . $processo->tipo->nome,
			'tabela' => $this->processoexibirlibrary->listar($processo),
			'pagina' => 'processo/exibir.php',
		]);
	}

	public function visualizarProcesso($id)
	{
		$processo = $this->ProcessoDAO->buscarPorId($id);

		 $this->load->library('ProcessoVisualizarLibrary');

		$this->load->view('index', [
			'titulo' => 'Processo: ' . $processo->tipo->nome,
			'tabela' => $this->processovisualizarlibrary->visualizar($processo),
			'pagina' => 'processo/visualizar.php',
		]);
	}

	public function imprimirProcesso($id)
	{
		$processo = $this->ProcessoDAO->buscarPorId($id);
		/*
		$html = $this->load->view('index/processo/visualizar.php', [
		'titulo' => 'Processo: '. $processo->tipo->nome ,
		'tabela' => $this->tabela->processo_imprimir($processo),
		//'pagina' => 'processo/visualizar.php',
		]);*/

		 //$this->load->library('ProcessoImprimirLibrary');

		//$html = $this->processoimprimirlibrary->imprimir($processo);

		$this->imprimir($processo->tipo->listaDeArtefatos);

	}

	public function novo()
	{
		
		$usuarioAtual = $this->UsuarioDAO->buscarPorId($this->session->id);

		$lei_e_modalidade_pre_definido = 1;

		$dados = array(
			'titulo' => 'Novo Processo',
			'pagina' => 'processo/novo.php',
			'departamentos' => $this->DepartamentoDAO->options(),
			'departamento' => $usuarioAtual->departamento->id,
			'modalidades' => $this->ModalidadeDAO->options(),
			'tipos' => $this->TipoDAO->options(),
			'leis' => $this->LeiDAO->options($lei_e_modalidade_pre_definido),
			'lei_e_modalidade_pre_definido' => $lei_e_modalidade_pre_definido
		);

		$this->load->view('index', $dados);
	}

	public function criar()
	{

		$data_post = $this->input->post();

		$processo = new Processo(
			null,
			$data_post['objeto'],
			$data_post['numero'],
			DataLibrary::dataHoraMySQL(),
			uniqid(),
			$this->DepartamentoDAO->buscarPorId($this->session->departamento_id),
			$this->LeiDAO->buscarPorId($data_post['lei_id']),
			$this->TipoDAO->buscarPorId($data_post['tipo_id']),
			$data_post['completo'],
			null,
			true
		);

		$processo_id = $this->ProcessoDAO->criar($processo);

		redirect("ProcessoController/exibir/{$processo_id}");
	}

	public function alterar($id)
	{

		$processo = $this->ProcessoDAO->buscarPorId($id);

		$dados = array(
			'titulo' => 'Alterar Processo',
			'pagina' => 'processo/alterar.php',
			'processo' => $processo,
			'departamentos' => $this->DepartamentoDAO->options(),
			'modalidades' => $this->ModalidadeDAO->options(),

		);

		$this->load->view('index', $dados);

	}

	public function atualizar()
	{

		$data_post = $this->input->post();

		$processo = new Processo(
			$data_post['id'],
			$data_post['objeto'],
			$data_post['numero'],
			$this->data->dataHoraMySQL(),
			$data_post['chave'],
			$this->DepartamentoDAO->buscarPorId($data_post['departamento_id']),
			$this->ModalidadeDAO->buscarPorId($data_post['modalidade_id']),
			$data_post['completo'],
			$data_post['status']
		);

		$this->ProcessoDAO->atualizar($processo);

		redirect('ProcessoController');
	}

	public function deletar($id)
	{

		$this->ProcessoDAO->delete($id);

		redirect('ProcessoController');
	}

	public function imprimir($listaDeArtefatos)
	{
/*
		$dompdf = new Dompdf();

	
		$dados = [
		'tabela' => $this->tabela->processo(null, null),
		'titulo' => 'Lista de Processos',
		'botoes' => []
		];

		//$pagina_html = $this->load->view('processo/index.php',$dados);

		$dompdf->loadHtml($html);

		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream();
*/

		//require_once('PDFMerger/PDFMerger.php');

		//include 'PDFMerger/PDFMerger.php';

		$pdf = new PDFMerger;

		foreach($listaDeArtefatos as $artefato)
		{

			if ($artefato->arquivos != null) 
			{
				foreach($artefato->arquivos as $arquivo)
				{
					if(isset($arquivo->path))
						$pdf->addPDF($arquivo->path);
					var_dump($arquivo->path);
				}
			}
		}

		$pdf->merge('file', 'samplepdfs/TEST2.pdf');
		//$pdf->merge('browser', 'arquivos/merged.pdf'); // generate the file

		//$pdf->merge('file', 'arquivos/test.pdf'); // force download

	}

}