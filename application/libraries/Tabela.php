<?php
defined('BASEPATH') or exit('No direct script access allowed');

include_once('tabela/TabelaProcesso.php');
include_once('tabela/TabelaUsuario.php');
include_once('tabela/TabelaArquivo.php');
include_once('tabela/TabelaDepartamento.php');
include_once('tabela/TabelaPregao.php');

class Tabela
{

    public function processo($processos, $ordem, $data)
    {
        $tabelaProcesso = new TabelaProcesso();
        return $tabelaProcesso->processo($processos, $ordem, $data);
    }

    public function usuario($usuarios, $ordem)
    {
        $tabelaUsuario = new TabelaUsuario();
        return $tabelaUsuario->usuario($usuarios, $ordem);
    }

    public function arquivo($arquivos, $ordem)
    {
        $tabelaArquivo = new TabelaArquivo();
        return $tabelaArquivo->arquivo($arquivos, $ordem);
    }

    public function departamento($departamentos, $ordem)
    {
        $tabelaDepartamento = new TabelaDepartamento();
        return $tabelaDepartamento->departamento($departamentos, $ordem);
    }

    public function pregao($processos, $ordem)
    {
        $tabelaPregao = new TabelaPregao();
        return $tabelaPregao->pregao($processos, $ordem);
    }

    public function processoDePregao($processo)
    {
       $tabelaProcesso = new TabelaProcesso();
        return $tabelaProcesso->processoDePregao($processo);
    }
}

?>