<?php

include_once('NivelDeAcesso.php');

class Administrar implements NivelDeAcesso
{
    const NIVEL = 'administrar';

    public function nivel()
    {
        return Administrar::NIVEL;
    }

}

?>