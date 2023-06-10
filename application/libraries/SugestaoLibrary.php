<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/libraries/DataLibrary.php');

class SugestaoLibrary
{

    private $ordem;


    public function listar($sugestoes, $ordem)
    {
        $this->ordem = $ordem;
        $tabela = $this->cabecalho();

        foreach ($sugestoes as $sugestao) {
            $this->ordem++;
            $tabela .= $this->linha($sugestao);
        }
        return $tabela;
    }

    private function cabecalho()
    {
        return from_array_to_table_row_with_td([
            'Ordem',
            'Mensagem',
            'Status',
            'Usuário',
            'Alterar',
            'Excluir'
        ]);
    }

    private function linha($sugestao)
    {
        return from_array_to_table_row([
            td_ordem($this->ordem),
            td_value($sugestao->mensagem),
            td_status($sugestao->status),
            td_status($sugestao->usuario_id),
            td_alterar(SugestaoController::$controller, $sugestao->id),
            td_excluir(SugestaoController::$controller, $sugestao->id)
        ]);
    }
}