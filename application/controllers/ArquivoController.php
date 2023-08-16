<?php

require_once 'abstract_controller/AbstractController.php';

class ArquivoController extends AbstractController
{
	const  ARQUIVO_CONTROLLER = 'ArquivoController';

	public function __construct()
	{
		parent::__construct();
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

		$this->load->library('CriadorDeBotoes',
			arrayToCriadorDeBotoes(
				self::ARQUIVO_CONTROLLER . '/listar',
				$this->contarTodosOsRegistros() ?? 0
			)
		);

		$this->load->view('index',
			arrayToView(
				'Lista de arquivos',
				$this->buscarTodosStatus($qtd_de_itens_para_exibir, $indice_no_data_base) ?? [],
				self::ARQUIVO_CONTROLLER . '/listar',
				$this->criadordebotoes->listar($indice) ?? 0
			)
		);
	}

	public function novo()
	{
		$this->load->view('index', [
			'titulo' => 'Novo arquivo',
			'pagina' => 'arquivo/novo.php',
			'processos' => $this->ProcessoDAO->options(),
			'artefatos' => $this->ArtefatoDAO->options()
		]);
	}

	public function alterar($id)
	{
		$this->load->model('dao/ProcessoDAO');

		$this->load->model('dao/ArtefatoDAO');

		$dados = array(
			'titulo' => 'Alterar Arquivo',
			'pagina' => 'arquivo/alterar.php',
			'arquivo' => $this->buscarPorId($id),
			'processos' => $this->ProcessoDAO->options(),
			'artefatos' => $this->ArtefatoDAO->options()
		);

		$this->load->view('index', $dados);
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
						$_SESSION[SESSION_ID],
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

		redirect('ProcessoController/exibirArtefatos/' . $data_post['processo_id']);


	}



	/**
	 * Banco de Dados
	 */

	/**
	 * @return void
	 */
	public function criar()
	{
		$nome_do_arquivo = $_FILES['arquivo']['name'];

		$extensao =
			strtolower(
				pathinfo(
					$nome_do_arquivo,
					PATHINFO_EXTENSION));

		$path =
			'arquivos/' .
			$this->input->post('artefato_id') . '/' .
			uniqid('', true) . '.' .
			$extensao;

		$tmp_name = $_FILES['arquivo']['tmp_name'];

		$estaArquivado = false;

		if (!empty($path)) {
			$estaArquivado = move_uploaded_file($tmp_name, $path);
		}

		if ($estaArquivado) {

			$this->load->library('DataHora');

			$array =
				[
					ID => null,
					STATUS => true,
					NOME => $this->input->post('arquivo_nome'),
					PATH => $path,
					DATA_HORA => $this->load->datahora->formatoDoMySQL(),
					USUARIO_ID => $_SESSION[ID],
					ARTEFATO_ID => $this->input->post('artefato_id'),
					PROCESSO_ID => $this->input->post('processo_id')
				];

			$this->load->model('dao/ArquivoDAO');

			$this->ArquivoDAO->criar($array);
		}

		//todo verificar como fazer o redirect
	}

	/**
	 * @return void
	 */
	public function atualizar()
	{
		$path = $this->input->post('arquivo_path');

		unlink($path);

		$tmp_name = $_FILES['arquivo']['tmp_name'];

		$estaArquivado = false;

		if (!empty($path)) {
			$estaArquivado = move_uploaded_file($tmp_name, $path);
		}

		if ($estaArquivado) {

			$this->load->library('DataHora');

			$array =
				[
					ID => null,
					STATUS => true,
					NOME => $this->input->post('arquivo_nome'),
					PATH => $path,
					DATA_HORA => $this->load->datahora->formatoDoMySQL(),
					USUARIO_ID => $_SESSION[ID],
					ARTEFATO_ID => $this->input->post('artefato_id'),
					PROCESSO_ID => $this->input->post('processo_id')
				];

			$this->load->model('dao/ArquivoDAO');

			$this->ArquivoDAO->atualizar($array);
		}

		//todo verificar como fazer o redirect
	}

	/**
	 * @param $id
	 * @return array
	 */
	public function buscarPorId($id)
	{
		$this->load->model('dao/ArquivoDAO');

		$array = $this->ArquivoDAO->BuscarPorId($id);

		return $this->toObject($array);
	}


	/**
	 * @param $inicio
	 * @param $fim
	 * @return array
	 */
	public function buscarTodosAtivos($inicio, $fim)
	{
		$this->load->model('dao/ArquivoDAO');

		$array = $this->ArquivoDAO->buscarTodosAtivos($inicio, $fim);

		return $this->toObject($array);
	}

	/**
	 * @param $inicio
	 * @param $fim
	 * @return array
	 */
	public function buscarTodosInativos($inicio, $fim)
	{
		$this->load->model('dao/ArquivoDAO');

		$array = $this->ArquivoDAO->buscarTodosInativos($inicio, $fim);

		return $this->toObject($array);
	}

	/**
	 * @param $inicio
	 * @param $fim
	 * @return array
	 */
	public function buscarTodosStatus($inicio, $fim)
	{
		$this->load->model('dao/ArquivoDAO');

		$array = $this->ArquivoDAO->buscarTodosStatus($inicio, $fim);

		return $this->toObject($array);
	}

	/**
	 * @param $inicio
	 * @param $fim
	 * @return array
	 */
	public function buscarAonde($where)
	{
		$this->load->model('dao/ArquivoDAO');

		$array = $this->ArquivoDAO->buscarAonde($where);

		return $this->toObject($array);
	}

	/**
	 * @param $id
	 * @return void
	 */
	public function excluirDeFormaPermanente($id)
	{
		$this->load->model('dao/ArquivoDAO');

		unlink($this->input->post('arquivo_path'));

		$this->ArquivoDAO->excluirDeFormaPermanente($id);
	}

	/**
	 * @param $id
	 * @return void
	 */
	public function excluirDeFormaLogica($id)
	{
		$this->load->model('dao/ArquivoDAO');

		$this->ArquivoDAO->excluirDeFormaLogica($id);
	}

	/**
	 * @return int
	 */
	public function contarRegistrosAtivos()
	{
		$this->load->model('dao/ArquivoDAO');

		return $this->ArquivoDAO->contarRegistrosAtivos();
	}


	/**
	 * @return int
	 */
	public function contarRegistrosInativos()
	{
		$this->load->model('dao/ArquivoDAO');

		return $this->ArquivoDAO->contarRegistrosInativos();
	}


	/**
	 * @return int
	 */
	public function contarTodosOsRegistros()
	{
		$this->load->model('dao/ArquivoDAO');

		return $this->ArquivoDAO->contarTodosOsRegistros();
	}

	/**
	 * @return array
	 */
	public function options()
	{
		$this->load->model('dao/ArquivoDAO');

		return $this->ArquivoDAO->options();
	}
}
