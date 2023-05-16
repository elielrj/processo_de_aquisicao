<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ProcessoImprimirLibrary
{

    private $ordem;
    private $controller = 'ProcessoController';

    public function processo_imprimir($processo)
    {

        $this->ordem = 0;

        $tabela = $this->processoImpirmirCabecalho($processo);

        $tabela .= br_multiples(3);

        $tabela .= $this->processoImprimirListaDeArtefatos($processo);

        return $tabela;
    }

    private function processoImpirmirCabecalho($processo)
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
                            " . td_value($processo->numero) . "
                        </tr>
                        <tr class='text-left'> 
                            <td>Data de abertura(Nup/Nud): </td>"
                             . td_data_br($processo->dataHora) . 
                        "</tr>
                        <tr class='text-left'> 
                            <td>Chave para acompanhar: </td>
                            " . td_value($processo->chave) . "
                        </tr>
                        <tr class='text-left'> 
                            <td>Modalidade: </td>
                            <td>" . $processo->lei->modalidade->nome . "</td> 
                        </tr>
                        <tr class='text-left'> 
                            <td>Amparo legal: </td>
                            <td>" . $processo->lei->toString() . "</td> 
                        </tr>
                    </table>
                ";
    }

    public function processoImprimirListaDeArtefatos($processo)
    {
       
        $listagemDeArtefatos = "";

        foreach ($processo->tipo->listaDeArtefatos as $artefato) {

            ++$this->ordem;

            if ($artefato->arquivo != null) {

                $listagemDeArtefatos .=
                    "</br>
                    <p>" . $this->ordem() . " - " . $artefato->nome ."<p>
                    <div style='height: 1080px; width:100%;'>
                        <embed src='" . base_url($artefato->arquivo->path) . "' type='application/pdf' width='100%' height='100%'>
                    </div>
                ";
            }
        }

        $listagemDeArtefatos .= "";

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

    private function ordem()
    {
        return "<td>{$this->ordem}</td>";
    }

    private function objeto($objeto, $id)
    {
        return "<td><a href='" . base_url('index.php/ProcessoController/exibir/' . $id) . "'>{$objeto}</a></td>";
    }
}
