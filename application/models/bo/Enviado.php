<?php

include_once('StatusDoAndamento.php');

class Enviado implements StatusDoAndamento
{
    static $NOME = 'enviado';
    static $NIVEL = 1;

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