<?php
    
    include_once('tabela/TabelaProcesso.php');
    include_once('tabela/TabelaUsuario.php');

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
    }

?>