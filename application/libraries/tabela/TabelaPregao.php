<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TabelaPregao
{

    private $ordem;

    public function pregao($processos, $ordem)
    {
        $this->ordem = $ordem;
        $tabela = $this->linhaDeCabecalhoDoPregao();

        foreach ($processos as $processo) {
            $this->ordem++;
            $tabela .= $this->linhaDoPregao($processo);
        }

        return $tabela;
    }

    private function linhaDeCabecalhoDoPregao()
    {
        return
            "
                    <tr class='text-center'> 
                        <td>Ordem</td>
                        <td>Id</td>
                        <td>Objeto</td>
                        <td>Nup/Nud</td>
                        <td>Data do Processo</td>
                        <td>Chave de Acesso</td>
                        <td>Seção</td>
                        <td>Status</td>
                        <td>Alterar</td>
                        <td>Excluir</td>               
                    </tr>";
    }

    private function linhaDoPregao($processo)
    {

        return
            "<tr class='text-center'>" .

            $this->pregaoOrdem() .
            $this->pregaoId($processo->id) .
            $this->pregaoObjeto($processo->objeto, $processo->id) .
            $this->pregaoNupNud($processo->nupNud) .
            $this->pregaoDataDoProcesso($processo->dataDoProcesso) .
            $this->pregaoChaveDeAcesso($processo->chaveDeAcesso) .
            $this->pregaoDepartamento($processo->departamento->sigla) .
            $this->pregaoStatus($processo->status) .
            $this->pregaoAlterar($processo->id) .
            $this->pregaoExcluir($processo->id) .

            "</tr>";
    }

    private function pregaoOrdem()
    {
        return "<td>{$this->ordem}</td>";
    }

    private function pregaoId($id)
    {
        return "<td>{$id}</td>";
    }

    private function pregaoObjeto($objeto, $processoId)
    {
        $link = "index.php/PregaoController/listarProcesso/{$processoId}";

        return "<td><a href='" . base_url($link) . "'>{$objeto}</a></td>";
    }

    private function pregaoNupNud($nupNud)
    {
        return "<td>{$nupNud}</td>";
    }
    private function pregaoDataDoProcesso($dataDoProcesso)
    {
        return "<td>{$this->formatarData($dataDoProcesso)}</td>";
    }

    private function pregaoChaveDeAcesso($chaveDeAcesso)
    {
        return "<td>{$chaveDeAcesso}</td>";
    }

    private function pregaoDepartamento($departamento)
    {
        return "<td>{$departamento}</td>";
    }

    private function pregaoStatus($status)
    {
        return "<td>" . ($status ? 'Ativo' : 'Inativo') . "</td>";
    }

    private function pregaoAlterar($id)
    {
        $link = "index.php/PregaoController/alterar/arquivo{$id}";
        $value = "<a href='" . base_url($link) . "'>Alterar</a>";
        return "<td>{$value}</td>";
    }

    private function pregaoExcluir($id)
    {
        $link = "index.php/PregaoController/deletar/arquivo/{$id}";

        $value = "<a href='" . base_url($link) . "'>" . 'Excluir' . "</a>";

        return "<td>{$value}</td>";
    }

    public function formatarData($data)
    {
        return form_input(
            array(
                'type' => 'datetime',
                'value' => (new DateTime($data))->format('d-m-Y H:m:s'),
                'disabled' => 'disable',
                'class' => 'text-center'
            )
        );
    }
}