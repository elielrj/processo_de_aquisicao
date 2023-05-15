<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';
use Dompdf\Dompdf;

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
		$this->load->library('processo_library');
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
			'tabela' => $this->processo_library->listar($processos, $indiceInicial),
			'pagina' => 'processo/index.php',
			'botoes' => $botoes,
		);

		$this->load->view('index', $dados);

	}

	public function exibir($id)
	{
		$processo = $this->ProcessoDAO->buscarPorId($id);

		$this->load->view('index', [
			'titulo' => 'Processo: ' . $processo->tipo->nome,
			'tabela' => $this->tabela->processo_exibir($processo),
			'pagina' => 'processo/exibir.php',
		]);
	}

	public function visualizarProcesso($id)
	{
		$processo = $this->ProcessoDAO->buscarPorId($id);

		$this->load->view('index', [
			'titulo' => 'Processo: ' . $processo->tipo->nome,
			'tabela' => $this->tabela->processo_imprimir($processo),
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


		$html = $this->tabela->processo_imprimir($processo);

		$this->imprimir($html);

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
			'leis' => $this->LeiDAO->optionsDeLeisPorModalidadeId($lei_e_modalidade_pre_definido),
			'lei_e_modalidade_pre_definido' => $lei_e_modalidade_pre_definido
		);

		$this->load->view('index', $dados);
	}

	public function criar()
	{

		$data_post = $this->input->post();

		$processo = array(
			'id' => null,
			'objeto' => $data_post['objeto'],
			'numero' => $data_post['numero'],
			'data_hora' => $this->data->dataHoraMySQL(),
			'chave' => uniqid(),
			'departamento_id' => $data_post['departamento_id'],
			'lei_id' => $data_post['lei_id'],
			'tipo_id' => $data_post['tipo_id'],
			'completo' => $data_post['completo'],
			'status' => $data_post['status']
		);

		$this->ProcessoDAO->criar($processo);

		redirect('ProcessoController');
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

	public function imprimir($html)
	{

		$dompdf = new Dompdf();

		/*
		$dados = [
		'tabela' => $this->tabela->processo(null, null),
		'titulo' => 'Lista de Processos',
		'botoes' => []
		];*/

		//$pagina_html = $this->load->view('processo/index.php',$dados);

		$dompdf->loadHtml($html);

		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();
		$dompdf->stream();
	}

}