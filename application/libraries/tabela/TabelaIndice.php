<?php

defined('BASEPATH') or exit('No direct script access allowed');

class TabelaIndice {

    private $ordem;

    public function indice($indices, $ordem) {
        $this->ordem = $ordem;
        $tabela = $this->cabecalho();
        
        foreach ($indices as $indice) {
            $this->ordem++;

            $tabela .= $this->linha($indice);
        }
        return $tabela;
    }

    private function cabecalho() {
        return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Id</td>
                    <td>Nome do Tipo de Licitação</td>
                    <td>Status</td>
                    <td>Alterar</td>
                    
                    <td>Excluir</td>               
                </tr>";
    }

    private function linha($indice) {
       
        return
                "<tr class='text-center'>" .
                $this->ordem() .
                $this->id($indice->id) .
                $this->nomeDoTipoDeLicitacao($indice->tipoDeLicitacao->nome) .
                $this->status($indice->status) .
                $this->alterar($indice->id) .
                $this->excluir($indice->id) .
                "</tr>";
    }

    private function ordem() {
        return "<td>{$this->ordem}</td>";
    }

    private function id($id) {
        return "<td>{$id}</td>";
    }

    private function nomeDoTipoDeLicitacao($nome) {
        return "<td>{$nome}</td>";
    }

    private function status($status) {
        return "<td>" . ($status ? 'Ativo' : 'Inativo') . "</td>";
    }

    private function alterar($id) {
        $link = "index.php/IndiceController/alterar/{$id}";
        $value = "<a href='" . base_url($link) . "'>Alterar</a>";
        return "<td>{$value}</td>";
    }

    private function excluir($id) {
        $link = "index.php/IndiceController/deletar/{$id}";

        $value = "<a href='" . base_url($link) . "'>" . 'Excluir' . "</a>";

        return "<td>{$value}</td>";
    }

}
