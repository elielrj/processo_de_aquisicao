<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('DataLibrary.php');

class ProcessoLibrary
{
	private $ordem;
	private $controller = 'ProcessoController';
	private $nome_da_nota_de_empenho = '';
	private $nome_da_diex = '';

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
			'DIEx',
			'Número',
			'Data',
			'Seção',
			'Andamento',
			'Modificado às',
			'Status',
			'NE',
			'Certidões'
		]);
	}


	private function linhaDoProcesso($processo)
	{
		$exibir_nota_de_empenho = $this->exibirNotaDeEmpenho($processo);
		$exibir_diex = $this->exibirDiex($processo);

		return from_array_to_table_row([
			td_ordem($this->ordem),
			$this->objeto($processo->objeto, $processo->id),
			td_value($processo->tipo->nome),
			td_value($processo->lei->modalidade->nome),
			$exibir_diex,
			td_alterar_processo($processo->numero, $processo->id, $processo->departamento->id),
			td_data_hora_br($processo->dataHora),
			td_value($processo->departamento->sigla),
			td_value(ucfirst(str_replace('_od', ' OD', str_replace('_fisc_adm', ' Fisc Adm', $processo->listaDeAndamento[0]->nome())))),
			td_data_hora_br($processo->listaDeAndamento[0]->dataHora),
			td_status_completo($processo->completo),
			$exibir_nota_de_empenho,
			$this->verificarSeAsCertoesForamAnexadas($processo)
		]);
	}

	private function objeto($objeto, $id)
	{
		return "<td class='col-md-3'><a  href='" .
			base_url('index.php/ProcessoController/exibir/' . $id)
			. "'>{$objeto}</a></td>";
	}

	private function exibirNotaDeEmpenho($processo)
	{

		$path = '-';

		foreach ($processo->tipo->listaDeArtefatos as $artefato) {
			/**
			 * Importante o valor do ID no database do Artefato da "Nota de Empenho" é o mesmo abaixo!
			 */
			if ($artefato->id == 63) {


				if ($artefato->arquivos != array()) {

					$path = $artefato->arquivos[(count($artefato->arquivos) - 1)]->path;

					$this->nome_da_nota_de_empenho = $artefato->arquivos[(count($artefato->arquivos) - 1)]->nome;

					if ($this->nome_da_nota_de_empenho == '') {
						$this->nome_da_nota_de_empenho = '-';
					}

					if ($path != '') {

						if ($this->nome_da_nota_de_empenho == '-') {
							$this->nome_da_nota_de_empenho = 'Nota de Empenho';
						}
						return "<td><a href='" . base_url($path) . "'>{$this->nome_da_nota_de_empenho}</a></td>";
					} else {
						$path = $this->nome_da_nota_de_empenho;
					}
				}
			}
		}

		return "<td>" . $path . "</td>";

	}

	private function exibirDiex($processo)
	{

		$path = '-';

		foreach ($processo->tipo->listaDeArtefatos as $artefato) {
			/**
			 * Importante o valor do ID no database do Artefato da "DIEx" é o mesmo abaixo!
			 */
			if ($artefato->id == 53) {


				if ($artefato->arquivos != array()) {

					$path = $artefato->arquivos[(count($artefato->arquivos) - 1)]->path;

					$this->nome_da_diex = $artefato->arquivos[(count($artefato->arquivos) - 1)]->nome;

					if ($this->nome_da_diex == '') {
						$this->nome_da_diex = '-';
					}

					if ($path != '') {

						if ($this->nome_da_diex == '-') {
							$this->nome_da_diex = 'DIEx';
						}
						return "<td><a href='" . base_url($path) . "'>{$this->nome_da_diex}</a></td>";
					} else {
						$path = $this->nome_da_diex;
					}
				}
			}
		}

		return "<td>" . $path . "</td>";

	}

	private function verificarSeAsCertoesForamAnexadas($processo)
	{
		$path = '-';

		$tcu = false;
		$cadin = false;
		$sicaf = false;

		foreach ($processo->tipo->listaDeArtefatos as $artefato) {
			/**
			 * Importante o valor do ID no database do Artefato "TCU" é o mesmo deste abaixo!
			 */
			if ($artefato->id == 57) {

				if ($artefato->arquivos != array()) {

					$path = $artefato->arquivos[(count($artefato->arquivos) - 1)]->path;

					if ($path != '') {
						$tcu = true;
					}
				}
				/**
				 * Importante o valor do ID no database do Artefato "CADIN" é o mesmo deste abaixo!
				 */
			} else if ($artefato->id == 58) {

				if ($artefato->arquivos != array()) {

					$path = $artefato->arquivos[(count($artefato->arquivos) - 1)]->path;

					if ($path != '') {
						$cadin = true;
					}
				}
				/**
				 * Importante o valor do ID no database do Artefato "SICAF" é o mesmo deste abaixo!
				 */
			} else if ($artefato->id == 59) {

				if ($artefato->arquivos != array()) {

					$path = $artefato->arquivos[(count($artefato->arquivos) - 1)]->path;

					if ($path != '') {
						$sicaf = true;
					}
				}
			}
		}

		return td_status_completo($sicaf && $cadin && $tcu);
	}
}
