<?php

defined('BASEPATH') or exit('No direct script access allowed');

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

    public function processo_exibir($processo) {
        $this->ordem = 0;

        $tabela = $this->processoExibirCabecalho($processo);
        
        $tabela .= "</br></br></br>";

        $tabela .= $this->processoExibirListarArtefatos($processo);

        return $tabela;
    }

    private function linhaDeCabecalhoDoProcesso() {
        return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Objeto</td>
                    <td>Modalidade</td>
                    <td>Lei</td>
                    <td>Número</td>
                    <td>Data do Processo</td>
                    <td>Chave de Acesso</td>
                    <td>Seção</td>
                    <td>Status</td>
                    <td>Alterar</td>
                    <td>Excluir</td>               
                </tr>";
    }

    private function processoExibirCabecalho($processo) {

        return
                "
                    <table>
                        <tr class='text-left'> 
                            <td>Objeto: </td>
                            <td>" . $processo->objeto . "</td> 
                        </tr>
                        <tr class='text-left'> 
                            <td>Número do Processo (Nup/Nud): </td>
                            <td>" . $processo->numero . "</td> 
                        </tr>
                        <tr class='text-left'> 
                            <td>Data de abertura(Nup/Nud): </td>
                            <td>" . $this->formatarData($processo->data) . "</td> 
                        </tr>
                        <tr class='text-left'> 
                            <td>Chave para acompanhar: </td>
                            <td>" . $processo->chave . "</td> 
                        </tr>
                        <tr class='text-left'> 
                            <td>Modalidade: </td>
                            <td>" . $processo->modalidade->nome . "</td> 
                        </tr>
                        <tr class='text-left'> 
                            <td>Amparo legal: </td>
                            <td>" . $processo->modalidade->lei->toString() . "</td> 
                        </tr>
                    </table>
                ";
    }

    private function linhaDoProcesso($processo) {
        return
                "<tr class='text-center'>" .
                $this->ordem() .
                $this->objeto($processo->objeto, $processo->id) .
                $this->modalidade($processo->modalidade->nome) .
                $this->lei($processo->modalidade->lei->toString()) .
                $this->numero($processo->numero) .
                $this->data($processo->data) .
                $this->chave($processo->chave) .
                $this->departamento($processo->departamento) .
                $this->status($processo->status) .
                $this->alterar($processo->id) .
                $this->excluir($processo->id) .
                "</tr>";
    }

    public function processoExibirListarArtefatos($processo) {
        
        $lista = "";
        
        foreach ($processo->modalidade->listaDeArtefatos as $artefato){
          
            "
                <tr class='text-left'> 
                    
                    <td><a href='" . base_url('index.php/ArquivoController/exibir/' . $id) . "'>{$artefato->nome}</a></td> 
                </tr>
            "
        }           
            

        }
       
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

    public function formatarData($data) {
        return form_input(array(
            'type' => 'datetime',
            'value' => (new DateTime($data))->format('d-m-Y'),
            'disabled' => 'disable',
            'class' => 'text-center'
        ));
    }

}
