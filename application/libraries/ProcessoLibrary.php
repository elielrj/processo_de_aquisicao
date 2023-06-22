<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/libraries/DataLibrary.php');

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
			'Status'
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
            td_data_br($processo->dataHora),
            td_value($processo->departamento->sigla),
			td_value(ucfirst($processo->andamento->nome())),
			td_data_hora_br($processo->andamento->dataHora),
			td_status_completo($processo->completo)
        ]);
    }

    private function objeto($objeto, $id)
    {
        return "<td><a href='" .
            base_url('index.php/ProcessoController/exibir/' . $id)
            . "'>{$objeto}</a></td>";
    }
}
