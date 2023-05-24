<?php

include_once('NivelDeAcesso.php');

class Escrever implements NivelDeAcesso
{
    const NIVEL = 'escrever';

    public function nivel()
    {
        return Escrever::NIVEL;
    }

}

?>