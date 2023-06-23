<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/libraries/DataLibrary.php');

class AndamentoLibrary
{

	private $ordem;

	public function listar($andamentos, $ordem)
	{
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
			'Processo Id'
		]);
	}

	private function linha($andamento)
	{
		return from_array_to_table_row([
			td_value($andamento->id),
			td_value($andamento->status->nome()),
			td_data_hora_br($andamento->dataHora),
			td_value($andamento->processo_id)
		]);
	}
}
