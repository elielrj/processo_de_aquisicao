<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('DataLibrary.php');

class ProcessoLibrary
{
	private $ordem;
	private $controller = 'ProcessoController';

	public function listar($processos, $ordem)
	{
		$this->ordem = $ordem;

		$tabela = $this->linhaDeCabecalhoDoProcesso();

		foreach ($processos as $processo) {
			$this->ordem++;

			$tabela .= $this->linhaDoProcesso($processo);
		}
		return $tabela;
	}


	private function linhaDeCabecalhoDoProcesso()
	{
		return from_array_to_table_row_with_td([
			'Ordem',
			'Objeto',
			'Tipo',
			'Lei',
			'Número',
			'Data',
			'Seção',
			'Andamento',
			'Modificado às',
			'Status',
			'NE'
		]);
	}


	private function linhaDoProcesso($processo)
	{
		return from_array_to_table_row([
			td_ordem($this->ordem),
			$this->objeto($processo->objeto, $processo->id),
			td_value($processo->tipo->nome),
			td_value($processo->lei->modalidade->nome),
			td_value($processo->numero),
			td_data_hora_br($processo->dataHora),
			td_value($processo->departamento->sigla),
			td_value(ucfirst(str_replace('_od', ' OD', str_replace('_fisc_adm', ' Fisc Adm', $processo->listaDeAndamento[0]->nome())))),
			td_data_hora_br($processo->listaDeAndamento[0]->dataHora),
			td_status_completo($processo->completo),
			$this->exibirNotaDeEmpenho($processo)
		]);
	}

	private function objeto($objeto, $id)
	{
		return "<td><a href='" .
			base_url('index.php/ProcessoController/exibir/' . $id)
			. "'>{$objeto}</a></td>";
	}

	private function exibirNotaDeEmpenho($processo)
	{
		$path = '-';

		if ($processo->completo) {

			foreach ($processo->tipo->listaDeArtefatos as $artefato) {
				/**
				 * Importante o valor do ID no database da "Nota de Empenho" ser o mesmo!
				 */
				if ($artefato->id == 63) {

					if (count($artefato->arquivos) > 0) {

						$path = base_url($artefato->arquivos[(count($artefato->arquivos) - 1)]->path);

						return "<td><a href='" . $path . "'>NE</a></td>";
					} else {
						return "<td>-</td>";
					}
				}
			}
		}
		return "<td>" . $path . "</td>";
	}
}
