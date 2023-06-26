<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModalidadeLibrary
{

    private $ordem;
    private $controller = 'Modalidade';

    public function listar($modalidades, $ordem)
    {
        $this->ordem = $ordem;

        $tabela = $this->linhaDeCabelho();

        foreach ($modalidades as $modalidade) {
            $this->ordem++;

            $tabela .= $this->linha($modalidade);
        }
        return $tabela;
    }

    private function linhaDeCabelho()
    {
        return from_array_to_table_row_with_td([
            'Ordem',
            'Nome',
            'Status',
            'Alterar',
            'Excluir'
        ]);
    }

    private function linha($modalidade)
    {

        return from_array_to_table_row([
            td_ordem($this->ordem),
            td_value($modalidade->nome),
            td_status($modalidade->status),
            td_alterar($this->controller,$modalidade->id),
            td_excluir($this->controller,$modalidade->id)
        ]);
    }
}
