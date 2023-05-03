<?php

defined('BASEPATH') or exit('No direct script access allowed');

class TabelaProcessoImprimir
{


    public function processo_imprimir($processo)
    {

        $tabela = $this->processoImpirmirCabecalho($processo);

        $tabela .= "</br></br></br>";

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

    public function processoImprimirListaDeArtefatos($processo)
    {

        $listagemDeArtefatos = "<table class='table table-responsive-md table-hover'>";

        foreach ($processo->modalidade->listaDeArtefatos as $artefato) {

           

            if ($artefato->arquivo != null) {

                $listagemDeArtefatos .= "<tr class='text-left'><td>Artefato *** exibir arquivo em PDF na página ****</tr>";

            } 
            
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
        
        if($arquivo == null) {
            
            return 'criarApartirDeUmProcesso';

        } else {
            return 'atualizarApartirDeUmProcesso';
        }
    }
    
    public function statusDoArquivo($arquivo)
    {

        if($arquivo == null) {
            return true;
        } else {
            return $arquivo->status;
        }
    }

    public function pathDoArquivo($arquivo)
    {
        
        if($arquivo != null) {
            return $arquivo->path;
        } else {
            return '';
        }
    }

    private function ordem()
    {
        return "<td>{$this->ordem}</td>";
    }

    private function id($id)
    {
        return "<td>{$id}</td>";
    }

    private function modalidade($modalidade)
    {
        return "<td>{$modalidade}</td>";
    }

    private function objeto($objeto, $id)
    {
        return "<td><a href='" . base_url('index.php/ProcessoController/exibir/' . $id) . "'>{$objeto}</a></td>";
    }

    private function lei($lei)
    {
        return "<td>{$lei}</td>";
    }

    private function numero($numero)
    {
        return "<td>{$numero}</td>";
    }

    private function data($data)
    {
        return "<td>{$this->formatarData($data)}</td>";
    }

    private function chave($chave)
    {
        return "<td>{$chave}</td>";
    }

    private function departamento($departamento)
    {

        return "<td>{$departamento->nome}</td>";
    }

    private function status($status)
    {
        return "<td>" . ($status ? 'Ativo' : 'Inativo') . "</td>";
    }

    private function alterar($id)
    {
        $link = "index.php/ProcessoController/alterar/{$id}";
        $value = "<a href='" . base_url($link) . "'>Alterar</a>";
        return "<td>{$value}</td>";
    }

    private function excluir($id)
    {
        $link = "index.php/ProcessoController/deletar/{$id}";

        $value = "<a href='" . base_url($link) . "'>" . 'Excluir' . "</a>";

        return "<td>{$value}</td>";
    }

    public function formatarData($data)
    {
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