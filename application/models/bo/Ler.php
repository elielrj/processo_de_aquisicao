<?php

include_once('NivelDeAcesso.php');

class Ler implements NivelDeAcesso
{
    const NIVEL = 4;
    const NOME = 'ler';

    public function nome()
    {
        return Ler::NOME;
    }
    

    public function nivel()
    {
        return Ler::NIVEL;
    }

}

?>