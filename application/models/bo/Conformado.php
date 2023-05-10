<?php

    class Conformado implements StatusDoAndamento{


        static $NOME = 'conformado';
        static $NIVEL = 3;

        public function nome(){
            return $this->NOME;
        }

        public function nivel(){
            return $this->NIVEL;
        }

    }

?>