<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/libraries/DataLibrary.php');

class LeiLibrary
{

    private $ordem;
    private $controller = 'LeiController';

    public function listar($leis, $ordem)
    {
        $this->ordem = $ordem;
        
        $tabela = $this->linhaDeCabecalho();

        foreach ($leis as $lei) {
            $this->ordem++;

            $tabela .= $this->linha($lei);
        }
        return $tabela;
    }

    private function linhaDeCabecalho()
    {
        return from_array_to_table_row_with_td([
            'Ordem',
            'Número',
            'Artigo',
            'Inciso',
            'Data',
            'Modalidade',
            'Status',
            'Alterar',
            'Excluir'
        ]);
    }

    private function linha($lei)
    {
        return from_array_to_table_row([
            td_ordem($this->ordem),
            td_value($lei->numero),
            td_value($lei->artigo),
            td_value($lei->inciso),
            td_data_br($lei->data),
            td_value($lei->modalidade->nome),
            td_value($lei->status),
            td_alterar($this->controller, $lei->id),
            td_excluir($this->controller, $lei->id),
        ]);
    }
}