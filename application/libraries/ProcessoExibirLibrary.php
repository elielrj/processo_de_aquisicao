<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/nivel_de_acesso/Leitor.php');
include_once('application/models/bo/nivel_de_acesso/Escritor.php');
include_once('application/models/bo/nivel_de_acesso/AprovadorFiscAdm.php');
include_once('application/models/bo/nivel_de_acesso/AprovadorOd.php');
include_once('application/models/bo/nivel_de_acesso/Executor.php');
include_once('application/models/bo/nivel_de_acesso/Conformador.php');
include_once('application/models/bo/nivel_de_acesso/Administrador.php');
include_once('application/models/bo/nivel_de_acesso/Root.php');

class ProcessoExibirLibrary
{

	private $ordem;

	public function listar($processo)
	{
		$this->ordem = 0;

		$tabela = $this->processoExibirCabecalho($processo);

		$tabela .= br_multiples(3);

		$tabela .= $this->processoExibirListarArtefatos($processo);

		return $tabela;
	}

	private function processoExibirCabecalho($processo)
	{

		return
			"
                    <table class='table table-responsive-md table-hover'>
                        <tr class='text-left'> 
                            <td>Objeto: </td>
                            <td>" . $processo->objeto . "</td> 
                        </tr>
                        <tr class='text-left'> 
                            <td>Número do Processo (Nup/Nud): </td>
                            <td>" . $processo->numero . "</td> 
                        </tr>
                        <tr class='text-left'> 
                            <td>Data de abertura(Nup/Nud): </td>
                            " . td_data_hora_br($processo->dataHora) . "
                        </tr>
                        <tr class='text-left'> 
                            <td>Chave para acompanhar: </td>
                            <td>" . $processo->chave . "</td> 
                        </tr>
                        <tr class='text-left'> 
                            <td>Modalidade: </td>
                            <td>" . $processo->lei->modalidade->nome . "</td> 
                        </tr>
                        <tr class='text-left'> 
                            <td>Amparo legal: </td>
                            <td>" . $processo->lei->toString() . "</td> 
                        </tr>
                        <tr class='text-left'> 
                        	<td>Andamento:</td>
							<td>" . ucwords(str_replace('_', ' ', str_replace('_od', ' OD', $processo->listaDeAndamento[0]->nome()))) . "</td>
						</tr>
                        <tr class='text-left'>" .
            td_value('Status do Processo:') .
            td_status_completo($processo->completo) .
            "</tr>
                        <tr class='text-left'> 
                            <td>Processo: </td>
                            <td>" . "<a href=" . base_url('index.php/ProcessoController/visualizarProcesso/' .
                $processo->id) . " class='btn btn-primary btn-lg btn-block' >Visualização completa</a>" .
            "</td> 
                        </tr>
                        <tr class='text-left'> 
                            <td>Processo: </td>
                            <td>" . "<a href=" . base_url('index.php/ProcessoController/imprimirProcesso/' .
                $processo->id) . " class='btn btn-primary btn-lg btn-block' >
                            		Imprimir todo processo</a>" .
            "</td> 
                        </tr>
                        <tr>" . $this->despachar($processo) . "</tr>
                    </table>
                ";
	}

	public function processoExibirListarArtefatos($processo)
	{

		$listagemDeArtefatos = "<table class='table table-responsive-md table-hover'>";

		foreach ($processo->tipo->listaDeArtefatos as $artefato) {

			$this->ordem++;

			$listagemDeArtefatos .= $this->linkParaArtefato($artefato, $processo);
		}

		$listagemDeArtefatos .= "</table>";

		return $listagemDeArtefatos;
	}


	private function linkParaArtefato($artefato, $processo)
	{

		$link = "";

		$retorno = '';

		if (
			$artefato->arquivos != null
		) {

			$subindice = 0;
			$valorDoSubindice = count($artefato->arquivos);

			foreach ($artefato->arquivos as $arquivo) {

				if ($arquivo->path == '') {

					$link = "{$artefato->nome}";

				} else {

					$link = "<a href='" . base_url($arquivo->path) . "'>{$artefato->nome}</a>";

				}

				if ($valorDoSubindice > 1) {
					$subindice++;
				}

				$retorno .= $this->linhaDeCadaArquivoDeCadaArtefato(
					$artefato,
					$processo,
					$link,
					$arquivo,
					($subindice > 0 ? $subindice : null)
				);


			}

		} else {
			$link = "{$artefato->nome}";

			$retorno .= $this->linhaDeCadaArquivoDeCadaArtefato($artefato, $processo, $link, $arquivo = null);
		}
		return $retorno;

	}

	private function linhaDeCadaArquivoDeCadaArtefato($artefato, $processo, $link, $arquivo, $subindice = null)
	{
		$line = '';
		$line .= td_value($this->numeroDeOrdemComValorDeSubIndiceSeForOCaso($subindice));
		$line .= td_value($link, 'Visualizar artefato');
		$line .= view_form_open_multipart('ArquivoController/alterarArquivoDeUmProcesso');
		$line .= view_input_placeholder('arquivo_nome', $this->nomeDoArquivo($arquivo), 'Descrição');
		$line .= view_input_name_value_type('arquivo_id', $this->idDoArquivo($arquivo));
		$line .= view_input_name_value_type('processo_id', $processo->id);
		$line .= view_input_name_value_type('artefato_id', $artefato->id);
		$line .= view_input_name_value_type('arquivo_status', $this->statusDoArquivo($arquivo));
		$line .= view_input_name_value_type('arquivo_path', $this->pathDoArquivo($arquivo));
		$line .= td_value(formulario_par_subir_arquivo());
		$line .= td_value(view_form_submit_button('enviar', 'Upload/Atualizar', 'Sobe um novo ou atualiza o arquivo para este artefato do processo'));
		$line .= td_value(view_form_submit_button('mais_um', '+', 'Incluir mais arquivo para este artefato',false) );
		$line .= td_value(view_form_submit_button('menos_um', '-', 'Excluir artefato'));
		$line .= form_close();
		return tr_view($line);
	}

	public function idDoArquivo($arquivo)
	{

		if ($arquivo != null) {

			return $arquivo->id;
		} else {

			return null;
		}
	}

	public function statusDoArquivo($arquivo)
	{

		if ($arquivo == null) {
			return true;
		} else {
			return $arquivo->status;
		}
	}

	public function pathDoArquivo($arquivo)
	{

		if ($arquivo != null) {
			return $arquivo->path;
		} else {
			return '';
		}
	}

	private function objeto($objeto, $id)
	{
		return "<td><a href='" . base_url('index.php/ProcessoController/exibir/' . $id) . "'>{$objeto}</a></td>";
	}

	private function numeroDeOrdemComValorDeSubIndiceSeForOCaso($subindice)
	{
		return $subindice == null
			? $this->ordem
			: ($this->ordem . '.' . $subindice);
	}

	private function nomeDoArquivo($arquivo)
	{
		return estaSetado($arquivo)
			? $arquivo->nome
			: '';
	}


	private function despachar($processo)
	{
		$href = '';
		$nome = '';

		$nivel_de_acesso = $_SESSION['funcao_nivel_de_acesso'];

		$nivelDeAcesso = Funcao::selecionarNivelDeAcesso($nivel_de_acesso);


		switch ($processo->listaDeAndamento[0]->nome()) {
			case Criado::NOME:
			{
				if (
					$nivelDeAcesso->nivel() == Escritor::NIVEL ||
					$nivelDeAcesso->nivel() == Root::NIVEL
				) {
					$href = base_url('index.php/ProcessoController/enviarProcesso/' . $processo->id);
					$nome = 'Enviar para aprovação do Fisc Adm';
					break;
				} else {
					return '';
				}

			}
			case Enviado::NOME:
			{
				if (
					$nivelDeAcesso->nivel() == AprovadorFiscAdm::NIVEL ||
					$nivelDeAcesso->nivel() == Root::NIVEL
				) {
					$href = base_url('index.php/ProcessoController/aprovarProcessoFiscAdm/' . $processo->id);
					$nome = 'Aprovar como Fisc Adm e enviar ao OD';
					break;
				} else {
					return '';
				}

			}
			case AprovadoFiscAdm::NOME:
			{
				if (
					$nivelDeAcesso->nivel() == AprovadorOd::NIVEL ||
					$nivelDeAcesso->nivel() == Root::NIVEL
				) {
					$href = base_url('index.php/ProcessoController/aprovarProcessoOd/' . $processo->id);
					$nome = 'Aprovar como OD e enviar a SALC';
					break;
				} else {
					return '';
				}

			}
			case AprovadoOd::NOME:
			{
				if (
					$nivelDeAcesso->nivel() == Executor::NIVEL ||
					$nivelDeAcesso->nivel() == Root::NIVEL
				) {
					$href = base_url('index.php/ProcessoController/executarProcesso/' . $processo->id);
					$nome = 'Executado na SALC e enviar a Conf Doc';
					break;
				} else {
					return '';
				}

			}
			case Executado::NOME:
			{
				if (
					$nivelDeAcesso->nivel() == Conformador::NIVEL ||
					$nivelDeAcesso->nivel() == Root::NIVEL

				) {
					$href = base_url('index.php/ProcessoController/conformarProcesso/' . $processo->id);
					$nome = 'Dar a Conformidade no Processo';
					break;
				} else {
					return '';
				}

			}
			case Conformado::NOME:
			{
				if (
					$nivelDeAcesso->nivel() == Conformador::NIVEL ||
					$nivelDeAcesso->nivel() == Root::NIVEL
				) {
					$href = base_url('index.php/ProcessoController/arquivarProcesso/' . $processo->id);
					$nome = 'Arquivar o Processo';
					break;
				} else {
					return '';
				}

			}
			case Arquivado::NOME:
			{
				return '';
			}
		}

		return
			"<td>Despachar:</td>
			<td><a class='btn btn-danger btn-lg btn-block' href={$href}>" . $nome . "</a></td>";
	}

}
