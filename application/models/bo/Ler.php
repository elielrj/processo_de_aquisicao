<?php

include_once('NivelDeAcesso.php');

class Ler implements NivelDeAcesso
{
    const NIVEL = 'ler';

    public function nivel()
    {
        return Ler::NIVEL;
    }

}

?>