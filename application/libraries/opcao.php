<?php

    include_once('opcoes/OpcoesProcesso.php');
    
    class opcao{

        public function processo($processos)
        {
            $opcoesProcesso = new OpcoesProcesso();
            return $opcoesProcesso->processo($processos);
        }
    }
?>