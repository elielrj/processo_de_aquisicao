<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ProcessoExibirLibrary
{

    private $ordem;

    public function listar($processo)
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

            $this->ordem++;

            $listagemDeArtefatos .= $this->linkParaArtefato($artefato, $processo);
        }

        $listagemDeArtefatos .= "</table>";

        return $listagemDeArtefatos;
    }


    private function linkParaArtefato($artefato, $processo)
    {

        $link = "";

        $retorno = '';

        if (
            $artefato->arquivos != null
        ) {

            $subindice = 0;
            $valorDoSubindice = count($artefato->arquivos);
            
            foreach ($artefato->arquivos as $arquivo) {

                if ($arquivo->path == '') {

                    $link = "{$artefato->nome}"; //todo por o nome/apelido do arquivo

                } else {

                    $link = "<a href='" . base_url($arquivo->path) . "'>{$artefato->nome}</a>"; //todo por o nome/apelido do arquivo

                }



                

                if ($valorDoSubindice > 1) {
                    $subindice++;
                }

                $retorno .= $this->linhaDeCadaArquivoDeCadaArtefato(
                    $artefato,
                    $processo,
                    $link,
                    $arquivo,
                    ($subindice > 0 ? $subindice : null)
                );



            }

        } else {
            $link = "{$artefato->nome}";

            $retorno .= $this->linhaDeCadaArquivoDeCadaArtefato($artefato, $processo, $link, $arquivo = null);
        }
        return $retorno;

    }

    private function linhaDeCadaArquivoDeCadaArtefato($artefato, $processo, $link, $arquivo, $subindice = null)
    {
        // var_dump($arquivo);
        return "
                    <tr class='text-left'>                    
                        
                        <td>" . ($subindice == null ? $this->ordem : ($this->ordem . '.' . $subindice)) . "</td> 
                        
                        <td title='Visualizar artefato'>{$link}</td>" .
                        
                            form_open_multipart('ArquivoController/alterarArquivoDeUmProcesso', ['class' => 'form-control']) .

                            "<td>" .
                                form_input(['name' => 'arquivo_nome', 'type' => 'text', 'value' => (isset($arquivo) ? $arquivo->nome : ''), 'placeholder' => 'Descrição']) .
                            "</td>" .

                            
                            form_input(['name' => 'arquivo_id', 'type' => 'hidden', 'value' => $this->idDoArquivo($arquivo)]) .
                            form_input(['name' => 'processo_id', 'type' => 'hidden', 'value' => $processo->id]) .
                            form_input(['name' => 'artefato_id', 'type' => 'hidden', 'value' => $artefato->id]) .
                            form_input(['name' => 'arquivo_status', 'type' => 'hidden', 'value' => $this->statusDoArquivo($arquivo)]) .
                            form_input(['name' => 'arquivo_path', 'type' => 'hidden', 'value' => $this->pathDoArquivo($arquivo)]) .

                            "<td>" . form_input(['name' => 'arquivo', 'type' => 'file', 'accept' => '.pdf']) . "</td>" .

                        "</td>" .
                            
                        "<td>" . form_submit('enviar', 'Upload/Atualizar', ['class' => 'btn btn-primary', 'title' => 'Sobe um novo ou atualiza o arquivo para este artefato do processo']) . "</td>" .
                        
                        "<td>" . form_submit('mais_um', '+', ['class' => 'btn btn-primary', 'title' => 'Incluir mais arquivo para este artefato']) . "</td>" .
                        
                        "<td>" . form_submit('menos_um', '-', ['class' => 'btn btn-primary', 'title' => 'Excluir artefato']) . "</td>" .

                        form_close() .

                    "</tr>";

    }
    public function idDoArquivo($arquivo)
    {

        if ($arquivo != null) {

            return $arquivo->id;
        } else {

            return null;
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