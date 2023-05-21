<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/libraries/DataLibrary.php');

class LeiTipoArtefatoLibrary
{

    private $ordem;
    private $controller = 'LeiTipoArtefatoController';

    public function listar($leisTiposArtefatos)
    {
        $this->ordem = 0;
        
        $tabela = $this->linhaDeCabecalho();

        foreach ($leisTiposArtefatos as $leiTipoArtefato) {
            $this->ordem++;

            $tabela .= $this->linha($leiTipoArtefato);
        }
        return $tabela;
    }

    private function linhaDeCabecalho()
    {
        return from_array_to_table_row_with_td([
            'Ordem',
            'Lei',
            'Tipo',
            'Artefato',
            'Status',
            'Alterar'
        ]);
    }

    private function linha($leiTipoArtefato)
    {
        return from_array_to_table_row([
            td_ordem($this->ordem),
            td_value($leiTipoArtefato->lei->toString()),
            td_value($leiTipoArtefato->tipo->nome),
            td_value($leiTipoArtefato->artefato->nome),
            td_status($leiTipoArtefato->status),
            td_alterar($this->controller,$leiTipoArtefato->id)
        ]);
    }
}