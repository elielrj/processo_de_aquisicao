<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/libraries/DataLibrary.php');

//include_once('tabela/TabelaLei.php');

class TabelaProcesso {

    private $ordem;

    public function processo($processos, $ordem) {
        $this->ordem = $ordem;
        $tabela = $this->linhaDeCabecalhoDoProcesso();

        foreach ($processos as $processo) {
            $this->ordem++;

            $tabela .= $this->linhaDoProcesso($processo);
        }
        return $tabela;
    }

    
    private function linhaDeCabecalhoDoProcesso() {
        return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Objeto</td>
                    <td>Tipo de Processo</td>
                    <td>Modalidade</td>
                    <td>Lei</td>
                    <td>Número</td>
                    <td>Data do Processo</td>
                    <td>Seção</td>
                    <td>Andamento</td>
                    <td>Alterar</td>
                    <td>Excluir</td>               
                </tr>";
    }


    private function linhaDoProcesso($processo) {
        return
                "<tr class='text-center'>" .
                $this->ordem() .
                $this->objeto($processo->objeto, $processo->id) .
                $this->tipo($processo->tipo->nome) .
                $this->modalidade($processo->lei->modalidade->nome) .
                $this->lei($processo->lei->toString()) .
                $this->numero($processo->numero) .
                $this->data($processo->dataHora) .
                $this->departamento($processo->departamento) .
                $this->completo($processo->completo) .
                $this->alterar($processo->id) .
                $this->excluir($processo->id) .
                "</tr>";
    }


    private function ordem() {
        return "<td>{$this->ordem}</td>";
    }

    private function id($id) {
        return "<td>{$id}</td>";
    }

    private function modalidade($modalidade) {
        return "<td>{$modalidade}</td>";
    }

    private function objeto($objeto, $id) {
        return "<td><a href='" . base_url('index.php/ProcessoController/exibir/' . $id) . "'>{$objeto}</a></td>";
    }

    private function tipo($tipo) {
        return "<td>{$tipo}</td>";
    }
    
    private function lei($lei) {
        return "<td>{$lei}</td>";
    }

    private function numero($numero) {
        return "<td>{$numero}</td>";
    }

    private function data($data) {
        return "<td>{$this->formatarData($data)}</td>";
    }

    private function chave($chave) {
        return "<td>{$chave}</td>";
    }

    private function departamento($departamento) {

        return "<td>{$departamento->nome}</td>";
    }

    private function completo($completo) {
        return
            "<td><p style='color:" . ($completo ? 'green' : 'red') . "'>" .
            ($completo
                ? 'Finalizado'
                : 'Pendente...') .
            "</p></td>";
    }
    private function status($status) {
        return "<td>" . ($status ? 'Ativo' : 'Inativo') . "</td>";
    }

    private function alterar($id) {
        $link = "index.php/ProcessoController/alterar/{$id}";
        $value = "<a href='" . base_url($link) . "'>Alterar</a>";
        return "<td>{$value}</td>";
    }

    private function excluir($id) {
        $link = "index.php/ProcessoController/deletar/{$id}";

        $value = "<a href='" . base_url($link) . "'>" . 'Excluir' . "</a>";

        return "<td>{$value}</td>";
    }

    //todo data
    public function formatarData($data) {
        return form_input(array(
            'type' => 'datetime',
            'value' => DataLibrary::dataBr($data),
            'disabled' => 'disable',
            'class' => 'text-center'
        ));
    }

}
