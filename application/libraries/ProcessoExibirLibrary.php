<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ProcessoExibirLibrary
{

    private $ordem;

    public function processo_exibir($processo)
    {
        $this->ordem = 0;

        $tabela = $this->processoExibirCabecalho($processo);

        $tabela .= br_multiples(3);

        $tabela .= $this->processoExibirListarArtefatos($processo);

        return $tabela;
    }

    private function processoExibirCabecalho($processo)
    {

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
                            " . td_data_hora_br($processo->dataHora) . "
                        </tr>
                        <tr class='text-left'> 
                            <td>Chave para acompanhar: </td>
                            <td>" . $processo->chave . "</td> 
                        </tr>
                        <tr class='text-left'> 
                            <td>Modalidade: </td>
                            <td>" . $processo->lei->modalidade->nome . "</td> 
                        </tr>
                        <tr class='text-left'> 
                            <td>Amparo legal: </td>
                            <td>" . $processo->lei->toString() . "</td> 
                        </tr>
                        <tr class='text-left'> 
                            <td>Processo: </td>
                            <td>" . "<a href=" . base_url('index.php/ProcessoController/visualizarProcesso/' .
                $processo->id) . " class='btn btn-primary btn-lg btn-block' >Visualização completa</a>" . "</td> 
                        </tr>
                        <tr class='text-left'> 
                            <td>Processo: </td>
                            <td>" . "<a href=" . base_url('index.php/ProcessoController/imprimirProcesso/' .
                $processo->id) . " class='btn btn-primary btn-lg btn-block' >Imprimir todo processo</a>" . "</td> 
                        </tr>
                    </table>
                ";
    }

    public function processoExibirListarArtefatos($processo)
    {

        $listagemDeArtefatos = "<table class='table table-responsive-md table-hover'>";

        foreach ($processo->tipo->listaDeArtefatos as $artefato) {

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
                    <td>{$link}</td>" .

                form_open_multipart('ArquivoController/' . $this->formCriarOuAtualizar($artefato->arquivo), ['class' => 'form-control']) .
                form_input(['name' => 'arquivo_id', 'type' => 'hidden', 'value' => $this->idDoArquivo($artefato->arquivo)]) .
                form_input(['name' => 'processo_id', 'type' => 'hidden', 'value' => $processo->id]) .
                form_input(['name' => 'artefato_id', 'type' => 'hidden', 'value' => $artefato->id]) .
                form_input(['name' => 'arquivo_status', 'type' => 'hidden', 'value' => $this->statusDoArquivo($artefato->arquivo)]) .
                form_input(['name' => 'arquivo_path', 'type' => 'hidden', 'value' => $this->pathDoArquivo($artefato->arquivo)]) .
                "<td>" .
                form_input(['name' => 'arquivo', 'type' => 'file']) . "</td>" .
                "</td>" .
                "<td>" . form_submit('enviar', 'Enviar', ['class' => 'btn btn-primary']) . "</td>" .

                form_close() .

                "</tr>";

        }
        $listagemDeArtefatos .= "</table>";

        return $listagemDeArtefatos;
    }

    public function idDoArquivo($arquivo)
    {

        if ($arquivo != null) {

            return $arquivo->id;
        } else {
            return null;
        }
    }

    public function formCriarOuAtualizar($arquivo)
    {

        if ($arquivo == null) {

            return 'criarApartirDeUmProcesso';
        } else {
            return 'atualizarApartirDeUmProcesso';
        }
    }

    public function statusDoArquivo($arquivo)
    {

        if ($arquivo == null) {
            return true;
        } else {
            return $arquivo->status;
        }
    }

    public function pathDoArquivo($arquivo)
    {

        if ($arquivo != null) {
            return $arquivo->path;
        } else {
            return '';
        }
    }

    private function objeto($objeto, $id)
    {
        return "<td><a href='" . base_url('index.php/ProcessoController/exibir/' . $id) . "'>{$objeto}</a></td>";
    } 

}