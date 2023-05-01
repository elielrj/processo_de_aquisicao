<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('tabela/TabelaProcesso.php');
include_once('tabela/TabelaUsuario.php');
include_once('tabela/TabelaArquivo.php');
include_once('tabela/TabelaDepartamento.php');
include_once('tabela/TabelaTipoDeLicitacao.php');
include_once('tabela/TabelaArtefato.php');
include_once('tabela/TabelaIndice.php');
include_once('tabela/TabelaItemDoIndice.php');

class Tabela {

    public function processo($processos, $ordem) {
        $tabelaProcesso = new TabelaProcesso();
        return $tabelaProcesso->processo($processos, $ordem);
    }

    public function usuario($usuarios, $ordem) {
        $tabelaUsuario = new TabelaUsuario();
        return $tabelaUsuario->usuario($usuarios, $ordem);
    }

    public function arquivo($arquivos, $ordem) {
        $tabelaArquivo = new TabelaArquivo();
        return $tabelaArquivo->arquivo($arquivos, $ordem);
    }

    public function departamento($departamentos, $ordem) {
        $tabelaDepartamento = new TabelaDepartamento();
        return $tabelaDepartamento->departamento($departamentos, $ordem);
    }

    public function pregao($processos, $ordem) {
        $tabelaPregao = new TabelaPregao();
        return $tabelaPregao->pregao($processos, $ordem);
    }

    public function processoDePregao($processo) {
        $tabelaProcesso = new TabelaProcesso();
        return $tabelaProcesso->processoDePregao($processo);
    }

    public function tipoDeLicitacao($tiposDeLicitacoes, $ordem) {
        $tabelaTipoDeLicitacao = new TabelaTipoDeLicitacao();
        return $tabelaTipoDeLicitacao->tipoDeLicitacao($tiposDeLicitacoes, $ordem);
    }

    public function artefato($artefatos, $ordem) {
        $tabelaArtefato = new TabelaArtefato();
        return $tabelaArtefato->artefato($artefatos, $ordem);
    }
    
    public function indice($indices, $ordem) {
        $tabelaIndice = new TabelaIndice();
        return $tabelaIndice->indice($indices, $ordem);
    }
    
    public function itemDoIndice($itensDoIndice, $ordem) {
        $tabelaItemDoIndice = new TabelaItemDoIndice();
        return $tabelaItemDoIndice->itemDoIndice($itensDoIndice, $ordem);
    }
}