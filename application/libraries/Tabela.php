<?php
    
    include_once('tabela/TabelaProcesso.php');

    class Tabela {

        public function processo($processos, $ordem)
        {
            $tabelaProcesso = new TabelaProcesso();
            return $tabelaProcesso->processo($processos, $ordem);
        }

       
    }

?>