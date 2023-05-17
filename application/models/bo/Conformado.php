<?php

include_once('StatusDoAndamento.php');


class Conformado implements StatusDoAndamento
{
    const NOME = 'conformado';
    const NIVEL = 3;

    public function nome()
    {
        return Conformado::NOME;
    }

    public function nivel()
    {
        return Conformado::NIVEL;
    }

}

?>