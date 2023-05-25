<?php

include_once('NivelDeAcesso.php');

class Root implements NivelDeAcesso
{
    const NIVEL = 4;
    const NOME = 'root';

    public function nome()
    {
        return Root::NOME;
    }
    

    public function nivel()
    {
        return Root::NIVEL;
    }

}

?>