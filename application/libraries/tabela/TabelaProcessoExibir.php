<?php

defined('BASEPATH') or exit('No direct script access allowed');

class TabelaProcessoExibir {

    private $ordem;

    public function processo_exibir($processo) {
        $this->ordem = 0;

        $tabela = $this->processoExibirCabecalho($processo);

        $tabela .= "</br></br></br>";

        $tabela .= $this->processoExibirListarArtefatos($processo);

        return $tabela;
    }

    private function processoExibirCabecalho($processo) {

        return
                "
                    <table class='table table-responsive-md table-hover'>
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
                        <tr class='text-left'> 
                            <td>Amparo legal: </td>
                            <td>" . "<a href=" . base_url('index.php/ProcessoController/imprimirProcesso/' . $processo->id) . " class='btn btn-primary btn-lg btn-block' >Imprimir</a>" . "</td> 
                        </tr>
                    </table>
                ";
    }

    public function processoExibirListarArtefatos($processo) {

        $listagemDeArtefatos = "<table class='table table-responsive-md table-hover'>";

        foreach ($processo->modalidade->listaDeArtefatos as $artefato) {

            $link = "";

            if ($artefato->arquivo != null) {

                $link = "<a href='" . base_url($artefato->arquivo->path) . "'>{$artefato->nome}</a>";
            } else {

                $link = "{$artefato->nome}";
            }
            $this->ordem++;

            $listagemDeArtefatos .= "
                <tr class='text-left'>                    
                    <td>{$this->ordem}</td> 
                    <td>{$link}</td> 
                    <td>" .
                    form_open_multipart('ArquivoController/' . $this->formCriarOuAtualizar($artefato->arquivo), ['class' => 'form-group']) .
                    form_input(['name' => 'arquivo_id', 'type' => 'hidden', 'value' => $this->idDoArquivo($artefato->arquivo)]) .
                    form_input(['name' => 'processo_id', 'type' => 'hidden', 'value' => $processo->id]) .
                    form_input(['name' => 'artefato_id', 'type' => 'hidden', 'value' => $artefato->id]) .
                    form_input(['name' => 'arquivo_status', 'type' => 'hidden', 'value' => $this->statusDoArquivo($artefato->arquivo)]) .
                    form_input(['name' => 'arquivo_path', 'type' => 'hidden', 'value' => $this->pathDoArquivo($artefato->arquivo)]) .
                    "<div class='form-label'>" .
                    form_input(['name' => 'arquivo', 'class' => 'form-label', 'type' => 'file']) .
                    form_submit('enviar', 'Enviar', ['class' => 'form-label btn btn-primary btn-lg']) .
                    "</div>" .
                    form_close() .
                    "</td>
                    <td>Excluir</td>
                </tr>

            ";
        }
        $listagemDeArtefatos .= "</table>";

        return $listagemDeArtefatos;
    }

    public function idDoArquivo($arquivo) {

        if ($arquivo != null) {

            return $arquivo->id;
        } else {
            return null;
        }
    }

    public function formCriarOuAtualizar($arquivo) {

        if ($arquivo == null) {

            return 'criarApartirDeUmProcesso';
        } else {
            return 'atualizarApartirDeUmProcesso';
        }
    }

    public function statusDoArquivo($arquivo) {

        if ($arquivo == null) {
            return true;
        } else {
            return $arquivo->status;
        }
    }

    public function pathDoArquivo($arquivo) {

        if ($arquivo != null) {
            return $arquivo->path;
        } else {
            return '';
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
        return form_input(
                array(
                    'type' => 'datetime',
                    'value' => (new DateTime($data))->format('d-m-Y'),
                    'disabled' => 'disable',
                    'class' => 'text-center'
                )
        );
    }

}
