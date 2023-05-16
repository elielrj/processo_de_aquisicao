<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ArtefatoLibrary
{

    private $ordem;

    public function artefato($artefatos, $ordem)
    {
        $this->ordem = $ordem;
        $tabela = $this->linhaDeCabecalhoDeArtefatos();

        foreach ($artefatos as $artefato) {
            $this->ordem++;

            $tabela .= $this->linhaDeTipoDeLicitacao($artefato);
        }
        return $tabela;
    }

    private function linhaDeCabecalhoDeArtefatos()
    {
        return
            "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Nome</td>
                    <td>Status</td>
                    <td>Alterar</td>
                    <td>Excluir</td>               
                </tr>";
    }

    private function linhaDeTipoDeLicitacao($artefato)
    {

        return
            "<tr class='text-center'>" .

            $this->tipoDeLicitacaoOrdem() .
            $this->tipoDeLicitacaoNome($artefato->nome) .
            $this->tipoDeLicitacaoStatus($artefato->status) .
            $this->tipoDeLicitacaoAlterar($artefato->id) .
            $this->tipoDeLicitacaoExcluir($artefato->id) .

            "</tr>";
    }

    private function tipoDeLicitacaoOrdem()
    {
        return "<td>{$this->ordem}</td>";
    }

    private function tipoDeLicitacaoId($id)
    {
        return "<td>{$id}</td>";
    }

    private function tipoDeLicitacaoNome($nome)
    {
        return "<td>{$nome}</td>";
    }

    private function tipoDeLicitacaoStatus($status)
    {
        return "<td>" . ($status ? 'Ativo' : 'Inativo') . "</td>";
    }

    private function tipoDeLicitacaoAlterar($id)
    {
        $link = "index.php/ArtefatoController/alterar/{$id}";
        $value = "<a href='" . base_url($link) . "'>Alterar</a>";
        return "<td>{$value}</td>";
    }

    private function tipoDeLicitacaoExcluir($id)
    {
        $link = "index.php/ArtefatoController/deletar/{$id}";

        $value = "<a href='" . base_url($link) . "'>" . 'Excluir' . "</a>";

        return "<td>{$value}</td>";
    }

}