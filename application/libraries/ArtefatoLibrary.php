<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ArtefatoLibrary
{

    private $ordem;
    private $controller = 'ArtefatoController';

    public function artefato($artefatos, $ordem)
    {
        $this->ordem = $ordem;

        $tabela = $this->linhaDeCabelho();

        foreach ($artefatos as $artefato) {
            $this->ordem++;

            $tabela .= $this->linha($artefato);
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

    private function linha($artefato)
    {

        return from_array_to_table_row([
            td_ordem($this->ordem),
            td_value($artefato->nome),
            td_status($artefato->status),
            td_alterar($this->controller,$artefato->id),
            td_excluir($this->controller,$artefato->id)
        ]);
    }
}