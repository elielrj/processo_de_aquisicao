<?php

    class Executado implements StatusDoAndamento,  Utilidades{


        static $NOME = 'executado';
        static $NIVEL = 2;

        public function nome(){
            return $this->NOME;
        }

        public function nivel(){
            return $this->NIVEL;
        }

    }

?>