<?php
defined('BASEPATH') or exit('No direct script access allowed');
    
    include_once('tabela/TabelaProcesso.php');
    include_once('tabela/TabelaUsuario.php');
    include_once('tabela/TabelaArquivo.php');
    include_once('tabela/TabelaDepartamento.php');

    class Tabela {

        public function processo($processos, $ordem)
        {
            $tabelaProcesso = new TabelaProcesso();
            return $tabelaProcesso->processo($processos, $ordem);
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
    }

?>