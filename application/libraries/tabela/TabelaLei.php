<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TabelaLei
{

    private $ordem;

    public function lei($leis, $ordem)
    {
        $this->ordem = $ordem;
        $tabela = $this->linhaDeCabecalho();

        foreach ($leis as $lei) {
            $this->ordem++;

            $tabela .= $this->linha($lei);
        }
        return $tabela;
    }

    private function linhaDeCabecalho()
    {
        return
            "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Número</td>
                    <td>Artigo</td>
                    <td>Inciso</td>
                    <td>Data</td>
                    <td>Modalidade</td>
                    <td>Status</td>
                    <td>Alterar</td>
                    <td>Excluir</td>               
                </tr>";
    }

    private function linha($lei)
    {

        return
            "<tr class='text-center'>" .

            $this->ordem() .
            $this->numero($lei->numero) .
            $this->artigo($lei->artigo) .
            $this->inciso($lei->inciso) .
            $this->data($lei->data) .
            $this->modalidade($lei->modalidade->nome) .
            $this->tipoDeLicitacaoStatus($lei->status) .
            $this->tipoDeLicitacaoAlterar($lei->id) .
            $this->tipoDeLicitacaoExcluir($lei->id) .

            "</tr>";
    }

    private function ordem()
    {
        return "<td>{$this->ordem}</td>";
    }

    private function id($id)
    {
        return "<td>{$id}</td>";
    }

    private function numero($numero)
    {
        return "<td>{$numero}</td>";
    }
    
    private function artigo($artigo)
    {
        return "<td>{$artigo}</td>";
    }

    private function inciso($inciso)
    {
        return "<td>{$inciso}</td>";
    }

    private function modalidade($modalidade)
    {
        return "<td>{$modalidade}</td>";
    }

    private function data($data)
    {
        return "<td>{$this->formatarData($data)}</td>";
    }
    
    private function tipoDeLicitacaoStatus($status)
    {
        return "<td>" . ($status ? 'Ativo' : 'Inativo') . "</td>";
    }

    private function tipoDeLicitacaoAlterar($id)
    {
        $link = "index.php/leiController/alterar/{$id}";
        $value = "<a href='" . base_url($link) . "'>Alterar</a>";
        return "<td>{$value}</td>";
    }

    private function tipoDeLicitacaoExcluir($id)
    {
        $link = "index.php/leiController/deletar/{$id}";

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