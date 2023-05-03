<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('tabela/TabelaArquivo.php');
include_once('tabela/TabelaArtefato.php');
include_once('tabela/TabelaDepartamento.php');
include_once('tabela/TabelaProcesso.php');
include_once('tabela/TabelaProcessoExibir.php');
include_once('tabela/TabelaProcessoImprimir.php');
include_once('tabela/TabelaUg.php');
include_once('tabela/TabelaUsuario.php');

class tabela {

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
    
    public function processo_exibir($processo) {
        $tabelaProcessoExibir = new TabelaProcessoExibir();
        return $tabelaProcessoExibir->processo_exibir($processo);
    }
    public function processo_imprimir($processo) {
        $tabelaProcessoImprimir = new TabelaProcessoImprimir();
        return $tabelaProcessoImprimir->processo_imprimir($processo);
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
    
    public function ug($listaDeUg, $ordem) {
        $tabelaUg = new TabelaUg();
        return $tabelaUg->ug($listaDeUg, $ordem);
    }
}