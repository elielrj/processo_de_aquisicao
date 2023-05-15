<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/libraries/DataLibrary.php');

//include_once('tabela/TabelaLei.php');

class TabelaProcesso
{

    private $ordem;
    private $controller;

    public function processo($processos, $ordem)
    {
        $this->ordem = $ordem;

        $this->controller = 'ProcessoController';

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
            'Tipo de Processo',
            'Lei',
            'Número',
            'Data do Processo',
            'Seção',
            'Andamento',
            'Alterar',
            'Excluir'
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
            td_status_completo($processo->completo),
            td_alterar($this->controller, $processo->id),
            td_excluir($this->controller, $processo->id),
        ]);
    }

    private function objeto($objeto, $id)
    {
        return "<td><a href='" .
            base_url('index.php/ProcessoController/exibir/' . $id)
            . "'>{$objeto}</a></td>";
    }
}