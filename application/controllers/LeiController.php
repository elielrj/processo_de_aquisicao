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

		$this->load->library('CriadorDeBotoes',
			arrayToCriadorDeBotoes(
				self::LEI_CONTROLLER . '/listar',
				$this->contarRegistrosAtivos() ?? 0
			)
		);

		$this->load->view('index',
			arrayToView(
				'Lista de leis',
				$this->buscarTodosAtivos($qtd_de_itens_para_exibir, $indice_no_data_base) ?? [],
				'lei/index.php',
				$this->criadordebotoes->listar($indice) ?? 0
			)
		);
	}

	public function novo()
	{
		$this->load->model('dao/ModalidadeDAO');

		$this->load->view(
			'index',
			[
				'titulo' => 'Nova lei',
				'pagina' => 'lei/novo.php',
				'options_modalidades' => $this->ModalidadeDAO->options()
			]
		);
	}

	public function criar()
	{
		$this->load->library(
			'Data',
			$this->input->post('data'));

		$array =
			[
				ID => null,
				NUMERO => $this->input->post('numero'),
				ARTIGO => $this->input->post('artigo'),
				INCISO => $this->input->post('inciso'),
				DATA => $this->datahora->formatoDoMySQL(),
				MODALIDADE => $this->input->post('modalidade_id'),
				STATUS => true
			];

		$this->load->model('dao/LeiDAO');

		$this->LeiDAO->criar($array);

		redirect(self::LEI_CONTROLLER);
	}

	public function alterar($id)
	{
		$this->load->model('dao/ModalidadeDAO');

		$this->load->view(
			'index',
			[
				'titulo' => 'Alterar lei',
				'pagina' => 'lei/alterar.php',
				'lei' => $this->buscarPorId($id),
				'options_modalidades' => $this->ModalidadeDAO->options(),
			]
		);
	}

	public function atualizar()
	{
		$this->load->library('Data', $this->input->post('data'));


		$array =
			[
				ID => $this->input->post('id'),
				NUMERO => $this->input->post('numero'),
				ARTIGO => $this->input->post('artigo'),
				INCISO => $this->input->post('inciso'),
				DATA => $this->data->formatoDoMySQL(),
				MODALIDADE_ID => $this->input->post('modalidade_id'),
				STATUS => $this->input->post('status')
			];

		$this->load->model('dao/LeiDAO');

		$this->LeiDAO->atualizar($array);

		redirect(self::LEI_CONTROLLER);
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
		$this->load->model('dao/LeiDAO');

		return $this->LeiDAO->contarRegistrosAtivos();
	}

	public function contarRegistrosInativos()
	{
		$this->load->model('dao/LeiDAO');

		return $this->LeiDAO->contarRegistrosInativos();
	}

	public function contarTodosOsRegistros()
	{
		$this->load->model('dao/LeiDAO');

		return $this->LeiDAO->contarTodosOsRegistros();
	}

	public function excluirDeFormaPermanente($id)
	{
		$this->load->model('dao/LeiDAO');

		$this->LeiDAO->excluirDeFormaPermanente($id);
	}

	public function excluirDeFormaLogica($id)
	{
		$this->load->model('dao/LeiDAO');

		$this->LeiDAO->excluirDeFormaLogica($id);	}

	public function options()
	{
		$this->load->model('dao/LeiDAO');

		return $this->LeiDAO->options();	}

	public function buscarPorId($id)
	{
		$this->load->model('dao/LeiDAO');

		$array = $this->LeiDAO->BuscarPorId($id);

		return $this->toObject($array);	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		$this->load->model('dao/LeiDAO');

		$array = $this->LeiDAO->buscarTodosAtivos($inicio, $fim);

		return $this->toObject($array);	}

	public function buscarTodosInativos($inicio, $fim)
	{
		$this->load->model('dao/LeiDAO');

		$array = $this->LeiDAO->buscarTodosInativos($inicio, $fim);

		return $this->toObject($array);	}

	public function buscarTodosStatus($inicio, $fim)
	{
		$this->load->model('dao/LeiDAO');

		$array = $this->LeiDAO->buscarTodosStatus($inicio, $fim);

		return $this->toObject($array);	}

	public function buscarAonde($inicio, $fim, $where)
	{
		$this->load->model('dao/LeiDAO');

		$array = $this->LeiDAO->buscarAonde($inicio, $fim, $where);

		return $this->toObject($array);
	}

	public function contarTodosOsRegistrosAonde($where)
	{
		$this->load->model('dao/LeiDAO');
		return $this->LeiDAO->contarTodosOsRegistrosAonde($where);	}

	public function recuperar($id)
	{
		$this->load->model('dao/LeiDAO');

		$this->LeiDAO->recuperar($id);

		redirect(self::LEI_CONTROLLER . '/listar');	}
}
