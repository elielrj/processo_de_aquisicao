<?php

require_once 'abstract_controller/AbstractController.php';

class LeiController extends AbstractController
{
	const LEI_CONTROLLER = 'LeiController';
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

		$leis = $this->LeiDAO->buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base);

		$params = [
			'controller' => LEI_CONTROLLER . '/listar',
			'quantidade_de_registros_no_banco_de_dados' => $this->LeiDAO->contar()
		];


		$this->load->library('CriadorDeBotoes', $params);

		$botoes = empty($leis) ? '' : $this->criadordebotoes->listar($indice);

		$dados = array(
			'titulo' => 'Lista de leis',
			'tabela' => $leis,
			'pagina' => 'lei/index.php',
			'botoes' => $botoes,
		);
		$this->load->view('index', $dados);
	}

	public function novo()
	{
		$this->load->model('dao/ModalidadeDAO');

		$this->load->view('index', [
			'titulo' => 'Nova lei',
			'pagina' => 'lei/novo.php',
			'options_modalidades' => $this->ModalidadeDAO->options()
		]);
	}

	public function criar()
	{

		$data_post = $this->input->post();

		$this->load->library('DataHora', $data_post['data']);

		$this->load->model('dao/ModalidadeDAO');

		$lei = new lei(
			null,
			$data_post['numero'],
			$data_post['artigo'],
			$data_post['inciso'],
			$this->datahora->formatoDoMySQL(),
			$this->ModalidadeDAO->buscarPorId($data_post['modalidade_id']),
			$data_post['status']
		);

		$this->LeiDAO->criar($lei);

		redirect('leiController');
	}

	public function alterar($id)
	{

		$lei = $this->LeiDAO->buscarPorId($id);

		$this->load->model('dao/ModalidadeDAO');

		$dados = [
			'titulo' => 'Alterar lei',
			'pagina' => 'lei/alterar.php',
			'lei' => $lei,
			'options_modalidades' => $this->ModalidadeDAO->options(),
		];

		$this->load->view('index', $dados);
	}

	public function atualizar()
	{

		$data_post = $this->input->post();

		$lei = new lei(
			$data_post['id'],
			$data_post['numero'],
			$data_post['artigo'],
			$data_post['inciso'],
			$this->data->dataHoraBr($data_post['data']),
			$data_post['modalidade_id'],
			$data_post['status']
		);

		$this->LeiDAO->update($lei);

		redirect('leiController');
	}

	public function deletar($id)
	{

		$this->LeiDAO->update($id);//todo atualizar método

		redirect('leiController');
	}

	public function optionsPorModalidadeId()
	{

		$data_post = $this->input->post();

		$modalidade_id = $data_post['modalidade_id'];

		$listaDeLeis = $this->LeiDAO->options($modalidade_id);

		$options = "<option>Selecione uma Lei</option>";

		foreach ($listaDeLeis as $key => $value) {
			$options .= "<option value='{$key}'>{$value}</option>";
		}

		echo $options;
	}


	public function toObject($array)
	{
		$data = $array->data ?? ($array['data'] ?? null);
		$this->load->library('Data', $data);

		return new Lei(
			$array->id ?? ($array['id'] ?? null),
			$array->numero ?? ($array['numero'] ?? null),
			$array->artigo ?? ($array['artigo'] ?? null),
			$array->inciso ?? ($array['inciso'] ?? null),
			$this->data->formatoDoMySQL(),
			isset($array->modalidade_id)
				? $this->ModalidadeDAO->buscarPorId($array->modalidade_id)
				: (isset($array['modalidade_id']) ? $this->ModalidadeDAO->buscarPorId($array['modalidade_id']) : null),
			$array->status
		);
	}

	public function array()
	{
		include_once 'application/libraries/Data.php';
		$data = new Data($this->data);

		return array(
			'id' => $this->id ?? null,
			'numero' => $this->numero,
			'artigo' => $this->artigo,
			'inciso' => $this->inciso,
			'data' => $data->formatoDoMySQL(),
			'modalidade_id' => $this->modalidade->id,
			'status' => $this->status
		);
	}

	public function contarRegistrosAtivos()
	{
		// TODO: Implement contarRegistrosAtivos() method.
	}

	public function contarRegistrosInativos()
	{
		// TODO: Implement contarRegistrosInativos() method.
	}

	public function contarTodosOsRegistros()
	{
		// TODO: Implement contarTodosOsRegistros() method.
	}

	public function excluirDeFormaPermanente($id)
	{
		// TODO: Implement excluirDeFormaPermanente() method.
	}

	public function excluirDeFormaLogica($id)
	{
		// TODO: Implement excluirDeFormaLogica() method.
	}

	public function options()
	{
		// TODO: Implement options() method.
	}

	public function buscarPorId($id)
	{
		// TODO: Implement buscarPorId() method.
	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		// TODO: Implement buscarTodosAtivos() method.
	}

	public function buscarTodosInativos($inicio, $fim)
	{
		// TODO: Implement buscarTodosInativos() method.
	}

	public function buscarTodosStatus($inicio, $fim)
	{
		// TODO: Implement buscarTodosStatus() method.
	}

	public function buscarAonde($where)
	{
		// TODO: Implement buscarAonde() method.
	}

	public function contarTodosOsRegistrosAonde($where)
	{
		// TODO: Implement contarTodosOsRegistrosAonde() method.
	}

	public function recuperar($id)
	{
		// TODO: Implement recuperar() method.
	}
}
