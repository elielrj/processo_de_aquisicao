<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TabelaArquivo
{

    private $ordem;

    public function arquivo($arquivos, $ordem)
    {
        $this->ordem = $ordem;
        $tabela = $this->linhaDeCabecalhoDoArquivo();

        foreach ($arquivos as $arquivo) {
            $this->ordem++;
            $tabela .= $this->linhaDoArquivo($arquivo);
        }
        return $tabela;
    }

    private function linhaDeCabecalhoDoArquivo()
    {
        return
            "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Id</td>
                    <td>Path</td>
                    <td>Nome do Arquivo</td>
                    <td>Data do Upload</td>
                    <td>Processo</td>
                    <td>Artefato</td>
                    <td>Status</td>
                    <td>Alterar</td>
                    <td>Excluir</td>               
                </tr>";
    }

    private function linhaDoArquivo($arquivo)
    {
        return
            "<tr class='text-center'>" .

            $this->arquivoOrdem() .
            $this->arquivoId($arquivo->id) .
            $this->arquivoPath($arquivo->path) .
            $this->arquivoNomeDoArquivo($arquivo->nomeDoArquivo) .
            $this->arquivoDataDoUpload($arquivo->dataDoUpload) .
            $this->arquivoProcesso($arquivo->processo) .
            $this->arquivoArtefato($arquivo->artefato->nome) .
            $this->arquivoStatus($arquivo->status) .
            $this->arquivoAlterar($arquivo->id) .
            $this->arquivoExcluir($arquivo->id) .

            "</tr>";
    }

    private function arquivoOrdem()
    {
        return "<td>{$this->ordem}</td>";
    }

    private function arquivoId($id)
    {
        return "<td>{$id}</td>";
    }

    private function arquivoArtefato($artefato)
    {
        return "<td>{$artefato}</td>";
    }

    private function arquivoPath($path)
    {
        $value = "<a href='" . base_url($path) . "'>{$path}</a>";
        return "<td>{$value}</td>";
    }

    private function arquivoNomeDoArquivo($nome_do_arquivo)
    {
        return "<td>{$nome_do_arquivo}</td>";
    }

    private function arquivoDataDoUpload($data_do_upload)
    {
        return "<td>{$data_do_upload}</td>";
    }

    private function arquivoProcesso($processo)
    {
        return "<td>{$processo->objeto}</td>";
    }

    private function arquivoStatus($status)
    {
        return "<td>" . ($status ? 'Ativo' : 'Inativo') . "</td>";
    }

    private function arquivoAlterar($id)
    {
        $link = "index.php/ArquivoController/alterar/{$id}";
        $value = "<a href='" . base_url($link) . "'>Alterar</a>";
        return "<td>{$value}</td>";
    }

    private function arquivoExcluir($id)
    {
        $link = "index.php/ArquivoController/deletar/{$id}";

        $value = "<a href='" . base_url($link) . "'>" . 'Excluir' . "</a>";

        return "<td>{$value}</td>";
    }

}