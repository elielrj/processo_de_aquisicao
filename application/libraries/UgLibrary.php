<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UgLibrary {

    private $ordem;
    private $controller = 'UgController';

    public function ug($listaDeUg, $ordem) {
        
        $this->ordem = $ordem;

        $tabela = $this->linhaDeCabecalho();

        foreach ($listaDeUg as $ug) {
            $this->ordem++;
            $tabela .= $this->linha($ug);
        }
        return $tabela;
    }

    private function linhaDeCabecalho() {
        return from_array_to_table_row_with_td([
            'Ordem',
            'UASG',
            'OM',
            'Sigla',
            'Status',
            'Alterar',
            'Excluir',
        ]);
    }

    private function linha($ug) {
        return from_array_to_table_row(
            $this->ordem,
            td_value($ug->numero) ,
            td_value($ug->nome) ,
            td_value($ug->sigla) ,
            td_status($ug->status),
            td_alterar($this->controller,$ug->id),
            td_excluir($this->controller,$ug->id)
        );
    }

}
