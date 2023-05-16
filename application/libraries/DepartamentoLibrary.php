<?php

defined('BASEPATH') or exit('No direct script access allowed');

class TabelaDepartamento {

    private $ordem;

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
        return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Nome</td>
                    <td>Sigla</td>
                    <td>Status</td>
                    <td>Alterar</td>
                </tr>";
    }

    private function linha($departamento) {
        return
                "<tr class='text-center'>" .
                $this->departamentoOrdem() .
                $this->departamentoNome($departamento->nome) .
                $this->departamentoSigla($departamento->sigla) .
                $this->departamentoStatus($departamento->status) .
                $this->departamentoAlterar($departamento->id) .
                "</tr>";
    }

    private function departamentoOrdem() {
        return "<td>{$this->ordem}</td>";
    }

    private function departamentoNome($nome) {
        return "<td>{$nome}</td>";
    }

    private function departamentoSigla($sigla) {
        return "<td>{$sigla}</td>";
    }

    private function departamentoStatus($status) {
        return "<td>" . ($status ? 'Ativo' : 'Inativo') . "</td>";
    }

    private function departamentoAlterar($id) {
        $link = "index.php/DepartamentoController/alterar/{$id}";
        $value = "<a href='" . base_url($link) . "'>Alterar</a>";
        return "<td>{$value}</td>";
    }

}
