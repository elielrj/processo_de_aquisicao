<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('DataLibrary.php');

class ProcessoLibrary
{
	private $ordem;
	private $controller = 'ProcessoController';
	private $nome_da_nota_de_empenho = '';
	private $nome_da_diex = '';

	private $executor;
	private $root;

	public function __construct()
	{
		include_once('application/models/bo/nivel_de_acesso/Executor.php');
		include_once('application/models/bo/nivel_de_acesso/Root.php');

		$this->executor = $_SESSION['funcao_nivel_de_acesso'] === Executor::NOME;
		$this->root = $_SESSION['funcao_nivel_de_acesso'] === Root::NOME;
	}

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
		include_once('application/models/bo/nivel_de_acesso/Executor.php');

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
			'Certidões',
			(($this->executor || $this->root) ? 'Excluir' : 'Excluir')
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
			$this->secao($processo->departamento->sigla, $processo->departamento->id),
			$this->andamento($processo),
			td_data_hora_br($processo->listaDeAndamento[0]->dataHora),
			td_status_completo($processo->completo),
			$exibir_nota_de_empenho,
			$this->verificarSeAsCertoesForamAnexadas($processo),
			$this->excluirOuRecuperar($processo)
		]);
	}

	private function excluirOuRecuperar($processo)
	{
		if ($this->executor || $this->root) {
			if ($processo->status) {
				return td_excluir('ProcessoController', $processo->id);
			} else {
				return "<td class='col-md-1'><a  href='" .
					base_url('index.php/ProcessoController/recuperar/' . $processo->id)
					. "'>Recuperar</a></td>";
			}
		} else {
			return td_value('-');
		}
	}

	private function objeto($objeto, $id)
	{
		return "<td class='col-md-3'><a  href='" .
			base_url('index.php/ProcessoController/exibir/' . $id)
			. "'>{$objeto}</a></td>";
	}

	/**
	 * @param $valor_para_exibir
	 * @param $id_do_departamento_no_dataBase
	 * @return string
	 * id 1 = Almox
	 * id 2 = SALC
	 * id 5 = Transpor e Mnt
	 * id 6 = Aprov
	 * id 7 = Saúde
	 * id 8 = Informática
	 */
	private function secao($valor_para_exibir, $id_do_departamento_no_dataBase)
	{
		if ($id_do_departamento_no_dataBase == 1) {
			return "<td class='col-md-1'><a  href='" . base_url('index.php/processo-listar-almox') . "'>{$valor_para_exibir}</a></td>";
		} elseif ($id_do_departamento_no_dataBase == 2) {
			return "<td class='col-md-1'><a  href='" . base_url('index.php/processo-listar-salc') . "'>{$valor_para_exibir}</a></td>";
		} elseif ($id_do_departamento_no_dataBase == 5) {
			return "<td class='col-md-1'><a  href='" . base_url('index.php/processo-listar-transporte') . "'>{$valor_para_exibir}</a></td>";
		} elseif ($id_do_departamento_no_dataBase == 6) {
			return "<td class='col-md-1'><a  href='" . base_url('index.php/processo-listar-aprov') . "'>{$valor_para_exibir}</a></td>";
		} elseif ($id_do_departamento_no_dataBase == 7) {
			return "<td class='col-md-1'><a  href='" . base_url('index.php/processo-listar-saude') . "'>{$valor_para_exibir}</a></td>";
		} elseif ($id_do_departamento_no_dataBase == 8) {
			return "<td class='col-md-1'><a  href='" . base_url('index.php/processo-listar-informatica') . "'>{$valor_para_exibir}</a></td>";
		} else {
			return td_value($valor_para_exibir);
		}

	}

	private function andamento($processo)
	{
		$andamento = $processo->listaDeAndamento[0]->nome();

		$andamento = ucfirst(str_replace('_od', ' OD', str_replace('_fisc_adm', ' Fisc Adm', $andamento)));

		$href = base_url('index.php/AndamentoController/listarPorProcesso/' . $processo->id);

		$link = "<a  href='" . $href . "'>{$andamento}</a>";

		return td_value($link);
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

					$path = verificar_path($artefato->arquivos[(count($artefato->arquivos) - 1)]->path);

					$this->nome_da_nota_de_empenho = $artefato->arquivos[(count($artefato->arquivos) - 1)]->nome;

					if ($this->nome_da_nota_de_empenho == '') {
						$this->nome_da_nota_de_empenho = '-';
					}

					if ($path != '') {

						if ($this->nome_da_nota_de_empenho == '-') {
							$this->nome_da_nota_de_empenho = 'Nota de Empenho';
						}
						return "<td><a href='" . verificar_path($path) . "'>{$this->nome_da_nota_de_empenho}</a></td>";
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

					$path = verificar_path($artefato->arquivos[(count($artefato->arquivos) - 1)]->path);

					$this->nome_da_diex = $artefato->arquivos[(count($artefato->arquivos) - 1)]->nome;

					if ($this->nome_da_diex == '') {
						$this->nome_da_diex = '-';
					}

					if ($path != '') {

						if ($this->nome_da_diex == '-') {
							$this->nome_da_diex = 'DIEx';
						}
						return "<td><a href='" . verificar_path($path) . "'>{$this->nome_da_diex}</a></td>";
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

					$path = verificar_path($artefato->arquivos[(count($artefato->arquivos) - 1)]->path);

					if ($path != '') {
						$tcu = true;
					}
				}
				/**
				 * Importante o valor do ID no database do Artefato "CADIN" é o mesmo deste abaixo!
				 */
			} else if ($artefato->id == 58) {

				if ($artefato->arquivos != array()) {

					$path = verificar_path($artefato->arquivos[(count($artefato->arquivos) - 1)]->path);

					if ($path != '') {
						$cadin = true;
					}
				}
				/**
				 * Importante o valor do ID no database do Artefato "SICAF" é o mesmo deste abaixo!
				 */
			} else if ($artefato->id == 59) {

				if ($artefato->arquivos != array()) {

					$path = verificar_path($artefato->arquivos[(count($artefato->arquivos) - 1)]->path);

					if ($path != '') {
						$sicaf = true;
					}
				}
			}
		}

		if ($sicaf && $cadin && $tcu) {

			$href = base_url('index.php/ProcessoController/imprimirCertidoes/' . $processo->id);

			return td_status_completo_com_href($sicaf && $cadin && $tcu, $href);

		} else {
			return td_status_completo($sicaf && $cadin && $tcu);
		}
	}

}
