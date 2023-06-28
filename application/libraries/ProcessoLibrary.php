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
			td_value(ucfirst(str_replace('_od',' OD', str_replace('_fisc_adm',' Fisc Adm',$processo->listaDeAndamento[0]->nome())))),
			td_data_hora_br($processo->listaDeAndamento[0]->dataHora),
			td_status_completo($processo->completo),
			td_value($this->exibirNotaDeEmpenho($processo))
        ]);
    }

    private function objeto($objeto, $id)
    {
        return "<td><a href='" .
            base_url('index.php/ProcessoController/exibir/' . $id)
            . "'>{$objeto}</a></td>";
    }

	private function exibirNotaDeEmpenho($processo){

		$arquivo_ne = ' - ';

		foreach ($processo->tipo->listaDeArtefatos as $artefato){
			if($artefato->id == 63){
				$arquivo_ne =  isset($artefato->arquivo) ? $artefato->arquivo[(count($artefato->arquivo)-1)]->path : ' - ';
			}
		}
		return $arquivo_ne;
	}
}
