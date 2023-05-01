<?php

defined('BASEPATH') or exit('No direct script access allowed');

class TabelaItemDoIndice {

    private $ordem;

    public function itemDoIndice($itensDoIndice, $ordem) {
        $this->ordem = $ordem;
        $tabela = $this->cabecalho();
        
        foreach ($itensDoIndice as $itemDoindice) {
            $this->ordem++;

            $tabela .= $this->linha($itemDoindice);
        }
        return $tabela;
    }

    private function cabecalho() {
        return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Id</td>
                    <td>Ordem</td>
                    <td>Artefato</td>
                    <td>Status</td>
                    <td>Alterar</td>                    
                    <td>Excluir</td>               
                </tr>";
    }

    private function linha($itemDoindice) {
       
        return
                "<tr class='text-center'>" .
                $this->ordem() .
                $this->id($itemDoindice->id) .
                $this->ordemDoArtefato($itemDoindice->ordem) .
                $this->artefato($itemDoindice->artefato->nome) .
                $this->status($itemDoindice->status) .
                $this->alterar($itemDoindice->id) .
                $this->excluir($itemDoindice->id) .
                "</tr>";
    }

    private function ordem() {
        return "<td>{$this->ordem}</td>";
    }

    private function id($id) {
        return "<td>{$id}</td>";
    }
    
    private function ordemDoArtefato($ordem) {
        return "<td>{$ordem}</td>";
    }

    private function artefato($artefato) {
         return "<td>{$artefato}</td>";
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
