<?php

include_once('NivelDeAcesso.php');

class Aprovar implements NivelDeAcesso
{
    const NIVEL = 4;
    const NOME = 'aprovar';

    public function nome()
    {
        return Aprovar::NOME;
    }
    

    public function nivel()
    {
        return Aprovar::NIVEL;
    }

}

?>