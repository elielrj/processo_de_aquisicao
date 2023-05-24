<?php

include_once('NivelDeAcesso.php');

class Aprovar implements NivelDeAcesso
{
    const NIVEL = 'aprovar';

    public function nivel()
    {
        return Aprovar::NIVEL;
    }

}

?>