<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/libraries/DataLibrary.php');

class ArquivoLibrary
{

    private $ordem;

    public function listar($arquivos, $ordem)
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
        return from_array_to_table_row_with_td([
            'Ordem',
            'Path',
			'Data do Upload',
			'Nome',
            'Status',
			'Processo',
			'Usuário',
			'Artefato',
            'Alterar',
            'Excluir'
        ]);
    }

    private function linhaDoArquivo($arquivo)
	{
        return from_array_to_table_row([
            td_ordem($this->ordem),
            $this->arquivoPath($arquivo->path),
            td_data_hora_br($arquivo->dataHora),
			td_value($arquivo->nome),
            td_status($arquivo->status),
			td_value($arquivo->processoId),
			td_value($arquivo->usuarioId),
			td_value($arquivo->artefatoId),
            td_alterar(ArquivoController::$arquivoController, $arquivo->id),
            td_excluir(ArquivoController::$arquivoController, $arquivo->id)
        ]);
    }

    private function arquivoPath($path)
	{
        $value = "<a href='" . base_url($path) . "'>{$path}</a>";

        return td_value($value);
    }
}
