<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/libraries/DataLibrary.php');

class AndamentoLibrary
{

	private $ordem;
	private $processo;
	private $processoDAO;
	private $usuarioDAO;

	public function __construct()
	{
		include_once 'application/models/dao/UsuarioDAO.php';
		include_once 'application/models/dao/ProcessoDAO.php';

		$this->usuarioDAO = new UsuarioDAO();
		$this->processoDAO = new ProcessoDAO();

	}

	public function listar($andamentos, $ordem)
	{
		$this->processo = $this->processoDAO->buscarPorId($andamentos[0]->processo_id);

		$this->ordem = $ordem;

		$tabela = $this->linhaDeCabelho();

		foreach ($andamentos as $andamento) {

			$this->ordem++;

			$tabela .= $this->linha($andamento);
		}
		return $tabela;
	}

	private function linhaDeCabelho()
	{
		return from_array_to_table_row_with_td([
			'Id',
			'Status',
			'Data/Hora',
			'Processo',
			'Usuario',
			'Status'
		]);
	}

	private function linha($andamento)
	{
		return from_array_to_table_row([
			td_value($andamento->id),
			td_value(
				ucfirst(
					str_replace('_od', ' OD',
						str_replace('_fisc_adm', ' Fisc Adm', $andamento->statusDoAndamento->nome())
					))
			),
			td_data_hora_br($andamento->dataHora),
			td_value($this->processo->toString()),
			td_value(($this->usuarioDAO->buscarPorId($andamento->usuario_id))->toString()),
			td_status($andamento->status)
		]);
	}
}
