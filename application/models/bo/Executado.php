<?php

class Executado implements StatusDoAndamento
{

    static $NOME = 'executado';
    static $NIVEL = 2;

    public function nome()
    {
        return $this->NOME;
    }

    public function nivel()
    {
        return $this->NIVEL;
    }

}

?>