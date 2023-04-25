<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TabelaPregao
{

    private $ordem;

    /** Recebe um Array ou não no terceiro prâmetro, 
     * caso o processo esteja selecionado.
     * 
     * $data = array(
     *     'processo_selecionado' => $processo_completo,
     *       'processo_id' => $processoId,
     *  );
     */
    public function pregao($data)
    {
        $this->ordem = 1;
        $tabela = $this->linhaDeCabecalhoDoPregao();

        foreach ($data['processo_selecionado'] as $arquivo_do_processo) {
            $this->ordem++;
            $tabela .= $this->linhaDoPregao($arquivo_do_processo);
        }
        
        return $tabela;
    }

    private function linhaDeCabecalhoDoPregao()
    {
        return
            "
                    <tr class='text-center'> 
                        <td>Ordem</td>
                        <td>Nome do Documento</td>
                        <td>Data do Upload</td>
                        <td>Alterar</td>
                        <td>Excluir</td>               
                    </tr>";
    }

    private function linhaDoPregao($arquivo_do_processo)
    {

        return
            "<tr class='text-center'>" .

            $this->pregaoOrdem() .
            $this->pregaoNome($arquivo_do_processo->nomeDoDocumento) .
            $this->pregaoDataDoUpload($arquivo_do_processo->dataDoUpload) .
            $this->pregaoAlterar($arquivo_do_processo->id) .
            $this->pregaoExcluir($arquivo_do_processo->id) .

            "</tr>";
    }

    private function pregaoOrdem()
    {
        return "<td>{$this->ordem}</td>";
    }

    private function pregaoNome($nomeDoDocumento)
    {
        return "<td>{$nomeDoDocumento}</td>";
    }

    private function pregaoDataDoUpload($dataDoUpload)
    {
        return "<td>{$this->formatarData($dataDoUpload)}</td>";
    }

    private function pregaoAlterar($id)
    {
        $link = "index.php/#/alterar/{$id}";
        $value = "<a href='" . base_url($link) . "'>Alterar</a>";
        return "<td>{$value}</td>";
    }

    private function pregaoExcluir($id)
    {
        $link = "index.php/#/deletar/{$id}";

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