<?php

defined('BASEPATH') or exit('No direct script access allowed');

class TabelaUg {

    private $ordem;

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
        return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>UASG</td>
                    <td>OM</td>
                    <td>Sigla</td>
                    <td>Status</td>
                </tr>";
    }

    private function linha($ug) {
        return
                "<tr class='text-center'>" .
                $this->ordem() .
                $this->numero($ug->numero) .
                $this->nome($ug->nome) .
                $this->sigla($ug->sigla) .
                $this->status($ug->status) .
                "</tr>";
    }

    private function ordem() {
        return "<td>{$this->ordem}</td>";
    }

    private function numero($numero) {
        return "<td>{$numero}</td>";
    }

    private function nome($nome) {
        return "<td>{$nome}</td>";
    }

    private function sigla($sigla) {
        return "<td>{$sigla}</td>";
    }

    private function status($status) {
        return "<td>" . ($status ? 'Ativo' : 'Inativo') . "</td>";
    }

}
