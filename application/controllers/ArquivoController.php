<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ArquivoController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('dao/ArquivoDAO');
		$this->load->model('dao/ProcessoDAO');
		$this->load->model('dao/ArtefatoDAO');
	}

	public function index()
	{
		usuarioPossuiSessaoAberta() ? $this->listar() : redirecionarParaPaginaInicial();
	}

	public function listar($indice = 1)
	{
		$indice--;

		$qtd_de_itens_para_exibir = 10;
		$indice_no_data_base = $indice * $qtd_de_itens_para_exibir;

		$arquivos = $this->ArquivoDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base);


		$this->load->library('CriadorDeBotoes',
			[
				'controller' => ARQUIVO_CONTROLLER . '/listar',
				'quantidade_de_registros_no_banco_de_dados' => $this->ArquivoDAO->contar()
			]);

		$botoes = empty($arquivos) ? '' : $this->criadordebotoes->listar($indice);

		$this->load->view('index',
			[
				'titulo' => 'Lista de arquivos',
				'tabela' => $arquivos,
				'pagina' => 'arquivo/index.php',
				'botoes' => $botoes,
			]);
	}

	public function novo()
	{

		$dados = array(
			'titulo' => 'Novo arquivo',
			'pagina' => 'arquivo/novo.php',
			'processos' => $this->ProcessoDAO->options(),
			'artefatos' => $this->ArtefatoDAO->options()
		);

		$this->load->view('index', $dados);
	}

	public function criar()
	{

		$data_post = $this->input->post();

		$file = $_FILES['arquivo'];

		if (isset($file) && isset($data_post)) {

			$arquivo = $this->moverArquivo($data_post);

			if (isset($arquivo)) {

				$this->ArquivoDAO->criar($arquivo);

				redirect('ArquivoController');
			} else {
				echo "<script>alert('Não foi possível mover o arquivo para o banco de dados! Tente novamente!')</script>";
			}
		}
	}

	public function alterar($id)
	{

		$arquivo = $this->ArquivoDAO->buscarPorId($id);

		$dados = array(
			'titulo' => 'Alterar Arquivo',
			'pagina' => 'arquivo/alterar.php',
			'arquivo' => $arquivo,
			'processos' => $this->ProcessoDAO->options(),
			'artefatos' => $this->ArtefatoDAO->options()
		);

		$this->load->view('index', $dados);
	}

	public function atualizar()
	{

		$data_post = $this->input->post();

		$file = $_FILES['arquivo'];

		if (isset($file) && isset($data_post)) {

			$arquivo = $this->moverArquivo($data_post);

			if (isset($arquivo)) {

				$this->ArquivoDAO->criar($arquivo);

				redirect('ArquivoController');
			} else {
				echo "<script>alert('Não foi possível atualizar o arquivo no banco de dados! Tente novamente!')</script>";
			}
		}
	}

	public function alterarArquivoDeUmProcesso()
	{

		$data_post = $this->input->post();

		if (isset($data_post['mais_um'])) {

			//verifica se foi apontado um arquivo para
			// já adiciona-lo a listagem
			if (
				count($_FILES['arquivo']) > 0 &&
				isset($_FILES['arquivo']['temp_name'])
			) {

				$arquivo = $this->moverArquivo($data_post, true);

				if (isset($arquivo)) {

					$this->ArquivoDAO->criar($arquivo);

				}

				//se não tiver sido aponado um arquivo,
				//ele só adiciona um novo artefato vazio, sem path
			} else {
				$this->ArquivoDAO->criar(
					new Arquivo(
						null,
						'',
						null,
						$_SESSION['id'],
						$data_post['artefato_id'],
						$data_post['processo_id'],
						'',
						true
					)
				);
			}

		} else if (isset($data_post['menos_um'])) {

			$arquivo_para_deletar = $this->ArquivoDAO->buscarPorId($data_post['arquivo_id']);

			$this->ArquivoDAO->deletar($arquivo_para_deletar);

		} else if (isset($data_post['enviar'])) {

			if (
				isset($_FILES['arquivo']) &&
				!empty($_FILES['arquivo']['tmp_name'])
			) {

				$arquivo = $this->moverArquivo($data_post);

				if (isset($arquivo)) {

					//verifica se é pra atualizar o arquivo
					if (
						$data_post['arquivo_path'] == '' &&
						$data_post['arquivo_id'] > 0
					) {

						$this->ArquivoDAO->atualizar($arquivo);

						//verifica se é pra inserir um novo arquivo
					} else if (
						$data_post['arquivo_path'] == '' &&
						$data_post['arquivo_id'] == null
					) {
						$this->ArquivoDAO->criar($arquivo);

					}

				} else {

					echo "<script>alert('Não foi possível fazer o Upload do arquivo! Tente novamente!')</script>";
					//redirect('ProcessoController/exibir/' . $data_post['processo_id']);
				}
			} else if (!empty($data_post['arquivo_id'])) {

				$arquivo_para_atualizar = $this->ArquivoDAO->buscarPorId($data_post['arquivo_id']);

				$arquivo_para_atualizar->nome = $data_post['arquivo_nome'];

				$this->ArquivoDAO->atualizar($arquivo_para_atualizar);

			}
		}

		redirect('ProcessoController/exibir/' . $data_post['processo_id']);


	}

	public function deletar($id)
	{
		$this->ArquivoDAO->deletar($$this->ArquivoDAO->buscarPorId($id));

		redirect('ArquivoController');
	}

	private function toObject($data_post, $path, $criarUmNovoArquivo)
	{
		return new Arquivo(
			$criarUmNovoArquivo ? null : (isset($data_post['arquivo_id']) ? $data_post['arquivo_id'] : null),
			$path,
			new Tempo(),
			$_SESSION['id'],
			$data_post['artefato_id'],
			$data_post['processo_id'],
			isset($data_post['arquivo_nome']) ? $data_post['arquivo_nome'] : '',
			$data_post['arquivo_status']
		);
	}

	private function moverArquivo($data_post, $criarUmNovoArquivo = false)
	{
		$tmp_name = $_FILES['arquivo']['tmp_name'];

		if (
			($data_post['arquivo_path'] == '') ||
			$criarUmNovoArquivo
		) {

			$nome_do_arquivo = $_FILES['arquivo']['name'];

			$extensao = strtolower(pathinfo($nome_do_arquivo, PATHINFO_EXTENSION));

			$path = 'arquivos/' . $data_post['artefato_id'] . '/' . uniqid() . '.' . $extensao;

		} else {

			$path = $data_post['arquivo_path'];

		}


		$arquivado = move_uploaded_file($tmp_name, $path);

		//var_dump($_FILES['arquivo']);
		/* $arquivado = false;

		 $config['upload_path'] = $path;
		 $config['allowed_types'] = 'pdf';
		 $config['max_size'] = 10000;

		 $this->load->library('upload', $config);

		 if (!$this->upload->do_upload('arquivo')) {
			 $error = array('error' => $this->upload->display_errors());

			 $this->load->view('arquivo/upload_error', $error);

			 $arquivado = false;
		 } else {
			 $arquivado = true;
		 }*/


		if ($arquivado) {

			return $this->toObject($data_post, $path, $criarUmNovoArquivo);

		} else {
			return null;
		}
	}

}
