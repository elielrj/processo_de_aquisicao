<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/libraries/DataLibrary.php');

class TipoLibrary
{

    private $ordem;
    private $controller = 'TipoController';

    public function listar($tipos, $ordem)
    {
        $this->ordem = $ordem;
        $tabela = $this->linhaDeCabecalhoDoTipo();

        foreach ($tipos as $tipo) {
            $this->ordem++;
            $tabela .= $this->linhaDoTipo($tipo);
        }
        return $tabela;
    }

    private function linhaDeCabecalhoDoTipo()
    {
        return from_array_to_table_row_with_td([
            'Ordem',
            'Nome',
            'Status',
            'Alterar',
            'Excluir'
        ]);
    }

    private function linhaDoTipo($tipo)
    {
        return from_array_to_table_row([
            td_ordem($this->ordem),
            td_value($tipo->nome),
            td_status($tipo->status),
            td_alterar($this->controller, $tipo->id),
            td_excluir($this->controller, $tipo->id)
        ]);
    }
}