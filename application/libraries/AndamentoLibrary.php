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
			'Status do andamento',
			'Data/Hora'
		]);
	}

	private function linha($andamento)
	{
		return from_array_to_table_row([
			td_value($andamento->id),
			td_value($andamento->statusDoAndamento->nome()),
			td_data_hora_br($andamento->dataHora)
		]);
	}
}
