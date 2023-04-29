<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TabelaArtefato
{

    private $ordem;

    public function artefato($artefatos, $ordem)
    {
        $this->ordem = $ordem;
        $tabela = $this->linhaDeCabecalhoDeArtefatos();

        foreach ($artefatos as $artefatos) {
            $this->ordem++;

            $tabela .= $this->linhaDeTipoDeLicitacao($artefatos);
        }
        return $tabela;
    }

    private function linhaDeCabecalhoDeArtefatos()
    {
        return
            "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Id</td>
                    <td>Nome</td>
                    <td>Status</td>
                    <td>Alterar</td>
                    <td>Excluir</td>               
                </tr>";
    }

    private function linhaDeTipoDeLicitacao($artefatos)
    {

        return
            "<tr class='text-center'>" .

            $this->tipoDeLicitacaoOrdem() .
            $this->tipoDeLicitacaoId($artefatos->id) .
            $this->tipoDeLicitacaoNome($artefatos->nome) .
            $this->tipoDeLicitacaoStatus($artefatos->status) .
            $this->tipoDeLicitacaoAlterar($artefatos->id) .
            $this->tipoDeLicitacaoExcluir($artefatos->id) .

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
        $link = "index.php/ArterfatoController/alterar/{$id}";
        $value = "<a href='" . base_url($link) . "'>Alterar</a>";
        return "<td>{$value}</td>";
    }

    private function tipoDeLicitacaoExcluir($id)
    {
        $link = "index.php/ArterfatoController/deletar/{$id}";

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