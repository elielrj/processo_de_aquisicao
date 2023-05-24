<?php

include_once('NivelDeAcesso.php');

class Root implements NivelDeAcesso
{
    const NIVEL = 'root';

    public function nivel()
    {
        return Root::NIVEL;
    }

}

?>