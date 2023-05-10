<?php

    class Enviado implements StatusDoAndamento,  Utilidades{


        static $NOME = 'enviado';
        static $NIVEL = 1;

        public function nome(){
            return $this->NOME;
        }

        public function nivel(){
            return $this->NIVEL;
        }

    }

?>