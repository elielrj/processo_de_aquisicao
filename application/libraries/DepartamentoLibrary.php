<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DepartamentoLibrary {

    private $ordem;
    private $controller = 'DepartamentoController';

    public function departamento($departamentos, $ordem) {

        $this->ordem = $ordem;

        $tabela = $this->linhaDeCabecalho();

        foreach ($departamentos as $departamento) {
            $this->ordem++;
            $tabela .= $this->linha($departamento);
        }
        return $tabela;
    }

    private function linhaDeCabecalho() {
        return from_array_to_table_row_with_td([
            'Ordem',
            'Nome',
            'Sigla',
            'Status',
            'Alterar',
            'Excluir'
        ]);
    }

    private function linha($departamento) {
        return from_array_to_table_row([
                td_ordem($this->ordem) ,
                td_value($departamento->nome) ,
                td_value($departamento->sigla) ,
                td_status($departamento->status) ,
                td_alterar($this->controller,$departamento->id) ,
                td_excluir($this->controller,$departamento->id) ,
        ]);
    }
}
