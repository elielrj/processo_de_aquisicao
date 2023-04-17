<?php
    
    include_once('tabela/TabelaProcesso.php');
    include_once('tabela/TabelaUsuario.php');
    include_once('tabela/TabelaArquivo.php');

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
    }

?>