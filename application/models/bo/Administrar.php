<?php

include_once('NivelDeAcesso.php');

class Administrar implements NivelDeAcesso
{
    const NIVEL = 4;
    const NOME = 'administrar';

    public function nome()
    {
        return Administrar::NOME;
    }
    

    public function nivel()
    {
        return Administrar::NIVEL;
    }

}

?>